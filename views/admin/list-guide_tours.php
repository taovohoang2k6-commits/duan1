<div class="container py-4">
    <div class="row">

        <!-- SIDEBAR -->
        <div class="col-3">
            <?php include "views/admin/sidebar.php"; ?>
        </div>

        <!-- NỘI DUNG -->
        <div class="col-9">
            <h3>Danh sách Tour được phân công</h3>


            <?php if (empty($listData)): ?>
                <div class="alert alert-warning">
                    Không tìm thấy tour nào được phân công cho hướng dẫn viên này.
                </div>
            <?php else: ?>
                <div class="list-group">
                    <?php foreach ($listData as $item): ?>
                        <div class="list-group-item mb-2 shadow-sm">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1"><?= htmlspecialchars($item['tour_name'] ?? '') ?></h5>
                                <small class="text-muted">Khởi hành: <?= htmlspecialchars($item['start_date'] ?? 'N/A') ?></small>
                            </div>

                            <p class="mb-1 text-muted">
                                <?= htmlspecialchars($item['meeting_point'] ?? '') ?>
                            </p>

                            <div class="d-flex align-items-center justify-content-between mt-2">
                                <div class="small text-muted">
                                    <?php if (!empty($item['guide_name'])): ?>
                                        Hướng dẫn viên: <?= htmlspecialchars($item['guide_name']) ?>
                                    <?php endif; ?>

                                    <?php if (!empty($item['provider_name'])): ?>
                                        <br />Nhà cung cấp: <?= htmlspecialchars($item['provider_name']) ?>
                                    <?php endif; ?>

                                    <?php if (!empty($item['role'])): ?>
                                        <br />Vai trò: <?= htmlspecialchars($item['role']) ?>
                                    <?php endif; ?>
                                </div>

                                <div>
                                    <a href="<?= BASE_URL ?>?action=admin-list-customer_checkin&departure_id=<?= $item['departure_id'] ?>"
                                        class="btn btn-sm btn-primary">Điểm danh</a>

                                    <a href="<?= BASE_URL ?>?action=admin-detail-guide_tours&departure_id=<?= $item['departure_id'] ?>"
                                        class="btn btn-sm btn-outline-secondary">Chi tiết</a>
                                </div>
                            </div>

                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>

<style>
    .list-group-item h5 {
        margin-bottom: 0;
    }
</style>