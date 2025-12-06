<style>
    .main-content {
        padding-left: 0 !important;
        margin-left: 0 !important;
    }

    table.table {
        table-layout: fixed;
        width: 100%;
    }

    table.table td {
        word-wrap: break-word;
        vertical-align: top;
    }

    .col-schedule { width: 220px; }
    .col-image { width: 110px; }
    .col-actions { width: 120px; }

    .schedule-box {
        background: #f8f9fa;
        padding: 6px;
        border-radius: 6px;
        margin-bottom: 6px;
        border: 1px solid #ddd;
    }

    .schedule-form {
        background: #eef3ff;
        padding: 8px;
        border-radius: 6px;
        border: 1px solid #c8d6ff;
    }
</style>

<div class="container-fluid">
    <div class="row">

        <div class="col-2 p-0">
            <?php include "views/admin/sidebar.php"; ?>
        </div>

        <div class="col-10 main-content">

            <div class="page-header d-flex justify-content-between align-items-center">
                <h2 class="mb-0">Danh sách Tour</h2>
                <a href="<?= BASE_URL ?>?action=admin-create-tour" class="btn btn-primary btn-sm">Thêm mới</a>
            </div>

            <div class="table-wrapper mt-3">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Loại</th>
                                <th>Tên</th>
                                <th>Mô tả</th>
                                <th>Chính sách</th>
                                <th>Nhà cung cấp</th>
                                <th>Giá</th>
                                <th>Trạng thái</th>
                                <th class="col-schedule">Lịch trình</th>
                                <th class="col-image">Ảnh</th>
                                <th class="col-actions">Hành động</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php if (!empty($listData)): ?>
                                <?php foreach ($listData as $key => $value): ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= $value['category_name'] ?></td>
                                        <td><?= $value['tour_name'] ?></td>
                                        <td><?= $value['tour_description'] ?></td>
                                        <td><?= $value['policy'] ?></td>
                                        <td><?= $value['provider_name'] ?></td>

                                        <!-- GIÁ TOUR -->
<td>
    <?php if (!empty($value['prices'])): ?>
        <?php foreach ($value['prices'] as $price): ?>
            <div class="schedule-box" style="margin-bottom: 6px; padding:8px; border:1px solid #eee; border-radius:6px;">
                <strong><?= htmlspecialchars($price['target_group']) ?></strong><br>
                <span><?= number_format($price['price']) ?> đ</span><br>
                <?php
                    // Chuyển định dạng ngày từ YYYY-MM-DD => dd/mm/YYYY
                    $validFrom = !empty($price['valid_from']) ? date('d/m/Y', strtotime($price['valid_from'])) : '-';
                    $validTo = !empty($price['valid_to']) ? date('d/m/Y', strtotime($price['valid_to'])) : '-';
                ?>
                <small> <?= $validFrom ?> → <?= $validTo ?></small>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <span class="text-muted">Chưa có giá</span>
    <?php endif; ?>
</td>


                                        <!-- TRẠNG THÁI -->
                                        <td>
                                            <?= $value['status'] == 'active'
                                                ? '<span class="badge bg-success">Active</span>'
                                                : '<span class="badge bg-secondary">Inactive</span>' ?>
                                        </td>

                                        <!-- LỊCH TRÌNH GOM THEO NGÀY -->
                                        <td class="col-schedule">
                                            <?php if (!empty($value['schedules'])): ?>

                                                <?php
                                                    // Gom theo day_number
                                                    $grouped = [];
                                                    foreach ($value['schedules'] as $s) {
                                                        $grouped[$s['day_number']][] = $s;
                                                    }
                                                ?>

                                                <?php foreach ($grouped as $day => $items): ?>
                                                    <div class="schedule-box">
                                                        <strong>Ngày <?= $day ?></strong><br>

                                                        <?php foreach ($items as $activity): ?>
                                                            <div style="margin-left: 10px; margin-top:6px;">
                                                                <strong><?= htmlspecialchars($activity['activities']) ?></strong><br>
                                                                <small><?= $activity['start_time'] ?> → <?= $activity['end_time'] ?></small><br>
                                                                <small><?= htmlspecialchars($activity['location']) ?></small>
                                                            </div>
                                                        <?php endforeach; ?>

                                                    </div>
                                                <?php endforeach; ?>

                                            <?php else: ?>
                                                <span class="text-muted">Chưa có lịch trình</span>
                                            <?php endif; ?>
                                        </td>

                                        <!-- ẢNH TOUR -->
                                        <td class="col-image">
                                            <?php if (!empty($value['images'])): ?>
                                                <img src="<?= $value['images'] ?>" width="90" class="img-thumbnail">
                                            <?php else: ?>
                                                <span class="text-muted">Không có ảnh</span>
                                            <?php endif; ?>
                                        </td>

                                        <!-- ACTIONS -->
                                        <td class="col-actions">
                                            <a href="<?= BASE_URL ?>?action=admin-update-tour&id=<?= $value['tour_id'] ?>"
                                               class="btn btn-warning btn-sm w-100 mb-1">Sửa</a>

                                            <a href="<?= BASE_URL ?>?action=admin-delete-tour&id=<?= $value['tour_id'] ?>"
                                               onclick="return confirm('Bạn chắc chắn muốn xóa?')"
                                               class="btn btn-danger btn-sm w-100">Xóa</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="11" class="text-center text-muted">Không có dữ liệu</td>
                                </tr>
                            <?php endif; ?>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
