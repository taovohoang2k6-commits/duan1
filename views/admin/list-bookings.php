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

            <div class="page-header d-flex justify-content-between align-items-center mb-3">
                <h2 class="mb-0">Danh sách Booking</h2>
                <a href="<?= BASE_URL ?>?action=admin-create-bookings" class="btn btn-primary btn-sm">
                    Thêm mới
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tour</th>
                            <th>Khách</th>
                            <th>Liên hệ</th>
                            <th>Số lượng</th>
                            <th>Loại hình</th>
                            <th>Ngày khởi hành</th>
                            <th>Nhân sự</th>
                            <th>Nhà cung cấp</th>
                            <th>Trạng thái</th>
                            <th>Đặt cọc</th>
                            <th>Tổng</th>
                            <th>Còn lại</th>
                            <th>Ngày tạo</th>
                            <th class="text-center">Hành động</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (!empty($listData)): ?>
                            <?php foreach ($listData as $key => $value): ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>

                                    <td><?= htmlspecialchars($value['tour_name']) ?></td>

                                    <td><?= htmlspecialchars($value['customer_name'] ?? 'Không có') ?></td>

                                    <td><?= htmlspecialchars($value['contact']) ?></td>
                                    <td><?= htmlspecialchars($value['quantity']) ?></td>
                                    <td><?= htmlspecialchars($value['type']) ?></td>
                                    <td><?= htmlspecialchars($value['start_date']) ?></td>

                                    <td>
                                        <strong><?= htmlspecialchars($value['guide_name'] ?? 'Chưa phân công') ?></strong><br>
                                        <small class="text-muted"><?= htmlspecialchars($value['guide_role'] ?? '') ?></small>
                                    </td>

                                    <td><?= htmlspecialchars($value['provider_name'] ?? 'Không có') ?></td>

                                    <td><?= htmlspecialchars($value['status']) ?></td>

                                    <td>
                                        <?= number_format(floatval($value['deposit'] ?? 0), 0, ',', '.') ?>
                                    </td>

                                    <td>
                                        <?= number_format(floatval($value['total'] ?? 0), 0, ',', '.') ?>
                                    </td>

                                    <td>
                                        <?= number_format(floatval($value['remaining'] ?? 0), 0, ',', '.') ?>
                                    </td>

                                    <td><?= htmlspecialchars($value['created_at']) ?></td>

                                    <td class="text-center">
                                        <a href="<?= BASE_URL ?>?action=admin-update-bookings&id=<?= $value['booking_id'] ?>" 
                                           class="btn btn-warning btn-sm">Sửa</a>

                                        <a href="<?= BASE_URL ?>?action=assign-guide&booking_id=<?= $value['booking_id'] ?>" 
                                           class="btn btn-info btn-sm">Gán HDV</a>

                                        <a href="<?= BASE_URL ?>?action=assign-customer&booking_id=<?= $value['booking_id'] ?>" 
                                           class="btn btn-secondary btn-sm">Xem khách</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        <?php else: ?>
                            <tr>
                                <td colspan="15" class="text-center text-muted">Không có dữ liệu</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
