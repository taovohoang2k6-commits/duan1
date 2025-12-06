<?php
class SpecialRequests {
    protected $pdo;

    public function __construct() {
        $database = new BaseModel();
        $this->pdo = $database->getConnection();
    }

    public function getList() {
        $sql = "SELECT sr.request_id, sr.customer_id, sr.request_type, sr.description, sr.handled,
                       c.full_name
                FROM special_requests sr
                JOIN customers c ON sr.customer_id = c.customer_id
                ORDER BY sr.request_id DESC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getOne($id) {
        $sql = "SELECT * FROM special_requests WHERE request_id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function insert($customer_id, $request_type, $description, $handled) {
        $sql = "INSERT INTO special_requests(customer_id, request_type, description, handled)
                VALUES (:customer_id, :request_type, :description, :handled)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'customer_id' => $customer_id,
            'request_type' => $request_type,
            'description' => $description,
            'handled' => $handled
        ]);
    }


    public function update($request_id, $customer_id, $request_type, $description, $handled) {
        $sql = "UPDATE special_requests 
                SET customer_id = :customer_id,
                    request_type = :request_type,
                    description = :description,
                    handled = :handled
                WHERE request_id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'id' => $request_id,
            'customer_id' => $customer_id,
            'request_type' => $request_type,
            'description' => $description,
            'handled' => $handled
        ]);
    }


    public function delete($id) {
        $sql = "DELETE FROM special_requests WHERE request_id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
