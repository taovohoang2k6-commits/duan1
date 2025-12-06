<?php
class Schedules
{
    protected $pdo;

    public function __construct()
    {
        $database = new BaseModel();
        $this->pdo = $database->getConnection();
    }

    public function getList()
    {
        $sql = "SELECT ts.schedule_id, ts.tour_id, t.name AS tour_name, ts.day_number, ts.activities, ts.start_time, ts.end_time , ts.location FROM tour_schedules ts JOIN tours t ON ts.tour_id = t.tour_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByTour($tour_id)
    {
        $sql = "SELECT schedule_id, tour_id, day_number, activities, start_time, end_time, location FROM tour_schedules WHERE tour_id = :tour_id ORDER BY day_number ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['tour_id' => $tour_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function insert($tour_id, $day_number, $activities, $start_time, $end_time, $location)
    {
        $sql = "INSERT INTO `tour_schedules`(`tour_id`, `day_number`, `activities`, `start_time`, `end_time` , `location`) 
    VALUES (:tour_id, :day_number, :activities, :start_time , :end_time , :location)";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':tour_id' => $tour_id,
            ':day_number' => $day_number,
            ':activities' => $activities,
            ':start_time' => $start_time,
            ':end_time' => $end_time,
            "location" => $location,

        ]);
    }
    public function delete($id)
    {
        $sql = "DELETE FROM `tour_schedules` WHERE schedule_id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
    public function getOne($id)
    {
        $sql = "SELECT * FROM `tour_schedules` WHERE schedule_id  = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            "id" => $id
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($schedule_id, $tour_id, $day_number, $activities, $start_time, $end_time, $location)
    {
        $sql = "UPDATE `tour_schedules` SET `tour_id`=:tour_id,`day_number`=:day_number,`activities`=:activities,`start_time`=:start_time,`end_time`=:end_time  ,`location `=:location WHERE schedule_id =:id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            "id" => $schedule_id,
            "tour_id" => $tour_id,
            "day_number" => $day_number,
            "activities" => $activities,
            "start_time" => $start_time,
            "end_time" => $end_time,
            "location" => $location
        ]);
    }
}
