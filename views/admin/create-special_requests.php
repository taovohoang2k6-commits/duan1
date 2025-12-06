<div class="container">
    <div class="row">
        <div class="col-3">
            <?php include "views/admin/sidebar.php"; ?>
        </div>

        <div class="col-9">
            <h3>Thêm yêu cầu đặc biệt</h3>

            <form action="<?= BASE_URL ?>?action=admin-create-special_requests" method="POST">

                <div class="mb-3">
                    <label>Khách hàng</label>
                    <select name="customer_id" class="form-control">
                        <?php foreach ($listCustomer as $value): ?>
                            <option value="<?= $value['customer_id'] ?>">
                                <?= $value['full_name'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Loại yêu cầu</label>
                    <input type="text" class="form-control" name="request_type" placeholder="Ví dụ: ăn chay, dị ứng...">
                </div>

                <div class="mb-3">
                    <label>Mô tả chi tiết</label>
                    <textarea class="form-control" name="description"></textarea>
                </div>

                <div class="mb-3">
                    <label>Đã xử lý?</label>
                    <select name="handled" class="form-control">
                        <option value="0">Chưa xử lý</option>
                        <option value="1">Đã xử lý</option>
                    </select>
                </div>

                <button class="btn btn-primary btn-sm">Thêm mới</button>

            </form>
        </div>
    </div>
</div>
