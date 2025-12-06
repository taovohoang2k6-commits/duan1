<?php 
class Guides {
    protected $pdo;

    public function __construct() {
        $database = new BaseModel();
        $this->pdo = $database->getConnection();
    }

    public function getList(){
        $sql = "SELECT * FROM `guides`";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOne($id){
        $sql = "SELECT * FROM `guides` WHERE guide_id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ==== INSERT CÓ EMAIL + PASSWORD ====
   public function insert($full_name, $email, $password, $phone, $language, $status, $role){
    $sql = "INSERT INTO `guides`
            (`full_name`, `email`, `password`, `phone`, `language`, `status`, `role`)
            VALUES (:full_name, :email, :password, :phone, :language, :status, :role)";
    
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
        ':full_name' => $full_name,
        ':email'     => $email,
        ':password'  => password_hash($password, PASSWORD_BCRYPT),
        ':phone'     => $phone,
        ':language'  => $language,
        ':status'    => $status,
        ':role'      => $role
    ]);
    return true;
}

    // ==== UPDATE ====
    public function update($id, $full_name, $email, $password, $phone, $language, $status, $role){
    if (!empty($password)) {
        $password_sql = ", `password` = :password";
    } else {
        $password_sql = "";
    }

    $sql = "UPDATE `guides`
            SET `full_name` = :full_name,
                `email` = :email,
                `phone` = :phone,
                `language` = :language,
                `status` = :status,
                `role` = :role
                $password_sql
            WHERE guide_id = :id";

    $stmt = $this->pdo->prepare($sql);

    $params = [
        ':id'        => $id,
        ':full_name' => $full_name,
        ':email'     => $email,
        ':phone'     => $phone,
        ':language'  => $language,
        ':status'    => $status,
        ':role'      => $role
    ];

    if (!empty($password)) {
        $params[':password'] = password_hash($password, PASSWORD_BCRYPT);
    }

    $stmt->execute($params);
    return true;
}   

    public function delete($id){
        $sql = "DELETE FROM `guides` WHERE guide_id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    public function getGuidesByDeparture($departure_id){
        $sql = "
            SELECT g.*
            FROM guides g
            JOIN assignments a ON g.guide_id = a.guide_id
            WHERE a.departure_id = :departure_id
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['departure_id' => $departure_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
