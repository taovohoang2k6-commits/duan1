<div class="container">
   <div class="row">
    <div class="col-3">
     <?php  include "views/admin/sidebar.php"; ?>
    </div>
    <div class="col-9">
        <form action="<?= BASE_URL ?>?action=admin-create-schedules" method="POST">
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
                <label for="">Ngày thứ mấy của tour</label>
                <input type="number" class="form-control" name="day_number">
            </div>
                                    <div class="md-4">
                <label for="">Mô tả hoạt động trong ngày</label>
                <input type="text" class="form-control" name="activities">
            </div>
                                                <div class="md-4">
                <label for="">Giờ bắt đầu</label>
                <input type="time" class="form-control" name="start_time">
            </div>
                                                <div class="md-4">
                <label for="">Giờ kết thúc</label>
                <input type="time" class="form-control" name="end_time">
            </div>
            <button class="btn btn-primary btn-sm">thêm mới</button>
        </form>
    </div>
   </div>
</div>