<?php
class GuideTours
{
    protected $pdo;

    public function __construct()
    {
        $db = new BaseModel();
        $this->pdo = $db->getConnection();
    }

    /**
     * Get tours assigned to a guide (via assignments -> departures -> tours)
     */
    public function getByGuide($guide_id)
    {
        $sql = "SELECT a.assignment_id, a.departure_id, d.start_date, d.end_date, d.meeting_point, t.tour_id, t.name AS tour_name, a.role, p.name AS provider_name, g.full_name AS guide_name
				FROM assignments a
				JOIN departures d ON a.departure_id = d.departure_id
				JOIN tours t ON d.tour_id = t.tour_id
				JOIN guides g ON a.guide_id = g.guide_id
				LEFT JOIN providers p ON a.provider_id = p.provider_id
				WHERE a.guide_id = :guide_id
				ORDER BY d.start_date ASC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['guide_id' => $guide_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get all assigned tours (from assignments and bookings)
     */
    public function getList()
    {
        // From assignments
        $sqlA = "SELECT a.assignment_id AS id, a.guide_id, a.departure_id, d.start_date, d.end_date, d.meeting_point, t.tour_id, t.name AS tour_name, a.role, p.name AS provider_name, g.full_name AS guide_name, 'assignment' AS source
				FROM assignments a
				JOIN departures d ON a.departure_id = d.departure_id
				JOIN tours t ON d.tour_id = t.tour_id
				JOIN guides g ON a.guide_id = g.guide_id
				LEFT JOIN providers p ON a.provider_id = p.provider_id";

        $stmtA = $this->pdo->prepare($sqlA);
        $stmtA->execute();
        $rowsA = $stmtA->fetchAll(PDO::FETCH_ASSOC);

        // From bookings (where guide assigned and departure_id exists)
        $sqlB = "SELECT b.booking_id AS id, b.guide_id, d.departure_id AS departure_id, d.start_date, d.end_date, d.meeting_point, t.tour_id, t.name AS tour_name, NULL AS role, NULL AS provider_name, g.full_name AS guide_name, 'booking' AS source
				FROM bookings b
				JOIN guides g ON b.guide_id = g.guide_id
				LEFT JOIN departures d ON d.tour_id = b.tour_id AND d.start_date = b.start_date
				LEFT JOIN tours t ON b.tour_id = t.tour_id
				WHERE b.guide_id IS NOT NULL";

        $stmtB = $this->pdo->prepare($sqlB);
        $stmtB->execute();
        $rowsB = $stmtB->fetchAll(PDO::FETCH_ASSOC);

        // Merge results; admin wants to see all assigned tours
        $all = array_merge($rowsA, $rowsB);

        // Optionally sort by start_date
        usort($all, function ($a, $b) {
            $da = $a['start_date'] ?? null;
            $db = $b['start_date'] ?? null;
            if ($da == $db) return 0;
            if ($da === null) return 1;
            if ($db === null) return -1;
            return strtotime($da) <=> strtotime($db);
        });

        return $all;
    }

    /**
     * Get tour detail by departure_id
     */
    public function getByDeparture($departure_id)
    {
        $sql = "SELECT a.assignment_id AS id, a.guide_id, a.departure_id, d.start_date, d.end_date, d.meeting_point, t.tour_id, t.name AS tour_name, a.role, p.name AS provider_name, g.full_name AS guide_name, 'assignment' AS source
				FROM assignments a
				JOIN departures d ON a.departure_id = d.departure_id
				JOIN tours t ON d.tour_id = t.tour_id
				JOIN guides g ON a.guide_id = g.guide_id
				LEFT JOIN providers p ON a.provider_id = p.provider_id
				WHERE a.departure_id = :departure_id
				UNION ALL
				SELECT b.booking_id AS id, b.guide_id, d.departure_id AS departure_id, d.start_date, d.end_date, d.meeting_point, t.tour_id, t.name AS tour_name, NULL AS role, NULL AS provider_name, g.full_name AS guide_name, 'booking' AS source
				FROM bookings b
				JOIN guides g ON b.guide_id = g.guide_id
				LEFT JOIN departures d ON d.tour_id = b.tour_id AND d.start_date = b.start_date
				LEFT JOIN tours t ON b.tour_id = t.tour_id
				WHERE d.departure_id = :departure_id AND b.guide_id IS NOT NULL
				LIMIT 1";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['departure_id' => $departure_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
