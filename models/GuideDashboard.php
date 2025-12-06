    <?php
    class GuideDashboard extends BaseModel
    {
        public function getAssignedTours($guide_id)
        {
            $sql = "
                SELECT 
                    a.assignment_id,
                    d.departure_id,
                    d.start_date,
                    d.end_date,
                    t.name AS tour_name,
                    t.tour_id
                FROM assignments a
                JOIN departures d ON a.departure_id = d.departure_id
                JOIN tours t ON d.tour_id = t.tour_id
                WHERE a.guide_id = ?
                ORDER BY d.start_date DESC
            ";

            return $this->select($sql, [$guide_id]);
        }
    }
