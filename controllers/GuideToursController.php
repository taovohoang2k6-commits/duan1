<?php
class GuideToursController
{
    public function index()
    {
        $guideTours = new GuideTours();
        // allow optional filtering by guide_id (admin) or current logged-in guide
        $guide_id = $_GET['guide_id'] ?? null;
        if (empty($guide_id) && !empty($_SESSION['guideLogin']['guide_id'])) {
            $guide_id = $_SESSION['guideLogin']['guide_id'];
        }

        if ($guide_id) {
            $listData = $guideTours->getByGuide($guide_id);
        } else {
            // admin view: show all assigned tours
            $listData = $guideTours->getList();
        }

        $view = "admin/list-guide_tours";
        require_once PATH_VIEW . 'main.php';
    }

    public function detail()
    {
        $departure_id = $_GET['departure_id'] ?? null;
        if (empty($departure_id)) {
            header("Location: " . BASE_URL . "?action=admin-guide_tours");
            exit();
        }

        $guideTours = new GuideTours();
        $tourDetail = $guideTours->getByDeparture($departure_id);

        if (empty($tourDetail)) {
            header("Location: " . BASE_URL . "?action=admin-guide_tours");
            exit();
        }

        $view = "admin/detail-guide_tours";
        require_once PATH_VIEW . 'main.php';
    }
}
