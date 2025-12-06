<?php
class CustomerCheckinController
{

    // =============================
    // DANH SÁCH CHECK-IN
    // =============================
    public function index()
    {
        $departuresModel = new Departures();
        $departures = $departuresModel->getList();

        $groups = [];
        $customersModel = new Customers();
        $ccModel = new CustomerCheckin();

        foreach ($departures as $dep) {
            $depId = $dep['departure_id'];
            $tourId = $dep['tour_id'];

            // Lấy tất cả khách của tour này
            $customers = $customersModel->getCustomersByTour($tourId);

            // Lấy lịch trình (schedules) của tour
            $schedulesModel = new Schedules();
            $schedules = $schedulesModel->getByTour($tourId);

            // Map checkins hiện có theo schedule_id -> customer_id
            $checkinsMap = [];
            foreach ($schedules as $sch) {
                $sid = $sch['schedule_id'];
                foreach ($customers as $c) {
                    $checkin = $ccModel->getCheckinByDepartureCustomer($depId, $c['customer_id'], $sid);
                    if ($checkin) {
                        if (!isset($checkinsMap[$sid])) $checkinsMap[$sid] = [];
                        $checkinsMap[$sid][$c['customer_id']] = $checkin;
                    }
                }
            }

            $groups[] = [
                'departure' => $dep,
                'customers' => $customers,
                'schedules' => $schedules,
                'checkins' => $checkinsMap
            ];
        }

        $title = "Danh sách check-in";
        $view = "admin/list-customer_checkin";
        require_once PATH_VIEW . 'main.php';
    }

    // =============================
    // THÊM MỚI
    // =============================
    public function create()
    {

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

            $cc = new CustomerCheckin();
            try {
                // Sanitize POST data
                $departure_id = isset($_POST['departure_id']) ? intval($_POST['departure_id']) : null;
                $customer_id = isset($_POST['customer_id']) ? intval($_POST['customer_id']) : null;
                $guide_id = isset($_POST['guide_id']) ? (empty($_POST['guide_id']) ? null : intval($_POST['guide_id'])) : null;
                $checkin_date = isset($_POST['checkin_date']) ? trim($_POST['checkin_date']) : date('Y-m-d');
                $status = isset($_POST['status']) ? trim($_POST['status']) : '';
                $note = isset($_POST['note']) ? trim($_POST['note']) : '';

                // If no guide_id provided, get first guide from departure assignments, or any available guide
                if (!$guide_id && $departure_id) {
                    $guidesModel = new Guides();
                    $guides = $guidesModel->getGuidesByDeparture($departure_id);
                    if (!empty($guides)) {
                        $guide_id = $guides[0]['guide_id'];
                    } else {
                        // Fallback: get any available guide
                        $allGuides = $guidesModel->getList();
                        if (!empty($allGuides)) {
                            $guide_id = $allGuides[0]['guide_id'];
                        } else {
                            throw new Exception("Không có hướng dẫn viên nào trong hệ thống");
                        }
                    }
                }

                // schedule_id from POST (optional)
                $schedule_id = isset($_POST['schedule_id']) ? (empty($_POST['schedule_id']) ? null : intval($_POST['schedule_id'])) : null;

                // Check if check-in already exists for this departure+customer+schedule
                $existingCheckin = $cc->getCheckinByDepartureCustomer($departure_id, $customer_id, $schedule_id);

                if ($existingCheckin) {
                    // UPDATE existing check-in
                    $result = $cc->update(
                        $existingCheckin['checkin_id'],
                        $departure_id,
                        $customer_id,
                        $guide_id,
                        $schedule_id,
                        $checkin_date,
                        $status,
                        $note
                    );
                } else {
                    // INSERT new check-in
                    $result = $cc->insert(
                        $departure_id,
                        $customer_id,
                        $guide_id,
                        $schedule_id,
                        $checkin_date,
                        $status,
                        $note
                    );
                }

                if ($isAjax) {
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode(['success' => true, 'message' => 'Cập nhật thành công', 'data' => ['status' => $_POST['status'], 'note' => $_POST['note']]]);
                    exit;
                }

                $_SESSION['success'][] = "Thêm mới check-in thành công!";
                header("Location: " . BASE_URL . "?action=admin-list-customer_checkin");
                exit;
            } catch (Exception $e) {
                if ($isAjax) {
                    header('Content-Type: application/json; charset=utf-8');
                    http_response_code(400);
                    echo json_encode(['success' => false, 'message' => 'Lỗi: ' . $e->getMessage()]);
                    exit;
                }

                $_SESSION['errors'][] = "Lỗi: " . $e->getMessage();
                header("Location: " . BASE_URL . "?action=admin-list-customer_checkin");
                exit;
            }
        }

