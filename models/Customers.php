<?php 
class Customers {
    protected $pdo;

    public function __construct()
    {
        $database = new BaseModel();
        $this->pdo = $database->getConnection();
    }



    public function getList()
    {
        $sql = "SELECT 
            c.customer_id,
            c.booking_id,
            c.full_name,
            c.gender,
            c.dob,
            c.id_number,
            c.phone,
            c.payment_status,
            b.customer_name AS booking_name,
            b.contact AS booking_contact,
            b.quantity,
            b.type AS booking_type,
            b.start_date,
            b.status AS booking_status
        FROM customers c
        JOIN bookings b ON c.booking_id = b.booking_id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function insert($booking_id, $full_name, $gender, $dob, $id_number, $phone, $payment_status)
    {
        $sql = "INSERT INTO customers(booking_id, full_name, gender, dob, id_number, phone, payment_status)
                VALUES (:booking_id, :full_name, :gender, :dob, :id_number, :phone, :payment_status)";

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':booking_id' => $booking_id,
            ':full_name' => $full_name,
            ':gender' => $gender,
            ':dob' => $dob,
            ':id_number' => $id_number,
            ':phone' => $phone,
            ':payment_status' => $payment_status
        ]);
    }


    public function getOne($id)
    {
        $sql = "SELECT * FROM customers WHERE customer_id = :id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'id' => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function update($customer_id, $booking_id, $full_name, $gender, $dob, $id_number, $phone, $payment_status)
    {
        $sql = "UPDATE customers 
                SET booking_id = :booking_id,
                    full_name = :full_name,
                    gender = :gender,
                    dob = :dob,
                    id_number = :id_number,
                    phone = :phone,
                    payment_status = :payment_status
                WHERE customer_id = :id";

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'id' => $customer_id,
            'booking_id' => $booking_id,
            'full_name' => $full_name,
            'gender' => $gender,
            'dob' => $dob,
            'id_number' => $id_number,
            'phone' => $phone,
            'payment_status' => $payment_status
        ]);
    }



    public function delete($id)
    {
        $sql = "DELETE FROM customers WHERE customer_id  = :id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
public function getCustomersByDeparture($departure_id)
{
    $sql = "
        SELECT c.*
        FROM customers c
        JOIN bookings b ON c.booking_id = b.booking_id
        JOIN departures d ON b.tour_id = d.tour_id
        WHERE d.departure_id = :departure_id
    ";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['departure_id' => $departure_id]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
public function getByBooking($booking_id)
{
    $sql = "SELECT * FROM customers WHERE booking_id = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['id' => $booking_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
public function getCustomersByTour($tour_id)
{
    $sql = "
        SELECT c.*
        FROM customers c
        JOIN bookings b ON c.booking_id = b.booking_id
        WHERE b.tour_id = :tour_id
    ";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['tour_id' => $tour_id]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
public function getCustomersByBooking($booking_id)
{
    $sql = "SELECT * FROM customers WHERE booking_id = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['id' => $booking_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}
