<?php
// Chuẩn bị giá tour cho select
foreach ($listTour as &$tour) {
    $tour['default_price'] = (new Tours())->getDefaultPrice($tour['tour_id']);
}
?>
<div class="container">
    <div class="row">
        <div class="col-3">
            <?php include "views/admin/sidebar.php"; ?>
        </div>
        <div class="col-9">
            <form action="<?= BASE_URL ?>?action=admin-create-bookings" method="POST">

                <!-- Chọn Tour -->
                <div class="md-4 mb-3">
                    <label for="">Tour</label>
                    <select name="tour_id" id="tour_id" class="form-control">
                        <?php foreach ($listTour as $value): ?>
                            <option value="<?= $value['tour_id'] ?>" 
                                    data-price="<?= $value['default_price'] ?>">
                                <?= $value['tour_name'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>


                <!-- Thông tin Booking -->
                <div class="md-4 mb-3">
                    <label>Tên khách/đoàn</label>
                    <input type="text" class="form-control" name="customer_name">
                </div>

                <div class="md-4 mb-3">
                    <label>Số điện thoại/email</label>
                    <input type="text" class="form-control" name="contact">
                </div>

                <div class="md-4 mb-3">
                    <label>Số lượng người</label>
                    <input type="number" id="quantity" class="form-control" name="quantity" value="1" readonly>
                </div>

                <div class="md-4 mb-3">
                    <label>Loại booking</label>
                    <select name="type" class="form-control">
                        <option value="Lẻ">Lẻ</option>
                        <option value="Đoàn">Đoàn</option>
                    </select>
                </div>

                <div class="md-4 mb-3">
                    <label>Ngày khởi hành dự kiến</label>
                    <input type="date" class="form-control" name="start_date">
                </div>

                <div class="md-4 mb-3">
                    <label>Trạng thái</label>
                    <select name="status" class="form-control">
                        <option value="chờ xác nhận">chờ xác nhận</option>
                        <option value="đã cọc">đã cọc</option>
                        <option value="hoàn tất">hoàn tất</option>
                        <option value="hủy">hủy</option>
                    </select>
                </div>

                <div class="md-4 mb-3">
                    <label>Ngày tạo</label>
                    <input type="date" class="form-control" name="created_at">
                </div>

                <!-- Deposit / Total / Remaining -->
                <div class="md-4 mb-3">
                    <label>Deposit (Đặt cọc)</label>
                    <input type="number" class="form-control" name="deposit" value="0" min="0">
                </div>

                <div class="md-4 mb-3">
                    <label>Total (Tổng tiền)</label>
                    <input type="number" class="form-control" name="total" value="0" readonly>
                </div>

                <div class="md-4 mb-3">
                    <label>Remaining (Còn lại)</label>
                    <input type="number" class="form-control" name="remaining" value="0" readonly>
                </div>


                <!-- Danh sách khách -->
                <h4>Danh sách khách</h4>
                <div id="customers-wrapper">
                    <div class="customer-item mb-3 border p-3">
                        <div class="md-4 mb-2">
                            <label>Họ tên</label>
                            <input type="text" name="customers[0][full_name]" class="form-control">
                        </div>
                        <div class="md-4 mb-2">
                            <label>Giới tính</label>
                            <select name="customers[0][gender]" class="form-control">
                                <option value="Nam">Nam</option>
                                <option value="Nữ">Nữ</option>
                            </select>
                        </div>
                        <div class="md-4 mb-2">
                            <label>Ngày sinh</label>
                            <input type="date" name="customers[0][dob]" class="form-control">
                        </div>
                        <div class="md-4 mb-2">
                            <label>CMND/CCCD</label>
                            <input type="text" name="customers[0][id_number]" class="form-control">
                        </div>
                        <div class="md-4 mb-2">
                            <label>SĐT</label>
                            <input type="text" name="customers[0][phone]" class="form-control">
                        </div>
                        <div class="md-4 mb-2">
                            <label>Thanh toán</label>
                            <select name="customers[0][payment_status]" class="form-control">
                                <option value="Chưa thanh toán">Chưa thanh toán</option>
                                <option value="Đã cọc">Đã cọc</option>
                                <option value="Đã thanh toán">Đã thanh toán</option>
                            </select>
                        </div>
                      
                        <div class="mt-2">
                            <button type="button" class="btn btn-danger btn-sm" onclick="removeCustomer(this)">Xóa khách</button>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <button type="button" class="btn btn-success" onclick="addCustomer()">+ Thêm khách</button>
                </div>

                <div class="mt-3">
                    <button class="btn btn-primary btn-sm">Thêm mới</button>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
let customerIndex = 1;
const wrapper = document.getElementById('customers-wrapper');

const tourSelect = document.getElementById('tour_id');
const quantityInput = document.getElementById('quantity');
const totalInput = document.querySelector('input[name="total"]');
const depositInput = document.querySelector('input[name="deposit"]');
const remainingInput = document.querySelector('input[name="remaining"]');

// Thêm khách
function addCustomer() {
    const idx = customerIndex;
    const html = `
    <div class="customer-item mb-3 border p-3">
        <div class="md-4 mb-2">
            <label>Họ tên</label>
            <input type="text" name="customers[${idx}][full_name]" class="form-control">
        </div>
        <div class="md-4 mb-2">
            <label>Giới tính</label>
            <select name="customers[${idx}][gender]" class="form-control">
                <option value="Nam">Nam</option>
                <option value="Nữ">Nữ</option>
            </select>
        </div>
        <div class="md-4 mb-2">
            <label>Ngày sinh</label>
            <input type="date" name="customers[${idx}][dob]" class="form-control">
        </div>
        <div class="md-4 mb-2">
            <label>CMND/CCCD</label>
            <input type="text" name="customers[${idx}][id_number]" class="form-control">
        </div>
        <div class="md-4 mb-2">
            <label>SĐT</label>
            <input type="text" name="customers[${idx}][phone]" class="form-control">
        </div>
        <div class="md-4 mb-2">
            <label>Thanh toán</label>
            <select name="customers[${idx}][payment_status]" class="form-control">
                <option value="Chưa thanh toán">Chưa thanh toán</option>
                <option value="Đã cọc">Đã cọc</option>
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
    updateTotal();
    attachDepositListeners();
}

// Xóa khách
function removeCustomer(btn) {
    btn.closest('.customer-item').remove();
    updateQuantity();
    updateTotal();
    attachDepositListeners();
}

// cập nhật số khách
function updateQuantity() {
    quantityInput.value = wrapper.querySelectorAll('.customer-item').length;
}

// Cập nhật deposit tổng
function updateDepositTotal() {
    let totalDeposit = 0;
    wrapper.querySelectorAll('input.customer-deposit').forEach(input => {
        totalDeposit += parseFloat(input.value) || 0;
    });
    depositInput.value = totalDeposit;
    updateRemaining();
}

// Gắn sự kiện cho input deposit
function attachDepositListeners() {
    wrapper.querySelectorAll('input.customer-deposit').forEach(input => {
        input.removeEventListener('input', updateDepositTotal);
        input.addEventListener('input', updateDepositTotal);
    });
}

// Tính tổng tiền
function updateTotal() {
    const price = parseFloat(tourSelect.options[tourSelect.selectedIndex].dataset.price) || 0;
    const quantity = parseInt(quantityInput.value) || 0;
    totalInput.value = price * quantity;
    updateDepositTotal();
}

function updateRemaining() {
    const deposit = parseFloat(depositInput.value) || 0;
    const total = parseFloat(totalInput.value) || 0;
    remainingInput.value = total - deposit;
}

// Listener
tourSelect.addEventListener('change', updateTotal);
depositInput.addEventListener('input', updateRemaining);

// Init
document.addEventListener('DOMContentLoaded', function() {
    updateQuantity();
    updateTotal();
    attachDepositListeners();
});
</script>
