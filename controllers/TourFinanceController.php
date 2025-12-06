<?php
class TourFinanceController {

    public function index() {
        $tf = new TourFinance();
        $listData = $tf->getList();

       
        $view = "admin/list-tour_finance";
        require_once PATH_VIEW . 'main.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $tf = new TourFinance();
            $tf->insert(
                $_POST['tour_id'],
                $_POST['total_revenue'],
                $_POST['total_expense'],
                $_POST['profit'],
                $_POST['report_date']
            );

            $_SESSION['success'][] = "Thêm mới báo cáo tài chính thành công!";
            header("Location: " . BASE_URL . "?action=admin-list-tour_finance");
            exit;
        }

        $tours = new Tours();
        $listTour = $tours->getList();

        $title = "Thêm báo cáo tài chính tour";
        $view = "admin/create-tour_finance";
        require_once PATH_VIEW . 'main.php';
    }

    public function update() {
        $tf = new TourFinance();

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $tf->update(
                $_POST['finance_id'],
                $_POST['tour_id'],
                $_POST['total_revenue'],
                $_POST['total_expense'],
                $_POST['profit'],
                $_POST['report_date']
            );

            $_SESSION['success'][] = "Cập nhật báo cáo tài chính thành công!";
            header("Location: " . BASE_URL . "?action=admin-list-tour_finance");
            exit;
        }

        $id = $_GET['id'];
        $data = $tf->getOne($id);

        $tours = new Tours();
        $listTour = $tours->getList();

        $title = "Cập nhật báo cáo tài chính tour";
        $view = "admin/update-tour_finance";
        require_once PATH_VIEW . 'main.php';
    }

    public function delete() {
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        if ($id > 0) {
            $tf = new TourFinance();
            $tf->delete($id);
            $_SESSION['success'][] = "Xóa báo cáo tài chính thành công!";
        }

        header("Location: " . BASE_URL . "?action=admin-list-tour_finance");
        exit;
    }
}
