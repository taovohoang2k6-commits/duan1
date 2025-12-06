<?php
class Users
{
    protected $pdo;
    public function __construct()
    {
        $database = new BaseModel();
        $this->pdo = $database->getConnection();
    }
    public function findBYEmail($email)
    {
        $sql = "SELECT * FROM `users` WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':email' => $email
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function register($name, $email, $password, $phone, $address, $role = "0")
    {
        $sql = "INSERT INTO `users`(`name`, `email`, `password`, `phone`, `address`, role) VALUES (:name ,:email ,:password ,:phone, :address, :role)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':password' => md5($password),
            ':phone' => $phone,
            ':address' => $address,
            ':role' => intval($role)

        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function checkLogin($email, $password)
    {
        $sql = "SELECT * FROM `users` WHERE email= :email AND password=:password";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':email' => $email,
            ':password' => md5($password),
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getList()
    {
        $sql = "SELECT * FROM `users`";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function delete($id)
    {
        $sql = "DELETE FROM `users` WHERE id =:id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function getOne($id)
    {
        $sql = "SELECT * FROM `users` WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            "id" => $id
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function update($id, $name, $email, $password, $phone, $address, $role = "0")
    {
        $sql = "UPDATE `users` 
        SET `name` = :name,
            `email` = :email,
            `password` = :password,
            `phone` = :phone,
            `address` = :address,
            `role` = :role
        WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            "id" => $id,
            "name" => $name,
            "email" => $email,
            "password" => md5($password),
            "phone" => $phone,
            "address" => $address,
            "role" => intval($role)
        ]);
    }
}
