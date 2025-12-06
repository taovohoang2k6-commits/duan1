<?php 
class PricesController{
    public function index(){
        $prices = new Prices();
        $listData = $prices->getList();
       
        $view = "admin/list-prices";
        require_once PATH_VIEW . 'main.php';
    }
        public function create(){
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
           $prices = new Prices();
            $prices->insert(
                $_POST['tour_id'],
                $_POST['target_group'],
                $_POST['price'],
                $_POST['valid_from'],
                $_POST['valid_to']
            );
            $_SESSION['success'][]="thêm mới thành công";
            header("Location: " . BASE_URL . "?action=admin-list-prices");
            exit;
        } else {
            $tours = new Tours();
        $listTour = $tours->getList();
            $title = "Trang thêm mới giá";
            $view = "admin/create-prices";
            require_once PATH_VIEW . 'main.php';
        }
    }
        public function update(){
         if ($_SERVER['REQUEST_METHOD'] == "POST") {

        $prices = new Prices();
        $prices->update(
            $_POST['id'],
            $_POST['tour_id'],
            $_POST['target_group'],
            $_POST['price'],
            $_POST['valid_from'],
            $_POST['valid_to']
        );

        $_SESSION['success'][]="chỉnh sửa thành công";
        header("Location: " . BASE_URL . "?action=admin-list-prices");
        exit;

    } else {
        
        $id = $_GET['id'];
$prices = new Prices();
$price = $prices->getOne($id);

        $tours = new Tours();
        $listTour = $tours->getList();

        $title = "Trang sửa giá";
        $view = "admin/update-prices";
        require_once PATH_VIEW . 'main.php';
    }
    }
        public function delete(){
                $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        if ($id > 0) {
            $prices = new Prices();
            $prices->delete($id);
        }
        $_SESSION['success'][] = "xóa thành công";
        header("Location: " . BASE_URL . "?action=admin-list-prices");
        exit;
        
    }
}