<?php 
class History{
     protected $pdo;

    public function __construct()
    {
        $database = new BaseModel();
        $this->pdo = $database->getConnection();
    }

public function getList()
{
    $sql = "SELECT 
    bh.history_id,
    bh.booking_id,
    b.customer_name,
    b.contact,
    bh.status AS history_status,
    bh.changed_at,
    bh.changed_by
FROM booking_history bh
JOIN bookings b ON bh.booking_id = b.booking_id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
public function insert($booking_id, $status, $changed_at, $changed_by) {
        $sql = "INSERT INTO booking_history(booking_id, status, changed_at, changed_by)
                VALUES (:booking_id, :status, :changed_at, :changed_by)";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':booking_id' => $booking_id,
            ':status' => $status,
            ':changed_at' => $changed_at,
            ':changed_by' => $changed_by
        ]);
    }
    public function delete($id){
            $sql = "DELETE FROM `booking_history` WHERE history_id = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
    }
    public function getOne($id){
    $sql="SELECT * FROM `booking_history` WHERE history_id   = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
        "id" =>$id
    ]);
return $stmt->fetch(PDO::FETCH_ASSOC);

}
public function update($history_id ,$booking_id ,$status, $changed_at, $changed_by){
    $sql = "UPDATE `booking_history` SET `booking_id`=:booking_id,`status`=:status,`changed_at`=:changed_at,`changed_by`=:changed_by WHERE history_id =:id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
        "id" => $history_id,           
        "booking_id" => $booking_id,
        "status" => $status,
        "changed_at" => $changed_at,
        "changed_by" => $changed_by
    ]);
}
}