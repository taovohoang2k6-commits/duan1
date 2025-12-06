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

            <div class="page-header ">
                <h2 class="mb-0">Danh sách Nhà Cung Cấp</h2>
                <a href="<?= BASE_URL ?>?action=admin-create-providers" class="btn btn-primary btn-sm">Thêm mới</a>
            </div>

     
            <div class="table-wrapper mt-3">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên nhà cung cấp</th>
                                <th>Loại</th>
                                <th>Liên hệ</th>
                                <th>Địa chỉ</th>
                                <th class="text-center">Hành động</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if (!empty($listData) && is_array($listData)): ?>
                                <?php foreach ($listData as $key => $value): ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= htmlspecialchars($value['name']) ?></td>
                                        <td><?= htmlspecialchars($value['type']) ?></td>
                                        <td><?= htmlspecialchars($value['contact']) ?></td>
<td><?= htmlspecialchars($value['address']) ?></td>
                                        <td class="text-center">
                                            <a href="<?= BASE_URL ?>?action=admin-update-providers&id=<?= $value['provider_id'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                                            <a href="<?= BASE_URL ?>?action=admin-delete-providers&id=<?= $value['provider_id'] ?>" 
                                               onclick="return confirm('Bạn có muốn xóa không?')" 
                                               class="btn btn-danger btn-sm">Xóa</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Không có dữ liệu</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>

                    </table>
                </div>
            </div>

        </div>

    </div>
</div>
