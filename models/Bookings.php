<?php
class Bookings
{
    protected $pdo;

    public function __construct()
    {
        $database = new BaseModel();
        $this->pdo = $database->getConnection();
    }

    /**
     * Lấy danh sách booking
     */
    public function getList()
    {
        try {
            $sql = "SELECT 
                        b.*,
                        t.name AS tour_name,
                        g.full_name AS guide_name
                    FROM bookings b
                    LEFT JOIN tours t ON b.tour_id = t.tour_id
                    LEFT JOIN guides g ON b.guide_id = g.guide_id
                    ORDER BY b.booking_id DESC";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($data as &$bk) {
                $bk['provider_name'] = null;

                if (!empty($bk['departure_id'])) {
                    $departureId = $bk['departure_id'];
                } else {
                    $departureId = null;

                    if (!empty($bk['tour_id']) && !empty($bk['start_date'])) {
                        $q = "SELECT departure_id 
                              FROM departures
                              WHERE tour_id = :tour_id 
                                AND start_date = :start_date
                              LIMIT 1";

                        $st = $this->pdo->prepare($q);
                        $st->execute([
                            ':tour_id' => $bk['tour_id'],
                            ':start_date' => $bk['start_date']
                        ]);

                        $found = $st->fetch(PDO::FETCH_ASSOC);
                        if ($found && !empty($found['departure_id'])) {
                            $departureId = $found['departure_id'];
                        }
                    }
                }

                if (!empty($departureId)) {
                    $sql2 = "SELECT 
                                a.provider_id,
                                p.name AS provider_name
                             FROM assignments a
                             LEFT JOIN providers p ON a.provider_id = p.provider_id
                             WHERE a.departure_id = :id
                             LIMIT 1";

                    $st2 = $this->pdo->prepare($sql2);
                    $st2->execute(["id" => $departureId]);

                    $provider = $st2->fetch(PDO::FETCH_ASSOC);

                    if (!empty($provider['provider_name'])) {
                        $bk['provider_name'] = $provider['provider_name'];
                    }
                }
            }

            return $data;
        } catch (PDOException $ex) {
            error_log("Bookings::getList error: " . $ex->getMessage());
            return [];
        }
    }

    /**
     * Lấy 1 booking theo ID
     */
    public function getOne($id)
    {
        if (!$id) return false;

        $sql = "SELECT * FROM bookings WHERE booking_id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(["id" => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Thêm mới booking
     */
    public function insert(
        $tour_id,
        $customer_name,
        $contact,
        $quantity,
        $type,
        $start_date,
        $status,
        $created_at,
        $deposit,
        $total,
        $remaining
    ) {
        $sql = "INSERT INTO bookings(
                    tour_id, customer_name, contact, quantity, type,
                    start_date, status, created_at, deposit, total, remaining, guide_id
                )
                VALUES (
                    :tour_id, :customer_name, :contact, :quantity, :type,
                    :start_date, :status, :created_at, :deposit, :total, :remaining, NULL
                )";

        $stmt = $this->pdo->prepare($sql);

        $success = $stmt->execute([
            ':tour_id' => $tour_id,
            ':customer_name' => $customer_name,
            ':contact' => $contact,
            ':quantity' => $quantity,
            ':type' => $type,
            ':start_date' => $start_date,
            ':status' => $status,
            ':created_at' => $created_at,
            ':deposit' => $deposit,
            ':total' => $total,
            ':remaining' => $remaining
        ]);

        return $success ? $this->pdo->lastInsertId() : false;
    }

    /**
     * Cập nhật booking
     */
    public function update(
        $booking_id,
        $tour_id,
        $customer_name,
        $contact,
        $quantity,
        $type,
        $start_date,
        $status,
        $deposit,
        $total,
        $remaining
    ) {
        $sql = "UPDATE bookings
                SET tour_id = :tour_id,
                    customer_name = :customer_name,
                    contact = :contact,
                    quantity = :quantity,
                    type = :type,
                    start_date = :start_date,
                    status = :status,
                    deposit = :deposit,
                    total = :total,
                    remaining = :remaining
                WHERE booking_id = :id";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':tour_id' => $tour_id,
            ':customer_name' => $customer_name,
            ':contact' => $contact,
            ':quantity' => $quantity,
            ':type' => $type,
            ':start_date' => $start_date,
            ':status' => $status,
            ':deposit' => $deposit,
            ':total' => $total,
            ':remaining' => $remaining,
            ':id' => $booking_id
        ]);
    }

    /**
     * Xóa booking
     */
    public function delete($id)
    {
        $sql = "DELETE FROM bookings WHERE booking_id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    /**
     * Gán guide cho booking
     */
    public function assignGuide($booking_id, $guide_id)
    {
        $sql = "UPDATE bookings 
                SET guide_id = :guide_id 
                WHERE booking_id = :id";

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':guide_id' => $guide_id,
            ':id' => $booking_id
        ]);
    }

    /**
     * Gán booking cho khách
     */
    public function assignCustomer($booking_id, $customer_id)
    {
        $sql = "UPDATE customers
                SET booking_id = :booking_id
                WHERE customer_id = :customer_id";

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':booking_id' => $booking_id,
            ':customer_id' => $customer_id
        ]);
    }

    /**
     * Kiểm tra guide đã có booking chưa
     */
    public function guideHasAnyBooking($guide_id)
    {
        $sql = "SELECT COUNT(*) 
                FROM bookings 
                WHERE guide_id = :guide_id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':guide_id' => $guide_id]);

        return $stmt->fetchColumn() > 0;
    }

    /**
     * Lấy customers + guide thông tin từ 1 booking
     */
    public function getCustomersAndGuideByBooking($booking_id)
    {
        $sql = "SELECT b.guide_id, c.* FROM bookings b LEFT JOIN customers c ON b.booking_id = c.booking_id WHERE b.booking_id = :booking_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':booking_id' => $booking_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
