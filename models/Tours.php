    <?php
    class Tours
    {
        protected $pdo;

        public function __construct()
        {
            $database = new BaseModel();
            $this->pdo = $database->getConnection();
        }

        // Lấy danh sách tour kèm giá và lịch trình
        public function getList()
        {
            $sql = "SELECT 
                        t.tour_id, 
                        t.name AS tour_name,
                        t.description AS tour_description,
                        t.policy,
                        t.status,
                        t.images,
                        c.name AS category_name,
                        p.name AS provider_name
                    FROM tours t
                    JOIN tour_categories c ON t.category_id = c.category_id
                    JOIN providers p ON t.provider_id = p.provider_id
                    ORDER BY t.tour_id DESC";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $tours = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($tours as &$tour) {
                $stmt2 = $this->pdo->prepare(
                    "SELECT target_group, price, valid_from, valid_to 
     FROM tour_prices 
     WHERE tour_id = :id 
     ORDER BY price_id ASC"
                );
                $stmt2->execute(['id' => $tour['tour_id']]);
                $tour['prices'] = $stmt2->fetchAll(PDO::FETCH_ASSOC);

                $tour['schedules'] = $this->getSchedules($tour['tour_id']);
            }

            return $tours;
        }

        public function getOne($id)
        {
            $sql = "SELECT * FROM tours WHERE tour_id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(["id" => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function insert($category_id, $name, $description, $policy, $provider_id, $status, $path)
        {
            $sql = "INSERT INTO tours (category_id, name, description, policy, provider_id, status, images) 
                    VALUES (:category_id, :name, :description, :policy, :provider_id, :status, :images)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':category_id' => $category_id,
                ':name' => $name,
                ':description' => $description,
                ':policy' => $policy,
                ':provider_id' => $provider_id,
                ':status' => $status,
                ':images' => $path,
            ]);
            return $this->pdo->lastInsertId();
        }

        public function update($tour_id, $category_id, $name, $description, $policy, $provider_id, $status, $path)
        {
            $sql = "UPDATE tours SET 
                        category_id = :category_id,
                        name = :name,
                        description = :description,
                        policy = :policy,
                        provider_id = :provider_id,
                        status = :status,
                        images = :images
                    WHERE tour_id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                "id" => $tour_id,
                "category_id" => $category_id,
                "name" => $name,
                "description" => $description,
                "policy" => $policy,
                "provider_id" => $provider_id,
                "status" => $status,
                "images" => $path
            ]);
        }

        public function delete($id)
        {
            $checkBooking = $this->pdo->prepare("SELECT COUNT(*) FROM bookings WHERE tour_id = :id");
            $checkBooking->bindParam(':id', $id);
            $checkBooking->execute();
            $hasBooking = $checkBooking->fetchColumn();

            if ($hasBooking > 0) return "HAS_BOOKING";

            $deletePrices = $this->pdo->prepare("DELETE FROM tour_prices WHERE tour_id = :id");
            $deletePrices->bindParam(':id', $id);
            $deletePrices->execute();

            $deleteSchedules = $this->pdo->prepare("DELETE FROM tour_schedules WHERE tour_id = :id");
            $deleteSchedules->bindParam(':id', $id);
            $deleteSchedules->execute();

            $deleteTour = $this->pdo->prepare("DELETE FROM tours WHERE tour_id = :id");
            $deleteTour->bindParam(':id', $id);

            return $deleteTour->execute() ? "DELETED" : "FAILED";
        }

        public function insertSchedule($tour_id, $day_number, $activities, $start_time, $end_time, $location)
        {
            $sql = "INSERT INTO tour_schedules (tour_id, day_number, activities, start_time, end_time , location)
                    VALUES (:tour_id, :day_number, :activities, :start_time, :end_time , :location)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':tour_id' => $tour_id,
                ':day_number' => $day_number,
                ':activities' => $activities,
                ':start_time' => $start_time,
                ':end_time' => $end_time,
                ':location' => $location
            ]);
        }

        public function deleteSchedules($tour_id)
        {
            $sql = "DELETE FROM tour_schedules WHERE tour_id = :tour_id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['tour_id' => $tour_id]);
        }

        public function getSchedules($tour_id)
        {
            $sql = "SELECT * FROM tour_schedules WHERE tour_id = :tour_id ORDER BY day_number ASC";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['tour_id' => $tour_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }


        public function insertPrice($tour_id, $target_group, $price, $valid_from, $valid_to)
        {
            $sql = "INSERT INTO tour_prices 
            (tour_id, target_group, price, valid_from, valid_to) 
            VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$tour_id, $target_group, $price, $valid_from, $valid_to]);
        }

        public function deletePrices($tour_id)
        {
            $sql = "DELETE FROM tour_prices WHERE tour_id = ?";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$tour_id]);
        }

        public function getPrices($tour_id)
        {
            $sql = "SELECT * FROM tour_prices WHERE tour_id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$tour_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        /**
         * Get default price for a tour.
         * If a date is provided (YYYY-MM-DD) it will try to find a price
         * whose valid_from/valid_to contains that date. Otherwise it will
         * return the lowest available price for the tour.
         *
         * @param int $tour_id
         * @param string|null $date (YYYY-MM-DD)
         * @return float
         */
        public function getDefaultPrice($tour_id, $date = null)
        {
            $date = $date ?? date('Y-m-d');

            // Try to find a price valid for the given date first
            $sql = "SELECT price FROM tour_prices
                WHERE tour_id = :id
                AND (
                    valid_from IS NULL OR valid_from = '' OR STR_TO_DATE(valid_from, '%Y-%m-%d') <= STR_TO_DATE(:d, '%Y-%m-%d')
                )
                AND (
                    valid_to IS NULL OR valid_to = '' OR STR_TO_DATE(valid_to, '%Y-%m-%d') >= STR_TO_DATE(:d, '%Y-%m-%d')
                )
                ORDER BY price ASC LIMIT 1";

            $stmt = $this->pdo->prepare($sql);
            try {
                $stmt->execute(['id' => $tour_id, 'd' => $date]);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($row && isset($row['price'])) {
                    return floatval($row['price']);
                }
            } catch (Exception $ex) {
                // If STR_TO_DATE fails due to unexpected format, ignore and fallback
            }

            // Fallback: return the lowest price available for the tour
            $sql2 = "SELECT price FROM tour_prices WHERE tour_id = :id ORDER BY price ASC LIMIT 1";
            $stmt2 = $this->pdo->prepare($sql2);
            $stmt2->execute(['id' => $tour_id]);
            $r2 = $stmt2->fetch(PDO::FETCH_ASSOC);
            return $r2 && isset($r2['price']) ? floatval($r2['price']) : 0.0;
        }
    }
