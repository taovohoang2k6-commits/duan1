<?php

class GuideAuthController
{
    public function loginForm()
    {
        $title = "Đăng nhập Hướng dẫn viên";
        $view = "guides/login";
        require_once PATH_VIEW . 'main.php';
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: " . BASE_URL . "?action=guide-login");
            exit;
        }

        $model = new Guides(); // model guides
        $guide = $model->findByEmail($_POST['email']);

        if ($guide && password_verify($_POST['password'], $guide['password'])) {
            $_SESSION['guideLogin'] = [
                "guide_id" => $guide['guide_id'],
                "full_name" => $guide['full_name']
            ];

            $_SESSION['success'][] = "Đăng nhập thành công";
            header("Location: " . BASE_URL . "?action=guide-dashboard");
            exit;
        }

        $_SESSION['error'][] = "Sai email hoặc mật khẩu";
        header("Location: " . BASE_URL . "?action=guide-login");
        exit;
    }

    public function logout()
    {
        unset($_SESSION['guideLogin']);
        $_SESSION['success'][] = "Đăng xuất thành công";
        header("Location: " . BASE_URL . "?action=guide-login");
        exit;
    }
}
