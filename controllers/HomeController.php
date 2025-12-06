<?php

class HomeController
{
    public function index()
    {
        $title = "Trang chủ";
        $view = "home";
        require_once PATH_VIEW . 'login.php';
    }
    public function login()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'POST') {
           $user = new Users(); 
             $check =  $user-> checkLogin($_POST['email'],$_POST['password']);
if($check){
                $_SESSION['success'][] = "Đăng nhập thành công";


                $_SESSION['userLogin'] = [
                'id' => $check['id'],
                'name' => $check['name']
                ];
   header("Location: " . BASE_URL . "?action=admin-sidebar");
    exit();
}else{
            $_SESSION['error'][] = "Đăng nhập thất bại";
    header("Location: " .BASE_URL . "?action=login");
    exit();    
}
        }
        $title = "Trang đăng nhập";
        $view = "login";
        require_once PATH_VIEW . 'main.php';
    }
    public function register()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'POST') {
            if ($_POST['password'] == $_POST['confirm']) {
               $user = new Users(); 
             $check =  $user-> findBYEmail($_POST['email']);
if(!$check){
    $user->register(
$_POST['name'],
$_POST['email'],
$_POST['password'],
$_POST['phone'],
$_POST['address']
    );
            $_SESSION['success'][] = "Đăng ký thành công";
    header("Location: " .BASE_URL . "?action=login");
    exit();
}
            $_SESSION['error'][] = "email đã tồn tại";
    header("Location: " .BASE_URL . "?action=register");
    exit();
            }
            $_SESSION['error'][] = "Mật khẩu phải trùng với confirm";
                header("Location: " .BASE_URL . "?action=register");
    exit();
        }
        $title = "Trang đăng ký";
        $view = "register";
        require_once PATH_VIEW . 'main.php';
    }
    public function logout(){
        unset($_SESSION['userLogin']);
              $_SESSION['success'][] = "Đăng xuất thành công";
    header("Location: " .BASE_URL . "?action=login");
    exit();

    }
}
