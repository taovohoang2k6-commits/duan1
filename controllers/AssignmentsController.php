<?php 
class AssignmentsController{

    public function index(){
        $assignments = new Assignments();
        $listData = $assignments->getList();
       
        $view = "admin/list-assignments";
        require_once PATH_VIEW . 'main.php';
    }

    public function create(){

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $assignments = new Assignments();
            $assignments->insert(
                $_POST['departure_id'],
                $_POST['guide_id'],
                $_POST['provider_id'],
                $_POST['role']
            );
            $_SESSION['success'][] = "Thêm mới thành công";
            header("Location: " . BASE_URL . "?action=admin-list-assignments");
            exit;
        }
        $departures = new Departures();
        $listDeparture = $departures->getList();

        $guides = new Guides();
        $listGuide = $guides->getList();

        $providers = new Providers();
        $listProvider = $providers->getList();

        $title = "Thêm phân công";
        $view = "admin/create-assignments";
        require_once PATH_VIEW . 'main.php';
    }

    public function update(){
        // Viết sau
    }

    public function delete(){
        // Viết sau
    }
}
