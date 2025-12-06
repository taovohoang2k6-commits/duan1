<div class="container">
    <div class="row">
        <div class="col-3">
            <?php include "views/admin/sidebar.php"; ?>
        </div>

        <div class="col-9">

            <h3>Danh sách khách hàng</h3>

            <a href="<?= BASE_URL ?>?action=admin-create-customers" 
               class="btn btn-primary btn-sm mb-3">
                Thêm mới
            </a>

            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Thuộc booking</th>
                        <th>Họ tên</th>
                        <th>Giới tính</th>
                        <th>Năm sinh</th>
                        <th>CMND / Hộ chiếu</th>
                        <th>Điện thoại</th>
                        <th>Thanh toán</th>
                        <th>Hành động</th>
                    </tr>
                </thead>

                <tbody>
                <?php if (!empty($listData) && is_array($listData)): ?>
                    <?php foreach ($listData as $key => $value): ?>
                        <tr>
                            <td><?= $key + 1 ?></td>

                            <td>
                                <?= !empty($value['booking_id']) 
                                    ? "Booking #" . $value['booking_id'] 
                                    : 'Không xác định' ?>
                            </td>

                            <td><?= $value['full_name'] ?></td>
                            <td><?= $value['gender'] ?></td>
                            <td><?= $value['dob'] ?></td>
                            <td><?= $value['id_number'] ?></td>
                            <td><?= $value['phone'] ?></td>

                            <td>
                                <?php if ($value['payment_status'] == 'đã thanh toán'): ?>
                                    <span class="badge bg-success">Đã thanh toán</span>
                                <?php else: ?>
                                    <span class="badge bg-warning">Chưa thanh toán</span>
                                <?php endif; ?>
                            </td>

                            <td>
                                <a href="<?= BASE_URL ?>?action=admin-update-customers&id=<?= $value['customer_id'] ?>" 
                                   class="btn btn-primary btn-sm">
                                    Sửa
                                </a>

                                <a href="<?= BASE_URL ?>?action=admin-delete-customers&id=<?= $value['customer_id'] ?>"
                                   onclick="return confirm('Bạn có chắc muốn xóa khách này?')"
                                   class="btn btn-danger btn-sm">
                                    Xóa
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                <?php else: ?>
                    <tr>
                        <td colspan="9" class="text-center text-muted">Không có dữ liệu</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>
