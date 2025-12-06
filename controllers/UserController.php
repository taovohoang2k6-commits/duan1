<?php 
class UserController{
    public function index(){
        $user = new Users();
        $listData = $user->getList();
        $title = "Trang người dùng";
        $view = "admin/list-user";
        require_once PATH_VIEW . 'main.php';
    }
    public function create(){
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $user = new Users();
        $check = $user -> findBYEmail($_POST['email']);
        if($check){
                        $_SESSION['error'][] = "email đã tồn tại";
            header("Location: " . BASE_URL . "?action=admin-create-users");
exit();
        }
        $user ->register(
            $_POST['name'],
            $_POST['email'],
            $_POST['password'],
            $_POST['phone'],
            $_POST['address'],
            $_POST['role']
        );
            $_SESSION['success'][]="thêm mới thành công";
            header("Location: " . BASE_URL . "?action=admin-list-users");
       
        } else {
            $title = "Trang thêm mới người dùng";
            $view = "admin/create-user";
            require_once PATH_VIEW . 'main.php';
        }
    }
        public function update(){
         if ($_SERVER['REQUEST_METHOD'] == "POST") {
              $user = new Users();
$user->update($_GET['id'], $_POST['name'], $_POST['email'], $_POST['password'], $_POST['phone'], $_POST['address'], $_POST['role']);
$_SESSION['success'][]="chỉnh sửa thành công";
        header("Location: " . BASE_URL . "?action=admin-list-users");

         }else{
                  $user = new Users();
$data = $user->getOne($_GET['id']);
              $title = "Trang chỉnh sửa nhân sự";
        $view = "admin/update-user";
        require_once PATH_VIEW . 'main.php';
         }
    }
        public function delete(){
                $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id > 0) {
          $user = new Users();
    $user->delete($id);
}
$_SESSION['success'][]="xóa thành công";
        header("Location: " . BASE_URL . "?action=admin-list-users");
        exit;
    }
}