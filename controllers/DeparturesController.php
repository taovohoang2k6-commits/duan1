<?php 
class DeparturesController{
    public function index(){
        $departures = new Departures();
        $listData = $departures->getList();
        
        $view = "admin/list-departures";
        require_once PATH_VIEW . 'main.php';
    }
        public function create(){
                if ($_SERVER['REQUEST_METHOD'] == "POST") {
           $departures = new Departures();
            $departures->insert(
                $_POST['tour_id'],
                $_POST['start_date'],
                $_POST['end_date'],
                $_POST['meeting_point']
            );
            $_SESSION['success'][]="thêm mới thành công";
            header("Location: " . BASE_URL . "?action=admin-list-departures");
            exit;
        } else {
            $tours = new Tours();
        $listTour = $tours->getList();
            $title = "Trang thêm mới giá";
            $view = "admin/create-departures";
            require_once PATH_VIEW . 'main.php';
        }
    }
        public function update(){
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $departures = new Departures();
        $departures->update(
            $_POST['id'],
            $_POST['tour_id'],
            $_POST['start_date'],
            $_POST['end_date'],
            $_POST['meeting_point']
        );

        $_SESSION['success'][] = "Sửa thành công";
        header("Location: " . BASE_URL . "?action=admin-list-departures");
        exit;

    } else {

        if (!isset($_GET['id'])) {
            die("Thiếu ID lịch trình");
        }

        $id = $_GET['id'];

        $departures = new Departures();
        $departure = $departures->getOne($id);

        $tours = new Tours();
        $listTour = $tours->getList();

        $title = "Trang sửa lịch trình";
        $view = "admin/update-departures";
        require_once PATH_VIEW . 'main.php';
    }
    }
        public function delete(){
                $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        if ($id > 0) {
            $departures = new Departures();
            $departures->delete($id);
        }
        $_SESSION['success'][] = "xóa thành công";
        header("Location: " . BASE_URL . "?action=admin-list-departures");
        exit;
    }
}