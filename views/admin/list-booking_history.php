<style>
.main-content {
    padding-left: 0 !important;
    margin-left: 0 !important;
}
</style>

<div class="container-fluid">
    <div class="row">

        <!-- Sidebar -->
        <div class="col-2 p-0">
            <?php include "views/admin/sidebar.php"; ?>
        </div>

        <!-- Main content -->
        <div class="col-10 main-content">

            <!-- HEADER -->
            <div class="page-header">
                <h2 class="mb-0">Lịch sử thay đổi Booking</h2>
                <a href="<?= BASE_URL ?>?action=admin-create-booking_history" class="btn btn-primary btn-sm">
                    Thêm mới
                </a>
            </div>

            <!-- TABLE -->
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Booking</th>
                            <th>Trạng thái thay đổi</th>
                            <th>Thời điểm thay đổi</th>
                            <th>Người thay đổi</th>
                          
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (!empty($listData) && is_array($listData)): ?>
                            <?php foreach ($listData as $key => $value): ?>
                            <tr>
                                <td><?= $key + 1 ?></td>
                                <td><?= htmlspecialchars($value['customer_name']) ?></td>
                                <td><?= htmlspecialchars($value['history_status']) ?></td>
                                <td><?= htmlspecialchars($value['changed_at']) ?></td>
                                <td><?= htmlspecialchars($value['changed_by']) ?></td>

                               
                            </tr>
                            <?php endforeach; ?>

                        <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted">Không có dữ liệu</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>

                </table>
            </div>

        </div>
    </div>
</div>
