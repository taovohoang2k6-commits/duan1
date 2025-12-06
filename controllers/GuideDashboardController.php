<?php

class GuideDashboardController
{
    public function index()
    {
        if (!isset($_SESSION['guideLogin'])) {
            header("Location: " . BASE_URL . "?action=guide-login");
            exit;
        }

        $guide_id = $_SESSION['guideLogin']['guide_id'];

        $model = new GuideDashboard();
        $tours = $model->getAssignedTours($guide_id);

        $title = "Dashboard HDV";
        $view = "guides/dashboard";

        require_once PATH_VIEW . 'main.php';
    }
}
