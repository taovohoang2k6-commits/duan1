<?php
class CustomerCheckin
{
    protected $pdo;
    protected $hasScheduleColumn = false;


    /**
     * Get check-in record for a specific departure, customer and optional schedule
     */
    public function getCheckinByDepartureCustomer($departure_id, $customer_id, $schedule_id = null)
    {
        if ($this->hasScheduleColumn && $schedule_id !== null) {
            $sql = "SELECT * FROM customer_checkin WHERE departure_id = :dep AND customer_id = :cid AND schedule_id = :sid ORDER BY checkin_date DESC LIMIT 1";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['dep' => $departure_id, 'cid' => $customer_id, 'sid' => $schedule_id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        // Fallback: ignore schedule and return latest checkin for departure+customer
        $sql = "SELECT * FROM customer_checkin WHERE departure_id = :dep AND customer_id = :cid ORDER BY checkin_date DESC LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['dep' => $departure_id, 'cid' => $customer_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function __construct()
    {
        $database = new BaseModel();
        $this->pdo = $database->getConnection();

        // Detect whether the customer_checkin table has a schedule_id column
        try {
            $stmt = $this->pdo->prepare("SHOW COLUMNS FROM customer_checkin LIKE 'schedule_id'");
            $stmt->execute();
            $col = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->hasScheduleColumn = !empty($col);
        } catch (Exception $e) {
            $this->hasScheduleColumn = false;
        }
    }


    public function getList()
    {
        $sql = "
        SELECT 
            cc.checkin_id, cc.departure_id, cc.customer_id, cc.guide_id, 
            cc.checkin_date, cc.status, cc.note, cc.created_at,

            c.full_name AS customer_name, 
            c.gender AS customer_gender, 
            c.phone AS customer_phone,

            g.full_name AS guide_name, 
            g.phone AS guide_phone,

            d.start_date, 
            d.end_date, 
            d.meeting_point,
            t.name AS tour_name

        FROM customer_checkin AS cc
        LEFT JOIN customers AS c ON cc.customer_id = c.customer_id
        LEFT JOIN guides AS g ON cc.guide_id = g.guide_id
        LEFT JOIN departures AS d ON cc.departure_id = d.departure_id
        LEFT JOIN tours AS t ON d.tour_id = t.tour_id

        ORDER BY cc.checkin_date DESC, cc.checkin_id DESC
    ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOne($id)
    {
        $sql = "SELECT * FROM customer_checkin WHERE checkin_id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ":id" => $id
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insert($departure_id, $customer_id, $guide_id, $schedule_id, $checkin_date, $status, $note)
    {
        if ($this->hasScheduleColumn) {
            $sql = "INSERT INTO customer_checkin (departure_id, customer_id, guide_id, schedule_id, checkin_date, status, note, created_at) VALUES (:departure_id, :customer_id, :guide_id, :schedule_id, :checkin_date, :status, :note, NOW())";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([
                ":departure_id" => $departure_id,
                ":customer_id"   => $customer_id,
                ":guide_id"      => $guide_id,
                ":schedule_id"   => $schedule_id,
                ":checkin_date"  => $checkin_date,
                ":status"        => $status,
                ":note"          => $note
            ]);
        }

        // Fallback: insert without schedule_id column
        $sql = "INSERT INTO customer_checkin (departure_id, customer_id, guide_id, checkin_date, status, note, created_at) VALUES (:departure_id, :customer_id, :guide_id, :checkin_date, :status, :note, NOW())";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ":departure_id" => $departure_id,
            ":customer_id"   => $customer_id,
            ":guide_id"      => $guide_id,
            ":checkin_date"  => $checkin_date,
            ":status"        => $status,
            ":note"          => $note
        ]);
    }


    public function update($id, $departure_id, $customer_id, $guide_id, $schedule_id, $checkin_date, $status, $note)
    {
        if ($this->hasScheduleColumn) {
            $sql = "UPDATE customer_checkin SET departure_id = :departure_id, customer_id = :customer_id, guide_id = :guide_id, schedule_id = :schedule_id, checkin_date = :checkin_date, status = :status, note = :note WHERE checkin_id = :id";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([
                ":id"            => $id,
                ":departure_id"  => $departure_id,
                ":customer_id"   => $customer_id,
                ":guide_id"      => $guide_id,
                ":schedule_id"   => $schedule_id,
                ":checkin_date"  => $checkin_date,
                ":status"        => $status,
                ":note"          => $note
            ]);
        }

        // Fallback: update without schedule_id column
        $sql = "UPDATE customer_checkin SET departure_id = :departure_id, customer_id = :customer_id, guide_id = :guide_id, checkin_date = :checkin_date, status = :status, note = :note WHERE checkin_id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ":id"            => $id,
            ":departure_id"  => $departure_id,
            ":customer_id"   => $customer_id,
            ":guide_id"      => $guide_id,
            ":checkin_date"  => $checkin_date,
            ":status"        => $status,
            ":note"          => $note
        ]);
    }



    public function delete($id)
    {
        $sql = "DELETE FROM customer_checkin WHERE checkin_id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ":id" => $id
        ]);
    }
    public function getListByGuide($guide_id)
    {
        $sql = "
        SELECT 
            cc.checkin_id, cc.departure_id, cc.customer_id, cc.guide_id, 
            cc.checkin_date, cc.status, cc.note, cc.created_at,

            c.full_name AS customer_name, 
            c.gender AS customer_gender, 
            c.phone AS customer_phone,

            g.full_name AS guide_name, 
            g.phone AS guide_phone,

            d.start_date, 
            d.end_date, 
            d.meeting_point,
            t.name AS tour_name

        FROM customer_checkin AS cc
        LEFT JOIN customers AS c ON cc.customer_id = c.customer_id
        LEFT JOIN guides AS g ON cc.guide_id = g.guide_id
        LEFT JOIN departures AS d ON cc.departure_id = d.departure_id
        LEFT JOIN tours AS t ON d.tour_id = t.tour_id

        WHERE cc.guide_id = :guide_id

        ORDER BY cc.checkin_date DESC, cc.checkin_id DESC
    ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":guide_id" => $guide_id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
