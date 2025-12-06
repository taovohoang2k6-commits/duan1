<div class="container">
    <div class="row">
        <div class="col-3">
            <?php include "views/admin/sidebar.php"; ?>
        </div>

        <div class="col-9">
            <h3>Cập nhật báo cáo tài chính tour</h3>

            <form action="<?= BASE_URL ?>?action=admin-update-tour_finance&id=<?= $data['finance_id'] ?>" method="POST">

                <input type="hidden" name="finance_id" value="<?= $data['finance_id'] ?>">

                <div class="mb-3">
                    <label>Tour</label>
                    <select name="tour_id" class="form-control">
    <?php foreach ($listTour as $tour): ?>
        <option value="<?= $tour['tour_id'] ?>" <?= $tour['tour_id'] == $data['tour_id'] ? 'selected' : '' ?>>
            <?= $tour['tour_name'] ?>
        </option>
    <?php endforeach; ?>
</select>
                </div>

                <div class="mb-3">
                    <label>Doanh thu</label>
                    <input type="number" step="0.01" class="form-control" name="total_revenue" value="<?= $data['total_revenue'] ?>">
                </div>

                <div class="mb-3">
                    <label>Chi phí</label>
                    <input type="number" step="0.01" class="form-control" name="total_expense" value="<?= $data['total_expense'] ?>">
                </div>

                <div class="mb-3">
                    <label>Lợi nhuận</label>
                    <input type="number" step="0.01" class="form-control" name="profit" value="<?= $data['profit'] ?>">
                </div>

                <div class="mb-3">
                    <label>Ngày lập báo cáo</label>
                    <input type="date" class="form-control" name="report_date" value="<?= $data['report_date'] ?>">
                </div>

                <button class="btn btn-primary btn-sm">Cập nhật</button>

            </form>
        </div>
    </div>
</div>
