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


            <div class="page-header">
                <h2 class="mb-0">Danh sách Giá Tour</h2>
                <a href="<?= BASE_URL ?>?action=admin-create-prices" class="btn btn-primary btn-sm">Thêm mới</a>
            </div>


            <div class="table-wrapper mt-3">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tour</th>
                                <th>Đối tượng</th>
                                <th>Giá</th>
                                <th>Ngày bắt đầu áp dụng</th>
                                <th>Ngày kết thúc áp dụng</th>
                                <th class="text-center">Hành động</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if (!empty($listData) && is_array($listData)): ?>
                                <?php foreach ($listData as $key => $value): ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= htmlspecialchars($value['tour_name']) ?></td>
                                    <td><?= htmlspecialchars($value['target_group']) ?></td>

                                    <td class="">
                                        <?= number_format($value['price']) ?> đ
                                    </td>

                                    <td><?= htmlspecialchars($value['valid_from']) ?></td>
                                    <td><?= htmlspecialchars($value['valid_to']) ?></td>

                                    <td class="text-center">
                                        <a 
                                            href="<?= BASE_URL ?>?action=admin-update-prices&id=<?= $value['price_id'] ?>" 
                                            class="btn btn-warning btn-sm">
                                            Sửa
                                        </a>

                                        <a 
                                            href="<?= BASE_URL ?>?action=admin-delete-prices&id=<?= $value['price_id'] ?>" 
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
