<?php
class BookingController
{
    protected $pdo;

    public function __construct()
    {
        $database = new BaseModel();
        $this->pdo = $database->getConnection();
    }

    public function index()
    {
        $bookings = new Bookings();
        $listData = $bookings->getList();

        $view = "admin/list-bookings";
        require_once PATH_VIEW . 'main.php';
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $bookingModel = new Bookings();
            $customerModel = new Customers();

            // Dữ liệu từ form 
            $tour_id = $_POST['tour_id'];
            $customer_name = $_POST['customer_name'];
            $contact = $_POST['contact'];
            $quantity = intval($_POST['quantity'] ?? 1);
            $type = $_POST['type'];
            $start_date = $_POST['start_date'];
            $status = $_POST['status'];
            $created_at = $_POST['created_at'];
            $deposit = floatval($_POST['deposit'] ?? 0);

            // LẤY GIÁ TOUR
            $tourModel = new Tours();
            $price = floatval($tourModel->getDefaultPrice($tour_id) ?? 0);

            // TÍNH TIỀN
            $total = $price * $quantity;
            $remaining = $total - $deposit;

            // Insert Booking
            $booking_id = $bookingModel->insert(
                $tour_id,
                $customer_name,
                $contact,
                $quantity,
                $type,
                $start_date,
                $status,
                $created_at,
                $deposit,
                $total,
                $remaining
            );

            if (!$booking_id) die("Lỗi tạo booking!");

            // INSERT DANH SÁCH KHÁCH
            if (!empty($_POST['customers'])) {
                foreach ($_POST['customers'] as $c) {
                    $c_deposit = isset($c['deposit']) && $c['deposit'] !== '' ? floatval($c['deposit']) : 0;
                    $customerModel->insert(
                        $booking_id,
                        $c['full_name'],
                        $c['gender'],
                        $c['dob'],
                        $c['id_number'],
                        $c['phone'],
                        $c['payment_status'],
                        $c_deposit
                    );
                }
            }

            // Redirect back to bookings list (original behavior)
            header("Location: " . BASE_URL . "?action=admin-list-bookings");
            exit;
        }

        // Load danh sách tour
        $tours = new Tours();
        $listTour = $tours->getList();

        $view = "admin/create-bookings";
        require_once PATH_VIEW . "main.php";
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $booking_id = $_POST['booking_id'];

            $bookingModel = new Bookings();
            $customersModel = new Customers();
            $tourModel = new Tours();

            $deposit = floatval($_POST['deposit'] ?? 0);
            $quantity = intval($_POST['quantity'] ?? 1);

            // Lấy giá tour mới
            $price = floatval($tourModel->getDefaultPrice($_POST['tour_id']) ?? 0);

            // TÍNH TIỀN
            $total = $price * $quantity;
            $remaining = $total - $deposit;

            // UPDATE BOOKING
            $bookingModel->update(
                $booking_id,
                $_POST['tour_id'],
                $_POST['customer_name'],
                $_POST['contact'],
                $quantity,
                $_POST['type'],
                $_POST['start_date'],
                $_POST['status'],
                $deposit,
                $total,
                $remaining
            );

            // Xử lý customers
            $oldCustomers = $customersModel->getByBooking($booking_id);
            $oldIds = array_column($oldCustomers, 'customer_id');

            $newList = $_POST['customers'] ?? [];
            $newIds = [];

            foreach ($newList as $c) {
                $c_deposit = isset($c['deposit']) && $c['deposit'] !== '' ? floatval($c['deposit']) : 0;

                if (!empty($c['customer_id'])) {
                    // UPDATE
                    $customersModel->update(
                        $c['customer_id'],
                        $booking_id,
                        $c['full_name'],
                        $c['gender'],
                        $c['dob'],
                        $c['id_number'],
                        $c['phone'],
                        $c['payment_status'],
                        $c_deposit
                    );
                    $newIds[] = $c['customer_id'];
                } else {
                    // INSERT
                    $customersModel->insert(
                        $booking_id,
                        $c['full_name'],
                        $c['gender'],
                        $c['dob'],
                        $c['id_number'],
                        $c['phone'],
                        $c['payment_status'],
                        $c_deposit
                    );
                }
            }

            // Xóa khách bị remove 
            $deleted = array_diff($oldIds, $newIds);
            foreach ($deleted as $idDel) {
                $customersModel->delete($idDel);
            }

            $_SESSION['success'][] = "Cập nhật booking thành công!";
            header("Location: " . BASE_URL . "?action=admin-list-bookings");
            exit;
        }

        // GET form update 
        $id = $_GET['id'] ?? 0;

        $bookingModel = new Bookings();
        $booking = $bookingModel->getOne($id);
        if (!$booking) die("Booking không tồn tại!");

        $tours = new Tours();
        $listTour = $tours->getList();

        $customers = new Customers();
        $customerList = $customers->getByBooking($id);

        // Gán danh sách khách vào booking để view dùng
        $booking['customers'] = $customerList ?? []; // <<< đây là điểm quan trọng

        $view = "admin/update-bookings";
        require_once PATH_VIEW . 'main.php';
    }

    public function delete()
    {
        $id = $_GET['id'] ?? 0;

        if ($id > 0) {
            $bookings = new Bookings();
            $bookings->delete($id);
        }

        $_SESSION['success'][] = "Xóa thành công";
        header("Location: " . BASE_URL . "?action=admin-list-bookings");
        exit();
    }

    public function assignGuide()
    {
        $id = $_GET['booking_id'] ?? 0;
        if (!$id) die("Booking không tồn tại!");

        $bookings = new Bookings();
        $booking = $bookings->getOne($id);

        if (!$booking) die("Booking không tồn tại!");

        $guides = new Guides();
        $listGuides = $guides->getList();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $guide_id = $_POST['guide_id'];

            if ($bookings->guideHasAnyBooking($guide_id)) {
                die("Hướng dẫn viên này đã được phân công 1 tour khác! Không thể gán thêm.");
            }

            $bookings->assignGuide($id, $guide_id);

            $_SESSION['success'][] = "Gán hướng dẫn viên thành công!";
            header("Location: " . BASE_URL . "?action=admin-list-bookings");
            exit;
        }

        $view = "admin/assign-guide";
        require_once PATH_VIEW . "main.php";
    }

    public function assignCustomer()
    {
        $booking_id = $_GET['booking_id'] ?? 0;
        if (!$booking_id) die("Booking không tồn tại!");

        $bookings = new Bookings();
        $customers = new Customers();

        $booking = $bookings->getOne($booking_id);
        if (!$booking) die("Booking không tồn tại!");

        $tour_id = $booking['tour_id'];
        $customerList = $customers->getCustomersByTour($tour_id);

        $title = "Gán khách hàng";
        $view = "admin/assign-customer";
        require_once PATH_VIEW . 'main.php';
    }

    public function viewCustomers()
    {
        $booking_id = $_GET['id'] ?? null;

        $bookings = new Bookings();
        $customers = new Customers();

        $booking = $bookings->getOne($booking_id);
        $tour_id = $booking['tour_id'];

        $customerList = $customers->getCustomersByTour($tour_id);

        $view = "admin/view-customers";
        require_once PATH_VIEW . "main.php";
    }
}
