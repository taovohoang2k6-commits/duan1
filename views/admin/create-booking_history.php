<div class="container">
   <div class="row">
    <div class="col-3">
        <?php include "views/admin/sidebar.php"; ?>
    </div>

    <div class="col-9">
        <h3>Thêm lịch sử booking</h3>

        <form action="<?= BASE_URL ?>?action=admin-create-booking_history" method="POST">

            <div class="mb-3">
                <label>Booking</label>
                <select name="booking_id" class="form-control">
                    <?php foreach ($listBooking as $value): ?>
                        <option value="<?= $value['booking_id'] ?>">
                            <?= $value['customer_name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label>Trạng thái thay đổi</label>
                <input type="text" class="form-control" name="status" placeholder="Ví dụ: đã cọc, hủy, hoàn tất">
            </div>

            <div class="mb-3">
                <label>Thời điểm thay đổi</label>
                <input type="datetime-local" class="form-control" name="changed_at" value="<?= date('Y-m-d\TH:i') ?>">
            </div>

            <div class="mb-3">
                <label>Người thay đổi</label>
                <input type="text" class="form-control" name="changed_by" placeholder="Tên người thực hiện">
            </div>

            <button class="btn btn-primary btn-sm">Thêm mới</button>
        </form>
    </div>
   </div>
</div>
