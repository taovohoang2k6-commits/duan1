<?php 
class HistoryController{
    public function index(){
        $history = new History();
        $listData = $history->getList();
        
        $view = "admin/list-booking_history";
        require_once PATH_VIEW . 'main.php';
    }
        public function create(){
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $bookingHistory = new History();
        $bookingHistory->insert(
            $_POST['booking_id'],       
            $_POST['status'],          
            $_POST['changed_at'],        
            $_POST['changed_by']        
        );

        $_SESSION['success'][] = "Thêm mới lịch sử booking thành công";
        header("Location: " . BASE_URL . "?action=admin-list-booking_history");
        exit;
    }

    
    $bookings = new Bookings();
    $listBooking = $bookings->getList();

    $title = "Thêm lịch sử booking";
    $view = "admin/create-booking_history";
    require_once PATH_VIEW . 'main.php';
    }
        public function update(){
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $bookingHistory = new History();
        $bookingHistory->update(
            $_POST['id'],       
            $_POST['booking_id'],       
            $_POST['status'],          
            $_POST['changed_at'],        
            $_POST['changed_by']        
        );

        $_SESSION['success'][] = "Thêm mới lịch sử booking thành công";
        header("Location: " . BASE_URL . "?action=admin-list-booking_history");
        exit;
    }else{
  $id = $_GET['id'];
$history = new History();
$histor = $history->getOne($id);
    
    $bookings = new Bookings();
    $listBooking = $bookings->getList();

    $title = "Thêm lịch sử booking";
    $view = "admin/create-booking_history";
    require_once PATH_VIEW . 'main.php';
    }
    }
        public function delete(){
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        if ($id > 0) {
          $history = new History();
            $history->delete($id);
        }
        $_SESSION['success'][] = "xóa thành công";
        header("Location: " . BASE_URL . "?action=admin-list-booking_history");
        exit;
        
    }
}