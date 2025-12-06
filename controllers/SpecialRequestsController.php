<?php
class SpecialRequestsController {


    public function index() {
        $specialRequests = new SpecialRequests();
        $listData = $specialRequests->getList();

      
        $view = "admin/list-special_requests";
        require_once PATH_VIEW . 'main.php';
    }


    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $sr = new SpecialRequests();
            $sr->insert(
                $_POST['customer_id'],
                $_POST['request_type'],
                $_POST['description'],
                $_POST['handled']
            );

            $_SESSION['success'][] = "Thêm mới yêu cầu đặc biệt thành công!";
            header("Location: " . BASE_URL . "?action=admin-list-special_requests");
            exit;
        }


        $customers = new Customers();
        $listCustomer = $customers->getList();

        $title = "Thêm yêu cầu đặc biệt";
        $view = "admin/create-special_requests";
        require_once PATH_VIEW . 'main.php';
    }


    public function update() {
        $sr = new SpecialRequests();

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $sr->update(
                $_POST['request_id'],
                $_POST['customer_id'],
                $_POST['request_type'],
                $_POST['description'],
                $_POST['handled']
            );

            $_SESSION['success'][] = "Cập nhật yêu cầu đặc biệt thành công!";
            header("Location: " . BASE_URL . "?action=admin-list-special_requests");
            exit;
        }


        $id = $_GET['id'];
        $data = $sr->getOne($id);

        $customers = new Customers();
        $listCustomer = $customers->getList();

        $title = "Cập nhật yêu cầu đặc biệt";
        $view = "admin/update-special_requests";
        require_once PATH_VIEW . 'main.php';
    }


    public function delete() {
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        if ($id > 0) {
            $sr = new SpecialRequests();
            $sr->delete($id);

            $_SESSION['success'][] = "Xóa yêu cầu đặc biệt thành công!";
        }

        header("Location: " . BASE_URL . "?action=admin-list-special_requests");
        exit;
    }
}
