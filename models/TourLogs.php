<?php 
class TourLogs{
    protected $pdo;

    public function __construct() {
        $database = new BaseModel();
        $this->pdo = $database->getConnection();
    }

    public function getList() {
        $sql = "SELECT 
    tl.log_id,
    tl.date,
    tl.note,
    tl.issues,

    d.departure_id,
    d.start_date,
    d.end_date,
    d.meeting_point,

    g.guide_id,
    g.full_name AS guide_name,

    t.tour_id,
    t.name AS tour_name
FROM tour_logs tl
JOIN departures d ON tl.departure_id = d.departure_id
JOIN guides g ON tl.guide_id = g.guide_id
JOIN tours t ON d.tour_id = t.tour_id
ORDER BY tl.log_id DESC;
";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function insert($departure_id, $guide_id, $date, $note, $issues) {
    $sql = "INSERT INTO tour_logs(departure_id, guide_id, date, note, issues)
            VALUES (:departure_id, :guide_id, :date, :note, :issues)";
    
    $stmt = $this->pdo->prepare($sql);

    return $stmt->execute([
        'departure_id' => $departure_id,
        'guide_id'     => $guide_id,
        'date'         => $date,
        'note'         => $note,
        'issues'       => $issues
    ]);
}
}