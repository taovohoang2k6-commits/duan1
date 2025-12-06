    <?php 
    class providers{
            protected $pdo;

        public function __construct()
        {
            $database = new BaseModel();
            $this->pdo = $database->getConnection();
        }
        public function getList()
        {
            $sql = "SELECT * FROM `providers`";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
      public function insert($name, $type, $contact, $address)
{
    $sql = "INSERT INTO `providers`(`name`, `type`, `contact`, `address`) 
            VALUES (:name, :type, :contact, :address)";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
        ':name'    => $name,
        ':type'    => $type,
        ':contact' => $contact,
        ':address' => $address
    ]);
}
        public function getOne($id){
        $sql="SELECT * FROM `providers` WHERE provider_id  = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            "id" =>$id
        ]);
    return $stmt->fetch(PDO::FETCH_ASSOC);

    }
    public function update($provider_id ,$name, $type, $contact, $address){
    $sql="UPDATE `providers` 
          SET `name`=:name, `type`=:type, `contact`=:contact, `address`=:address
          WHERE provider_id = :id";
            
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
        "id"      => $provider_id,
        "name"    => $name,
        "type"    => $type,
        "contact" => $contact,
        "address" => $address
    ]);
}
    public function delete($id)
{
    $sql = "DELETE FROM providers WHERE provider_id = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
}
    }