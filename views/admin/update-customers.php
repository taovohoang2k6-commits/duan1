<div class="container">
   <div class="row">
    <div class="col-3">
        <?php include "views/admin/sidebar.php"; ?>
    </div>

    <div class="col-9">
        <h3>Cập nhật khách hàng</h3>

        <form action="<?= BASE_URL ?>?action=admin-update-customers" method="POST">

            <input type="hidden" name="customer_id" value="<?= $one['customer_id'] ?>">

            <div class="mb-3">
                <label>Booking</label>
                <select name="booking_id" class="form-control" required>
                    <?php foreach ($listBooking as $value): ?>
                        <option 
                            value="<?= $value['booking_id'] ?>"
                            <?= $value['booking_id'] == $one['booking_id'] ? 'selected' : '' ?>
                        >
                            Booking #<?= $value['booking_id'] ?> - <?= $value['customer_name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label>Họ tên</label>
                <input type="text" class="form-control" name="full_name" 
                       value="<?= $one['full_name'] ?>" required>
            </div>

            <div class="mb-3">
                <label>Giới tính</label>
                <select name="gender" class="form-control" required>
                    <option value="Nam"  <?= $one['gender'] == 'Nam' ? 'selected' : '' ?>>Nam</option>
                    <option value="Nữ"   <?= $one['gender'] == 'Nữ' ? 'selected' : '' ?>>Nữ</option>
                    <option value="Khác" <?= $one['gender'] == 'Khác' ? 'selected' : '' ?>>Khác</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Năm sinh</label>
                <input type="date" class="form-control" name="dob"
                       value="<?= $one['dob'] ?>" required>
            </div>

            <div class="mb-3">
                <label>CMND / Hộ chiếu</label>
                <input type="text" class="form-control" name="id_number" 
                       value="<?= $one['id_number'] ?>" required>
            </div>

            <div class="mb-3">
                <label>Số điện thoại</label>
                <input type="text" class="form-control" name="phone" 
                       value="<?= $one['phone'] ?>" required>
            </div>

            <div class="mb-3">
                <label>Trạng thái thanh toán</label>
                <select name="payment_status" class="form-control" required>
                    <option value="chưa thanh toán" <?= $one['payment_status'] == 'chưa thanh toán' ? 'selected' : '' ?>>Chưa thanh toán</option>
                    <option value="đã thanh toán"   <?= $one['payment_status'] == 'đã thanh toán' ? 'selected' : '' ?>>Đã thanh toán</option>
                </select>
            </div>

            <button class="btn btn-primary btn-sm">Cập nhật</button>
        </form>
    </div>
   </div>
</div>
