<?php
class TourFinance {
    protected $pdo;

    public function __construct() {
        $database = new BaseModel();
        $this->pdo = $database->getConnection();
    }

    public function getList() {
        $sql = "SELECT tf.finance_id, tf.tour_id, tf.total_revenue, tf.total_expense, tf.profit, tf.report_date,
                       t.name AS tour_name
                FROM tour_finance tf
                JOIN tours t ON tf.tour_id = t.tour_id
                ORDER BY tf.finance_id DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOne($id) {
        $sql = "SELECT * FROM tour_finance WHERE finance_id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function insert($tour_id, $total_revenue, $total_expense, $profit, $report_date) {
        $sql = "INSERT INTO tour_finance(tour_id, total_revenue, total_expense, profit, report_date)
                VALUES (:tour_id, :total_revenue, :total_expense, :profit, :report_date)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'tour_id' => $tour_id,
            'total_revenue' => $total_revenue,
            'total_expense' => $total_expense,
            'profit' => $profit,
            'report_date' => $report_date
        ]);
    }

    public function update($finance_id, $tour_id, $total_revenue, $total_expense, $profit, $report_date) {
        $sql = "UPDATE tour_finance 
                SET tour_id = :tour_id,
                    total_revenue = :total_revenue,
                    total_expense = :total_expense,
                    profit = :profit,
                    report_date = :report_date
                WHERE finance_id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'id' => $finance_id,
            'tour_id' => $tour_id,
            'total_revenue' => $total_revenue,
            'total_expense' => $total_expense,
            'profit' => $profit,
            'report_date' => $report_date
        ]);
    }


    public function delete($id) {
        $sql = "DELETE FROM tour_finance WHERE finance_id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