        // Lấy danh sách chuyến đi
        $departures = new Departures();
        $listDepartures = $departures->getList();

        // Nếu admin chọn departure_id → load khách + HDV
        $customers = [];
        $guides = [];

        if (isset($_GET['departure_id'])) {
            $depID = $_GET['departure_id'];

            // Lấy khách thuộc chuyến đi
            $c = new Customers();
            $customers = $c->getCustomersByDeparture($depID);

            // Lấy HDV thuộc chuyến đi
            $g = new Guides();
            $guides = $g->getGuidesByDeparture($depID);
        }

        $title = "Thêm check-in khách hàng";
        $view = "admin/create-customer_checkin";
        require_once PATH_VIEW . 'main.php';
    }

    // =============================
    // UPDATE
    // =============================
    public function update()
    {
        $cc = new CustomerCheckin();

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $cc->update(
                $_POST['checkin_id'],
                $_POST['departure_id'],
                $_POST['customer_id'],
                $_POST['guide_id'],
                isset($_POST['schedule_id']) ? $_POST['schedule_id'] : null,
                $_POST['checkin_date'],
                $_POST['status'],
                $_POST['note']
            );

            $_SESSION['success'][] = "Cập nhật check-in thành công!";
            header("Location: " . BASE_URL . "?action=admin-list-customer_checkin");
            exit;
        }

        // Cho phép truy cập bằng checkin_id hoặc departure_id + customer_id
        $one = false;
        if (!empty($_GET['id'])) {
            $id = $_GET['id'];
            $one = $cc->getOne($id);
        } elseif (!empty($_GET['departure_id']) && !empty($_GET['customer_id'])) {
            $sched = isset($_GET['schedule_id']) ? $_GET['schedule_id'] : null;
            $one = $cc->getCheckinByDepartureCustomer($_GET['departure_id'], $_GET['customer_id'], $sched);
        }

        if (!$one) {
            $_SESSION['errors'][] = "Không tìm thấy bản ghi điểm danh phù hợp.";
            header("Location: " . BASE_URL . "?action=admin-list-customer_checkin");
            exit;
        }

        // Load danh sách chuyến đi
        $departures = new Departures();
        $listDepartures = $departures->getList();

        // ⭐ Load khách theo chuyến
        $customers = new Customers();
        $listCustomers = $customers->getCustomersByDeparture($one['departure_id']);

        // ⭐ Load HDV theo chuyến
        $guides = new Guides();
        $listGuides = $guides->getGuidesByDeparture($one['departure_id']);

        // Load schedules for the tour of this departure
        $depModel = new Departures();
        $depInfo = $depModel->getOne($one['departure_id']);
        $listSchedules = [];
        if (!empty($depInfo['tour_id'])) {
            $sModel = new Schedules();
            $listSchedules = $sModel->getByTour($depInfo['tour_id']);
        }

        $title = "Cập nhật check-in khách hàng";
        $view = "admin/update-customer_checkin";
        require_once PATH_VIEW . 'main.php';
    }

    public function delete()
    {
        $id = $_GET['id'] ?? 0;

        if ($id > 0) {
            $cc = new CustomerCheckin();
            $cc->delete($id);
            $_SESSION['success'][] = "Xóa thành công!";
        }

        header("Location: " . BASE_URL . "?action=admin-list-customer_checkin");
        exit;
    }
}
