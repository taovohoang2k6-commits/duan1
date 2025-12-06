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

</style>
<div class="container">
    <div class="row">
        <div class="col-3">
            <?php include "views/admin/sidebar.php"; ?>
        </div>

        <div class="col-9">
            <a href="<?= BASE_URL ?>?action=admin-create-guides" class="btn btn-primary btn-sm">Thêm mới</a>

            <table class="table">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>SĐT</th>
                        <th>Ngôn ngữ</th>
                        <th>Trạng thái</th>
                        <th>Vai trò</th>
                        <th>Hành động</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($listData)): ?>
                        <?php foreach ($listData as $key => $value): ?>
                            <tr>
                                <td><?= $key + 1 ?></td>
                                <td><?= $value['full_name'] ?></td>
                                <td><?= $value['email'] ?></td>
                                <td><?= $value['password'] ?></td>
                                <td><?= $value['phone'] ?></td>
                                <td><?= $value['language'] ?></td>
                                <td><?= $value['status'] ?></td>
                                <td><?= $value['role'] ?></td>

                                <td>
                                    <a href="<?= BASE_URL ?>?action=admin-update-guides&id=<?= $value['guide_id'] ?>" class="btn btn-primary">Sửa</a>
                                    <a href="<?= BASE_URL ?>?action=admin-delete-guides&id=<?= $value['guide_id'] ?>" 
                                       onclick="return confirm('Bạn có muốn xóa không?')" 
                                       class="btn btn-danger">Xóa</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="8">Không có dữ liệu</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
