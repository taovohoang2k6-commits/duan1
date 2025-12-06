<?php 
class Assignments{
    protected $pdo;

    public function __construct()
    {
        $database = new BaseModel();
        $this->pdo = $database->getConnection();
    }

    public function getList()
    {
        $sql = "SELECT 
                a.assignment_id,
                a.departure_id,
                CONCAT(t.name, ' - ', d.start_date) AS departure_name,
                d.tour_id,
                t.name AS tour_name,
                a.guide_id,
                g.full_name AS guide_name,
                a.provider_id,
                p.name AS provider_name,
                a.role
            FROM assignments a
            JOIN departures d ON a.departure_id = d.departure_id
            JOIN tours t ON d.tour_id = t.tour_id
            JOIN guides g ON a.guide_id = g.guide_id
            JOIN providers p ON a.provider_id = p.provider_id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($departure_id, $guide_id, $provider_id, $role)
    {
        $sql = "INSERT INTO assignments(departure_id, guide_id, provider_id, role)
                VALUES (:departure_id, :guide_id, :provider_id, :role)";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':departure_id' => $departure_id,
            ':guide_id' => $guide_id,
            ':provider_id' => $provider_id,
            ':role' => $role
        ]);
    }
}
