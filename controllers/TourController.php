<?php

class TourController
{
    private $tourModel;

    public function __construct()
    {
        $this->tourModel = new Tours();
    }

    /* ============================
       HIỂN THỊ DANH SÁCH TOUR
    ============================ */
    public function index()
    {
        $tours = new Tours();
        $listData = $tours->getList();

        $view = "admin/list-tour";
        require_once PATH_VIEW . 'main.php';
    }

    /* ============================
       THÊM MỚI TOUR
    ============================ */
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {

            $file = $_FILES['images'];
            $path = "";

            if (!empty($file['name'])) {
                $newName = time() . "-" . basename($file['name']);
                $path = 'assets/uploads/' . $newName;
                move_uploaded_file($file['tmp_name'], $path);
            }

            $tours = new Tours();

            // Thêm tour
            $tour_id = $tours->insert(
                $_POST['category_id'],
                $_POST['name'],
                $_POST['description'],
                $_POST['policy'],
                $_POST['provider_id'],
                $_POST['status'],
                $path
            );

            // Thêm giá nếu có
            if (!empty($_POST['prices'])) {
                foreach ($_POST['prices'] as $price) {
                    if (!empty($price['target_group']) && !empty($price['price'])) {
                        $tours->insertPrice(
                            $tour_id,
                            $price['target_group'],
                            $price['price'],
                            $price['valid_from'],
                            $price['valid_to']
                        );
                    }
                }
            }

            // Thêm lịch trình nếu có
            if (!empty($_POST['schedules'])) {
                foreach ($_POST['schedules'] as $schedule) {

                    $dayNumber = $schedule['day_number'];

                    if (!empty($schedule['activities'])) {
                        foreach ($schedule['activities'] as $act) {
                            $tours->insertSchedule(
                                $tour_id,
                                $dayNumber,
                                $act['activity'],
                                $act['start_time'],
                                $act['end_time'],
                                $act['location']
                            );
                        }
                    }
                }
            }

            $_SESSION['success'][] = "Thêm mới tour thành công!";
            header("Location: " . BASE_URL . "?action=admin-list-tour");
            exit;
        }

        // GET hiển thị form
        $tourcategories = new Tourcategories();
        $listCategories = $tourcategories->getList();

        $providers = new Providers();
        $listProviders = $providers->getList();

        $title = "Trang thêm mới tour";
        $view = "admin/create-tour";
        require_once PATH_VIEW . 'main.php';
    }

    /* ============================
       CẬP NHẬT TOUR
    ============================ */
public function update()
{
    $tours = new Tours();

    if ($_SERVER['REQUEST_METHOD'] === "POST") {

        $file = $_FILES['images'];
        $path = "";

        if (!empty($file['name'])) {
            $newName = time() . "-" . basename($file['name']);
            $path = 'assets/uploads/' . $newName;
            move_uploaded_file($file['tmp_name'], $path);
        } else {
            $tourData = $tours->getOne($_POST['tour_id']);
            $path = $tourData['images'] ?? '';
        }

        // Cập nhật tour
        $tours->update(
            $_POST['tour_id'],
            $_POST['category_id'],
            $_POST['name'],
            $_POST['description'],
            $_POST['policy'],
            $_POST['provider_id'],
            $_POST['status'],
            $path
        );

        // Xóa giá cũ
        $tours->deletePrices($_POST['tour_id']);

        // Thêm giá mới nếu có
        if (!empty($_POST['prices'])) {
            foreach ($_POST['prices'] as $price) {
                if (!empty($price['target_group']) && !empty($price['price'])) {
                    $tours->insertPrice(
                        $_POST['tour_id'],
                        $price['target_group'],
                        $price['price'],
                        $price['valid_from'],
                        $price['valid_to']
                    );
                }
            }
        }

        // Xóa lịch trình cũ
        $tours->deleteSchedules($_POST['tour_id']);

        // Thêm lịch trình mới nếu có
        if (!empty($_POST['schedules'])) {
            foreach ($_POST['schedules'] as $schedule) {
                // Chỉ lấy trực tiếp các trường từ form, không foreach trên activities
                $tours->insertSchedule(
                    $_POST['tour_id'],
                    $schedule['day_number'],
                    $schedule['activities'],   // CHỈ LẤY TRỰC TIẾP
                    $schedule['start_time'],
                    $schedule['end_time'],
                    $schedule['location']
                );
            }
        }

        $_SESSION['success'][] = "Cập nhật tour thành công!";
        header("Location: " . BASE_URL . "?action=admin-list-tour");
        exit;
    }

    // GET dữ liệu form sửa
    $id = $_GET['id'] ?? 0;
    $tour = $tours->getOne($id);
    $schedules = $tours->getSchedules($id);
    $prices = $tours->getPrices($id);

    $tourcategories = new Tourcategories();
    $listCategories = $tourcategories->getList();

    $providers = new Providers();
    $listProviders = $providers->getList();

    $title = "Trang sửa tour";
    $view = "admin/update-tour";
    require_once PATH_VIEW . 'main.php';
}

    /* ============================
       XÓA TOUR
    ============================ */
    public function delete()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            header("Location: " . BASE_URL . "?action=admin-list-tour");
            exit;
        }

        $result = $this->tourModel->delete($id);

        if ($result === "HAS_BOOKING") {
            echo "<script>
                alert('Tour này đã có booking, không thể xóa!');
                window.location.href='" . BASE_URL . "?action=admin-list-tour';
            </script>";
            exit;
        }

        if ($result === "DELETED") {
            echo "<script>
                alert('Xóa tour thành công!');
                window.location.href='" . BASE_URL . "?action=admin-list-tour';
            </script>";
            exit;
        }

        echo "<script>
            alert('Xóa thất bại!');
            window.location.href='" . BASE_URL . "?action=admin-list-tour';
        </script>";
    }

    /* ============================
       THÊM LỊCH TRÌNH TOUR
    ============================ */
    public function addSchedule()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $tourModel = new Tours();
            $tourModel->insertSchedule(
                $_POST['tour_id'],
                $_POST['day_number'],
                $_POST['activities'],
                $_POST['start_time'],
                $_POST['end_time'],
                $_POST['location']
            );

            $_SESSION['success'][] = "Thêm lịch trình thành công!";
            header("Location: " . BASE_URL . "?action=admin-list-tour");
            exit;
        }
    }
}
