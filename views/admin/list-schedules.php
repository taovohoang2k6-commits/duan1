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

            <!-- Header -->
            <div class="page-header">
                <h2 class="mb-0">Lịch trình Tour</h2>
                <a href="<?= BASE_URL ?>?action=admin-create-schedules" class="btn btn-primary btn-sm">Thêm mới</a>
            </div>

            <!-- Table -->
            <div class="table-wrapper mt-3">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tour</th>
                                <th>Ngày thứ</th>
                                <th>Mô tả hoạt động</th>
                                <th>Giờ bắt đầu</th>
                                <th>Giờ kết thúc</th>
                                <th class="text-center">Hành động</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if (!empty($listData) && is_array($listData)): ?>
                                <?php foreach ($listData as $key => $value): ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= htmlspecialchars($value['tour_name']) ?></td>
                                    <td>Ngày <?= htmlspecialchars($value['day_number']) ?></td>

                                    <td><?= nl2br(htmlspecialchars($value['activities'])) ?></td>

                                    <td><?= htmlspecialchars($value['start_time']) ?></td>
                                    <td><?= htmlspecialchars($value['end_time']) ?></td>

                                    <td class="text-center">
                                        <a 
                                            href="<?= BASE_URL ?>?action=admin-update-schedules&id=<?= $value['schedule_id'] ?>" 
                                            class="btn btn-warning btn-sm">
                                            Sửa
                                        </a>

                                        <a 
                                            href="<?= BASE_URL ?>?action=admin-delete-schedules&id=<?= $value['schedule_id'] ?>" 
                                            onclick="return confirm('Bạn có muốn xóa không?')" 
                                            class="btn btn-danger btn-sm">
                                            Xóa
                                        </a>
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

    </div>
</div>
