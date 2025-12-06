<div class="container">
    <div class="row">
        <div class="col-3">
            <?php include "views/admin/sidebar.php"; ?>
        </div>

        <div class="col-9">

            <form action="<?= BASE_URL ?>?action=admin-update-bookings" method="POST">

                <input type="hidden" name="booking_id" value="<?= $booking['booking_id'] ?>">

                <!-- Tour -->
                <div class="md-4">
                    <label>Tour</label>
                    <select name="tour_id" class="form-control">
                        <?php foreach ($listTour as $value): ?>
                            <option value="<?= $value['tour_id'] ?>"
                                <?= $value['tour_id'] == $booking['tour_id'] ? 'selected' : '' ?>>
                                <?= $value['tour_name'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <h4 class="mt-3">Danh sách khách</h4>

                <div id="customers-wrapper">
                    <?php foreach ($customerList as $i => $c): ?>
                        <div class="customer-item mb-3 border p-3">

                            <!-- Giữ ID khách để update -->
                            <input type="hidden" name="customers[<?= $i ?>][customer_id]"
                                   value="<?= $c['customer_id'] ?>">

                            <div class="md-4">
                                <label>Họ tên</label>
                                <input type="text" name="customers[<?= $i ?>][full_name]"
                                       value="<?= $c['full_name'] ?>" class="form-control">
                            </div>

                            <div class="md-4">
                                <label>Giới tính</label>
                                <select name="customers[<?= $i ?>][gender]" class="form-control">
                                    <option value="Nam" <?= $c['gender']=='Nam'?'selected':'' ?>>Nam</option>
                                    <option value="Nữ" <?= $c['gender']=='Nữ'?'selected':'' ?>>Nữ</option>
                                </select>
                            </div>

                            <div class="md-4">
                                <label>Ngày sinh</label>
                                <input type="date" name="customers[<?= $i ?>][dob]"
                                       value="<?= $c['dob'] ?>" class="form-control">
                            </div>

                            <div class="md-4">
                                <label>CMND/CCCD</label>
                                <input type="text" name="customers[<?= $i ?>][id_number]"
                                       value="<?= $c['id_number'] ?>" class="form-control">
                            </div>

                            <div class="md-4">
                                <label>SĐT</label>
                                <input type="text" name="customers[<?= $i ?>][phone]"
                                       value="<?= $c['phone'] ?>" class="form-control">
                            </div>

                            <div class="md-4">
                                <label>Thanh toán</label>
                                <select name="customers[<?= $i ?>][payment_status]" class="form-control">
                                    <option value="Chưa thanh toán"
                                        <?= $c['payment_status']=='Chưa thanh toán'?'selected':'' ?>>
                                        Chưa thanh toán
                                    </option>

                                    <option value="Đã thanh toán"
                                        <?= $c['payment_status']=='Đã thanh toán'?'selected':'' ?>>
                                        Đã thanh toán
                                    </option>
                                </select>
                            </div>

                            <div class="mt-2">
                                <button type="button" class="btn btn-danger btn-sm" onclick="removeCustomer(this)">Xóa khách</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="mb-3">
                    <button type="button" class="btn btn-success" onclick="addCustomer()">+ Thêm khách</button>
                </div>

            
                <div class="md-4">
                    <label>Tên khách/đoàn</label>
                    <input type="text" name="customer_name" class="form-control"
                           value="<?= $booking['customer_name'] ?>">
                </div>

                <div class="md-4">
                    <label>SĐT/email</label>
                    <input type="text" name="contact" class="form-control"
                           value="<?= $booking['contact'] ?>">
                </div>

                <div class="md-4">
                    <label>Số lượng</label>
                    <input type="number" id="quantity" name="quantity" readonly
                           class="form-control" value="<?= count($customerList) ?>">
                </div>

                <div class="md-4">
                    <label>Loại booking</label>
                    <select name="type" class="form-control">
                        <option value="Lẻ" <?= $booking['type']=='Lẻ'?'selected':'' ?>>Lẻ</option>
                        <option value="Đoàn" <?= $booking['type']=='Đoàn'?'selected':'' ?>>Đoàn</option>
                    </select>
                </div>

                <div class="md-4">
                    <label>Ngày khởi hành</label>
                    <input type="date" name="start_date" class="form-control"
                           value="<?= $booking['start_date'] ?>">
                </div>

                <div class="md-4">
                    <label>Trạng thái</label>
                    <select name="status" class="form-control">
                        <option value="Chờ xác nhận" <?= $booking['status']=='Chờ xác nhận'?'selected':'' ?>>Chờ xác nhận</option>
                        <option value="Đã cọc" <?= $booking['status']=='Đã cọc'?'selected':'' ?>>Đã cọc</option>
                         <option value="Hoàn thành" <?= $booking['status']=='Hoàn thành'?'selected':'' ?>>Hoàn thành</option>
                          <option value="Dang hoạt động" <?= $booking['status']=='Dang hoạt động'?'selected':'' ?>>Dang hoạt động</option>
                    </select>
                </div>

                <div class="mt-3">
                    <button class="btn btn-primary btn-sm">Cập nhật</button>
                </div>

            </form>
        </div>
    </div>
</div>


<script>
let customerIndex = <?= count($customerList) ?>;
const wrapper = document.getElementById('customers-wrapper');

function addCustomer() {
    const idx = customerIndex;
    const html = `
    <div class="customer-item mb-3 border p-3">

        <input type="hidden" name="customers[${idx}][customer_id]" value="0">

        <div class="md-4">
            <label>Họ tên</label>
            <input type="text" name="customers[${idx}][full_name]" class="form-control">
        </div>

        <div class="md-4">
            <label>Giới tính</label>
            <select name="customers[${idx}][gender]" class="form-control">
                <option value="Nam">Nam</option>
                <option value="Nữ">Nữ</option>
            </select>
        </div>

        <div class="md-4">
            <label>Ngày sinh</label>
            <input type="date" name="customers[${idx}][dob]" class="form-control">
        </div>

        <div class="md-4">
            <label>CMND/CCCD</label>
            <input type="text" name="customers[${idx}][id_number]" class="form-control">
        </div>

        <div class="md-4">
            <label>SĐT</label>
            <input type="text" name="customers[${idx}][phone]" class="form-control">
        </div>

        <div class="md-4">
            <label>Thanh toán</label>
            <select name="customers[${idx}][payment_status]" class="form-control">
                <option value="Chưa thanh toán">Chưa thanh toán</option>
                <option value="Đã thanh toán">Đã thanh toán</option>
            </select>
        </div>

        <div class="mt-2">
            <button type="button" class="btn btn-danger btn-sm" onclick="removeCustomer(this)">Xóa khách</button>
        </div>
    </div>
    `;
    wrapper.insertAdjacentHTML('beforeend', html);
    customerIndex++;
    updateQuantity();
}

function removeCustomer(btn) {
    btn.closest('.customer-item').remove();
    updateQuantity();
}

function updateQuantity() {
    document.getElementById('quantity').value =
        wrapper.querySelectorAll('.customer-item').length;
}
</script>
