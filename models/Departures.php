<?php 
class Departures{
        protected $pdo;
    public function __construct()
    {
        $database = new BaseModel();
        $this->pdo = $database->getConnection();
    }
public function getList()
{
    $sql = "SELECT 
                d.departure_id, 
                d.tour_id, 
                t.name AS tour_name, 
                CONCAT(t.name, ' - ', d.start_date) AS departure_name,
                d.start_date, 
                d.end_date, 
                d.meeting_point 
            FROM departures d 
            JOIN tours t ON d.tour_id = t.tour_id";
    
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
     public function insert($tour_id, $start_date, $end_date, $meeting_point)
{
    $sql = "INSERT INTO `departures`(`tour_id`, `start_date`, `end_date`, `meeting_point`) 
    VALUES (:tour_id,:start_date,:end_date,:meeting_point)";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
        ':tour_id' => $tour_id,
        ':start_date' => $start_date,
        ':end_date' => $end_date,
        ':meeting_point' => $meeting_point
    ]);
}
public function getOne($id){
    $sql="SELECT * FROM `departures` WHERE departure_id  = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
        "id" =>$id
    ]);
return $stmt->fetch(PDO::FETCH_ASSOC);

}
public function delete($id){
            $sql = "DELETE FROM `departures` WHERE departure_id = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
    }
public function update($departure_id ,$tour_id, $start_date	, $end_date, $meeting_point){
    $sql = "UPDATE `departures` SET `tour_id`=:tour_id,`start_date`=:start_date,`end_date`=:end_date,`meeting_point`=:meeting_point WHERE departure_id =:id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
        "id" => $departure_id,           
        "tour_id" => $tour_id,
        "start_date" => $start_date,
        "end_date" => $end_date,
        "meeting_point" => $meeting_point
    ]);
}
}