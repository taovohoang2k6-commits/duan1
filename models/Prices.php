<?php 
class Prices{
     protected $pdo;

    public function __construct()
    {
        $database = new BaseModel();
        $this->pdo = $database->getConnection();
    }

public function getList()
{
    $sql = "SELECT tp.price_id, tp.tour_id, t.name AS tour_name, tp.target_group, tp.price, tp.valid_from, tp.valid_to FROM tour_prices tp JOIN tours t ON tp.tour_id = t.tour_id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
 public function insert($tour_id, $target_group, $price, $valid_from, $valid_to)
{
    $sql = "INSERT INTO `tour_prices`
            (`tour_id`, `target_group`, `price`, `valid_from`, `valid_to`) 
            VALUES (:tour_id, :target_group, :price, :valid_from, :valid_to)";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
        ':tour_id' => $tour_id,
        ':target_group' => $target_group,
        ':price' => $price,
        ':valid_from' => $valid_from,
        ':valid_to' => $valid_to
    ]);
}
public function delete($id){
            $sql = "DELETE FROM `tour_prices` WHERE price_id = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
    }
    public function getOne($id){
    $sql="SELECT * FROM `tour_prices` WHERE price_id  = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
        "id" =>$id
    ]);
return $stmt->fetch(PDO::FETCH_ASSOC);

}
public function update($price_id ,$tour_id, $target_group, $price, $valid_from, $valid_to){
    $sql = "UPDATE `tour_prices` SET `tour_id`=:tour_id,`target_group`=:target_group,`price`=:price,`valid_from`=:valid_from,`valid_to`=:valid_to WHERE price_id =:id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
        "id" => $price_id,           
        "tour_id" => $tour_id,
        "target_group" => $target_group,
        "price" => $price,
        "valid_from" => $valid_from,
        "valid_to" => $valid_to
    ]);
}

}