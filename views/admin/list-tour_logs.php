<style>
.main-content {
    padding-left: 0 !important;
    margin-left: 0 !important;
}
</style>

<div class="container-fluid">
    <div class="row">

        <div class="col-2 p-0">
            <?php include "views/admin/sidebar.php"; ?>
        </div>

        <div class="col-10 main-content">

            <div class="page-header d-flex justify-content-between align-items-center">
                <h2 class="mb-0">Nhật ký Tour</h2>
                <a href="<?= BASE_URL ?>?action=admin-create-tour_logs" class="btn btn-primary btn-sm">Thêm mới</a>
            </div>

            <div class="table-wrapper mt-3">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tour</th>
                                <th>Hướng dẫn viên</th>
                                <th>Ngày</th>
                                <th>Ghi chú</th>
                                <th>Vấn đề</th>
                        
                            </tr>
                        </thead>

                        <tbody>
                            <?php if (!empty($listData) && is_array($listData)): ?>
                                <?php foreach ($listData as $key => $value): ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>

                                    <td>
                                        <?= htmlspecialchars($value['tour_name'] ?? '---') ?><br>
                                        <small class="text-muted">
                                            Mã Tour: <?= htmlspecialchars($value['tour_id'] ?? '') ?>
                                        </small>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($value['guide_name'] ?? '---') ?><br>
                                        <small class="text-muted">
                                            ID: <?= htmlspecialchars($value['guide_id'] ?? '') ?>
                                        </small>
                                    </td>

                                    <td><?= htmlspecialchars($value['date']) ?></td>

                                    <td><?= nl2br(htmlspecialchars($value['note'])) ?></td>

                                    <td><?= nl2br(htmlspecialchars($value['issues'])) ?></td>

                                  
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="7" class="text-center text-muted">Không có dữ liệu</td></tr>
                            <?php endif; ?>
                        </tbody>

                    </table>
                </div>
            </div>

        </div>

    </div>
</div>
