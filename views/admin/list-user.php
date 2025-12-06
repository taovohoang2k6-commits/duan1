<div class="container">
    <div class="row">
        <div class="col-3">
            <?php include "views/admin/sidebar.php"; ?>
        </div>
        <div class="col-9">
            <a href="<?= BASE_URL ?>?action=admin-create-users" class="btn btn-primary btn-sm">Thêm mới</a>
            <table class="table">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên người dùng</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Địa chỉ</th>
                        <th>vai trò</th>
                        <th>hành động</th>

                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($listData) && is_array($listData)): ?>
                        <?php foreach ($listData as $key => $value): ?>
                            <tr>
                                <td><?= $key + 1 ?></td>
                                <td><?= htmlspecialchars($value['name']) ?></td>
                                <td><?= htmlspecialchars($value['email']) ?></td>
                                <td><?= htmlspecialchars($value['phone']) ?></td>
                                <td><?= htmlspecialchars($value['address']) ?></td>
                                <td><?php if ($value['role'] == "0"): ?>
                                        <span>HDV</span>
                                    <?php else: ?>
                                        <span>ADMIN</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?= BASE_URL ?>?action=admin-update-users&id=<?= $value['id'] ?>">Sửa</a>
                                    <a href="<?= BASE_URL ?>?action=admin-delete-users&id=<?= $value['id'] ?>" onclick="return confirm('Bạn có muốn xóa không')">Xóa</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">Không có dữ liệu</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>