<?php 
class ProvidersController{
    public function index(){
        $providers = new Providers();
        $listData = $providers->getList();
       
        $view = "admin/list-providers";
        require_once PATH_VIEW . 'main.php';
    }
        public function create(){
                if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $providers = new Providers();
            $providers->insert(
    $_POST['name'],
    $_POST['type'],
    $_POST['contact'],
    $_POST['address']

            );
            $_SESSION['success'][]="thêm mới thành công";
            header("Location: " . BASE_URL . "?action=admin-list-providers");
            exit;
        } else {
            $title = "Trang thêm mới nhà cung cấp";
            $view = "admin/create-providers";
            require_once PATH_VIEW . 'main.php';
        }
    }
        public function update(){
                 if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $providers = new Providers();
$providers->update(
    $_GET['id'],
    $_POST['name'],
    $_POST['type'],
    $_POST['contact'],
    $_POST['address']
    );
$_SESSION['success'][]="chỉnh sửa thành công";
        header("Location: " . BASE_URL . "?action=admin-list-providers");

         }else{
    $providers = new Providers();
$data = $providers->getOne($_GET['id']);
              $title = "Trang chỉnh sửa mục tour";
        $view = "admin/update-providers";
        require_once PATH_VIEW . 'main.php';
         }
    }
public function delete(){
    $id = $_GET['id'] ?? 0;

    try {
        $providers = new Providers();
        $providers->delete($id);
        $_SESSION['success'][] = "Xóa thành công";
    } catch (PDOException $e) {
   
        $_SESSION['error'][] = "Không thể xóa nhà cung cấp vì đang được sử dụng trong Tour!";
    }

    header("Location: " . BASE_URL . "?action=admin-list-providers");
    exit;
}
}