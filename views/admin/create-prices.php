<div class="container">
   <div class="row">
    <div class="col-3">
     <?php  include "views/admin/sidebar.php"; ?>
    </div>
    <div class="col-9">
        <form action="<?= BASE_URL ?>?action=admin-create-prices" method="POST">
            <div class="md-4">
                <label for="">Tour</label>
                                    <select name="tour_id" class="form-control">
                        <?php foreach ($listTour as $value): ?>
                            <option value="<?= $value['tour_id'] ?>">
                                <?= $value['tour_name'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
            </div>
                        <div class="md-4">
                <label for="">Đối tượng</label>
                <input type="text" class="form-control" name="target_group">
            </div>
                                    <div class="md-4">
                <label for="">Giá</label>
                <input type="number" class="form-control" name="price">
            </div>
                                                <div class="md-4">
                <label for="">Ngày bắt đầu áp dụng</label>
                <input type="date" class="form-control" name="valid_from">
            </div>
                                                <div class="md-4">
                <label for="">Ngày kết thúc áp dụng</label>
                <input type="date" class="form-control" name="valid_to">
            </div>
            <button class="btn btn-primary btn-sm">thêm mới</button>
        </form>
    </div>
   </div>
</div>