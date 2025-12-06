<div class="container">
    <div class="row">
        <div class="col-3">
            <?php include "views/admin/sidebar.php"; ?>
        </div>

        <div class="col-9">
            <h3>Thêm báo cáo tài chính tour</h3>

            <form action="<?= BASE_URL ?>?action=admin-create-tour_finance" method="POST">

                <div class="mb-3">
                    <label>Tour</label>
                    <select name="tour_id" class="form-control">
    <?php foreach ($listTour as $tour): ?>
        <option value="<?= $tour['tour_id'] ?>"><?= $tour['tour_name'] ?></option>
    <?php endforeach; ?>
</select>
                </div>

                <div class="mb-3">
                    <label>Doanh thu</label>
                    <input type="number" step="0.01" class="form-control" name="total_revenue" placeholder="Ví dụ: 1000000">
                </div>

                <div class="mb-3">
                    <label>Chi phí</label>
                    <input type="number" step="0.01" class="form-control" name="total_expense" placeholder="Ví dụ: 500000">
                </div>

                <div class="mb-3">
                    <label>Lợi nhuận</label>
                    <input type="number" step="0.01" class="form-control" name="profit" placeholder="Ví dụ: 500000">
                </div>

                <div class="mb-3">
                    <label>Ngày lập báo cáo</label>
                    <input type="date" class="form-control" name="report_date" value="<?= date('Y-m-d') ?>">
                </div>

                <button class="btn btn-primary btn-sm">Thêm mới</button>

            </form>
        </div>
    </div>
</div>
