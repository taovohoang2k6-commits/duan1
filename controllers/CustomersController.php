<?php 
class CustomersController {
    public function index() {
        $customers = new Customers();
        $listData = $customers->getList();

       
        $view = "admin/list-customers";
        require_once PATH_VIEW . 'main.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $customer = new Customers();
            $customer->insert(
                $_POST['booking_id'],
                $_POST['full_name'],
                $_POST['gender'],
                $_POST['dob'],
                $_POST['id_number'],
                $_POST['phone'],
                $_POST['payment_status'],
                $_POST['deposit']
            );

            $_SESSION['success'][] = "Thêm khách hàng thành công!";
            header("Location: " . BASE_URL . "?action=admin-list-customers");
            exit;
        }


        $bookings = new Bookings();
        $listBooking = $bookings->getList();

        $title = "Thêm khách hàng";
        $view = "admin/create-customers";
        require_once PATH_VIEW . 'main.php';
    }


    public function update() {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $customer = new Customers();
            $customer->update(
                $_POST['customer_id'],
                $_POST['booking_id'],
                $_POST['full_name'],
                $_POST['gender'],
                $_POST['dob'],
                $_POST['id_number'],
                $_POST['phone'],
                $_POST['payment_status'],
                $_POST['deposit']
            );

            $_SESSION['success'][] = "Cập nhật khách hàng thành công!";
            header("Location: " . BASE_URL . "?action=admin-list-customers");
            exit;
        } 
        else {

            $id = $_GET['id'];
            $customer = new Customers();
            $one = $customer->getOne($id);

            $bookings = new Bookings();
            $listBooking = $bookings->getList();

            $title = "Cập nhật khách hàng";
            $view = "admin/update-customers";
            require_once PATH_VIEW . 'main.php';
        }
    }



    public function delete() {
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        if ($id > 0) {
          $customer = new Customers();
            $customer->delete($id);
        }
        $_SESSION['success'][] = "xóa thành công";
        header("Location: " . BASE_URL . "?action=admin-list-customers");
        exit;
    }
}
