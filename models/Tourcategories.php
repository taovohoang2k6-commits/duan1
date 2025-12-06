<?php
class Tourcategories
{
    protected $pdo;

    public function __construct()
    {
        $database = new BaseModel();
        $this->pdo = $database->getConnection();
    }

public function getList()
{
    $sql = "SELECT category_id, name, description FROM tour_categories";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    public function insert($name, $description)
    {
        $sql = "INSERT INTO `tour_categories`(`name`, `description`) VALUES (:name, :description)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':name' => $name,
            ':description' => $description
        ]);
    }

public function delete($id)
{
    $sql = "DELETE FROM tour_categories WHERE category_id = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
}
public function getOne($id){
    $sql="SELECT * FROM `tour_categories` WHERE category_id = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
        "id" =>$id
    ]);
return $stmt->fetch(PDO::FETCH_ASSOC);

}
public function update($id,$name,$description){
    $sql="UPDATE `tour_categories` SET `name`=:name,`description`=:description WHERE category_id = :id";
        $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
        "id" =>$id,
        "name" =>$name,
        "description" =>$description
    ]);
}
}
