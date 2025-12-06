<?php 
class TourLogsController{
    public function index(){
 $tourLogs = new TourLogs();
        $listData = $tourLogs->getList();

      
        $view = "admin/list-tour_logs";
        require_once PATH_VIEW . 'main.php';
    }
    public function create() {
  
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $logs = new TourLogs();

            $logs->insert(
                $_POST['departure_id'],
                $_POST['guide_id'],
                $_POST['date'],
                $_POST['note'],
                $_POST['issues']
            );

            $_SESSION['success'][] = "Thêm nhật ký tour thành công!";
            header("Location: " . BASE_URL . "?action=admin-list-tour_logs");
            exit;
        }


        $departures = new Departures();
        $listDepartures = $departures->getList();

        $guides = new Guides();
        $listGuides = $guides->getList();

        $title = "Thêm nhật ký tour";
        $view = "admin/create-tour_logs";
        require_once PATH_VIEW . 'main.php';
    }
}
