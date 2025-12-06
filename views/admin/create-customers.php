<div class="container">
   <div class="row">
    <div class="col-3">
        <?php include "views/admin/sidebar.php"; ?>
    </div>

    <div class="col-9">
        <h3>Thêm khách hàng</h3>

        <form action="<?= BASE_URL ?>?action=admin-create-customers" method="POST">

            <div class="mb-3">
                <label>Booking</label>
                <select name="booking_id" class="form-control" required>
                    <?php foreach ($listBooking as $value): ?>
                        <option value="<?= $value['booking_id'] ?>">
                            Booking #<?= $value['booking_id'] ?> - <?= $value['customer_name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label>Họ tên</label>
                <input type="text" class="form-control" name="full_name" required placeholder="Nhập họ tên khách hàng">
            </div>

            <div class="mb-3">
                <label>Giới tính</label>
                <select name="gender" class="form-control" required>
                    <option value="Nam">Nam</option>
                    <option value="Nữ">Nữ</option>
                    <option value="Khác">Khác</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Năm sinh</label>
                <input type="date" class="form-control" name="dob" required>
            </div>

            <div class="mb-3">
                <label>CMND / Hộ chiếu</label>
                <input type="text" class="form-control" name="id_number" placeholder="Nhập số giấy tờ" required>
            </div>

            <div class="mb-3">
                <label>Số điện thoại</label>
                <input type="text" class="form-control" name="phone" placeholder="Ví dụ: 0987xxxxxx" required>
            </div>

            <div class="mb-3">
                <label>Trạng thái thanh toán</label>
                <select name="payment_status" class="form-control" required>
                    <option value="chưa thanh toán">Chưa thanh toán</option>
                    <option value="đã thanh toán">Đã thanh toán</option>
                </select>
            </div>

            <button class="btn btn-primary btn-sm">Thêm mới</button>
        </form>
    </div>
   </div>
</div>
