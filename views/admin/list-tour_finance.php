<div class="container">
    <div class="row">
        <div class="col-3">
            <?php include "views/admin/sidebar.php"; ?>
        </div>

        <div class="col-9">

            <h3>Danh sách tài chính tour</h3>

            <a href="<?= BASE_URL ?>?action=admin-create-tour_finance" 
               class="btn btn-primary btn-sm mb-3">Thêm mới</a>

            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tour</th>
                        <th>Doanh thu</th>
                        <th>Chi phí</th>
                        <th>Lợi nhuận</th>
                        <th>Ngày lập báo cáo</th>
                        <th>Hành động</th>
                    </tr>
                </thead>

                <tbody>
                <?php if (!empty($listData) && is_array($listData)): ?>
                    <?php foreach ($listData as $key => $value): ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td><?= $value['tour_name'] ?? 'Không xác định' ?></td>
                            <td><?= number_format($value['total_revenue'], 0, ',', '.') ?></td>
                            <td><?= number_format($value['total_expense'], 0, ',', '.') ?></td>
                            <td><?= number_format($value['profit'], 0, ',', '.') ?></td>
                            <td><?= $value['report_date'] ?></td>
                            <td>
                                <a href="<?= BASE_URL ?>?action=admin-update-tour_finance&id=<?= $value['finance_id'] ?>" class="btn btn-primary btn-sm">Sửa</a>
                                
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted">Không có dữ liệu</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>
