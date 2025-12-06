<div class="container">
    <div class="row">
        <div class="col-3">
            <?php include "views/admin/sidebar.php"; ?>
        </div>

        <div class="col-9">

            <h3>Danh sách yêu cầu đặc biệt</h3>

            <a href="<?= BASE_URL ?>?action=admin-create-special_requests" 
               class="btn btn-primary btn-sm mb-3">
               Thêm mới
            </a>

            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Khách hàng</th>
                        <th>Loại yêu cầu</th>
                        <th>Mô tả</th>
                        <th>Đã xử lý?</th>
                        <th>Hành động</th>
                    </tr>
                </thead>

                <tbody>
                <?php if (!empty($listData) && is_array($listData)): ?>
                    <?php foreach ($listData as $key => $value): ?>
                        <tr>
                            <td><?= $key + 1 ?></td>

                            <td><?= $value['full_name'] ?? 'Không xác định' ?></td>

                            <td><?= $value['request_type'] ?></td>

                            <td><?= $value['description'] ?></td>

                            <td>
                                <?php if ($value['handled'] == 1): ?>
                                    <span class="badge bg-success">Đã xử lý</span>
                                <?php else: ?>
                                    <span class="badge bg-warning">Chưa xử lý</span>
                                <?php endif; ?>
                            </td>

                            <td>
                                <a href="<?= BASE_URL ?>?action=admin-update-special_requests&id=<?= $value['request_id'] ?>" 
                                    class="btn btn-primary btn-sm">
                                    Sửa
                                </a>

                                <a href="<?= BASE_URL ?>?action=admin-delete-special_requests&id=<?= $value['request_id'] ?>"
                                    onclick="return confirm('Bạn có chắc muốn xóa yêu cầu này?')"
                                    class="btn btn-danger btn-sm">
                                    Xóa
                                </a>
                            </td>
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
