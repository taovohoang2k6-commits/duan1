<?php  
class GuidesController {
    public function index(){
        $guides = new Guides();
        $listData = $guides->getList();
       
        $view = "admin/list-guides";
        require_once PATH_VIEW . 'main.php';
    }

    public function create(){
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $guides = new Guides();
            $guides->insert(
    $_POST['full_name'],
    $_POST['email'],
    $_POST['password'],
    $_POST['phone'],
    $_POST['language'],
    $_POST['status'],
    $_POST['role']
            );

            $_SESSION['success'][] = "Thêm mới thành công";
            header("Location: " . BASE_URL . "?action=admin-list-guides");
            exit();
        } else {
            $title = "Trang thêm mới hướng dẫn viên";
            $view = "admin/create-guides";
            require_once PATH_VIEW . 'main.php';
        }
    }

    public function update(){
        $guides = new Guides();
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $id = $_GET['id'] ?? null;
            if ($id) {
                $guides->update(
    $id,
    $_POST['full_name'],
    $_POST['email'],
    $_POST['password'],
    $_POST['phone'],
    $_POST['language'],
    $_POST['status'],
    $_POST['role']
                );

                $_SESSION['success'][] = "Chỉnh sửa thành công";
                header("Location: " . BASE_URL . "?action=admin-list-guides");
                exit();
            }
        } else {
            $id = $_GET['id'] ?? null;
            $data = $guides->getOne($id);
            $title = "Trang chỉnh sửa nhân sự";
            $view = "admin/update-guides";
            require_once PATH_VIEW . 'main.php';
        }
    }

    public function delete(){
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        if ($id > 0) {
            $guides = new Guides();
            $guides->delete($id);
        }
        $_SESSION['success'][] = "Xóa thành công";
        header("Location: " . BASE_URL . "?action=admin-list-guides");
        exit();
    }
}
?>
