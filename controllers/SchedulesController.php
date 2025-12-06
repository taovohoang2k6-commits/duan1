<?php
class SchedulesController
{
    public function index()
    {
        $schedules = new Schedules();
        $listData = $schedules->getList();
        
        $view = "admin/list-schedules";
        require_once PATH_VIEW . 'main.php';
    }
    public function create(){
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
           $schedules = new Schedules();
            $schedules->insert(
                $_POST['tour_id'],
                $_POST['day_number'],
                $_POST['activities'],
                $_POST['start_time'],
                $_POST['end_time']
            );
            $_SESSION['success'][]="thêm mới thành công";
            header("Location: " . BASE_URL . "?action=admin-list-schedules");
            exit;
        } else {
            $tours = new Tours();
        $listTour = $tours->getList();
            $title = "Trang thêm mới lịch trình";
            $view = "admin/create-schedules";
            require_once PATH_VIEW . 'main.php';
        }
    }
       public function update(){
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $schedules = new Schedules();
        $schedules->update(
            $_POST['id'],
            $_POST['tour_id'],
            $_POST['day_number'],
            $_POST['activities'],
            $_POST['start_time'],
            $_POST['end_time']
        );

        $_SESSION['success'][] = "Sửa thành công";
        header("Location: " . BASE_URL . "?action=admin-list-schedules");
        exit;

    } else {

        if (!isset($_GET['id'])) {
            die("Thiếu ID lịch trình");
        }

        $id = $_GET['id'];

        $schedules = new Schedules();
        $schedule = $schedules->getOne($id);

        $tours = new Tours();
        $listTour = $tours->getList();

        $title = "Trang sửa lịch trình";
        $view = "admin/update-schedules";
        require_once PATH_VIEW . 'main.php';
    }
}

        public function delete(){
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        if ($id > 0) {
             $schedules = new Schedules();
            $schedules->delete($id);
        }
        $_SESSION['success'][] = "xóa thành công";
        header("Location: " . BASE_URL . "?action=admin-list-schedules");
        exit;
    }
}
