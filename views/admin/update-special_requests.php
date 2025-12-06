<div class="container">
    <div class="row">
        <div class="col-3">
            <?php include "views/admin/sidebar.php"; ?>
        </div>

        <div class="col-9">
            <h3>Cập nhật yêu cầu đặc biệt</h3>

            <form action="<?= BASE_URL ?>?action=admin-update-special_requests&id=<?= $data['request_id'] ?>" method="POST">
 <input type="hidden" name="request_id" value="<?= $data['request_id'] ?>">
                <div class="mb-3">
                    <label>Khách hàng</label>
                    <select name="customer_id" class="form-control">
                        <?php foreach ($listCustomer as $value): ?>
                            <option 
                               value="<?= $value['customer_id'] ?>"
                               <?= $value['customer_id'] == $data['customer_id'] ? 'selected' : '' ?>>
                                <?= $value['full_name'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Loại yêu cầu</label>
                    <input type="text" class="form-control" name="request_type"
                           value="<?= $data['request_type'] ?>">
                </div>

                <div class="mb-3">
                    <label>Mô tả chi tiết</label>
                    <textarea class="form-control" name="description"><?= $data['description'] ?></textarea>
                </div>

                <div class="mb-3">
                    <label>Đã xử lý?</label>
                    <select name="handled" class="form-control">
                        <option value="0" <?= $data['handled'] == 0 ? 'selected' : '' ?>>Chưa xử lý</option>
                        <option value="1" <?= $data['handled'] == 1 ? 'selected' : '' ?>>Đã xử lý</option>
                    </select>
                </div>

                <button class="btn btn-primary btn-sm">Cập nhật</button>

            </form>
        </div>
    </div>
</div>
