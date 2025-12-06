<div class="container">
   <div class="row">
    <div class="col-3">
     <?php  include "views/admin/sidebar.php"; ?>
    </div>
    <div class="col-9">
        <form action="<?= BASE_URL ?>?action=admin-create-departures" method="POST">
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
                <label for="">Ngày bắt đầu</label>
                <input type="date" class="form-control" name="start_date">
            </div>
                                    <div class="md-4">
                <label for="">Ngày kết thúc</label>
                <input type="date" class="form-control" name="end_date">
            </div>
                                                <div class="md-4">
                <label for="">Điểm tập trung</label>
                <input type="text" class="form-control" name="meeting_point">
            </div>
            <button class="btn btn-primary btn-sm">thêm mới</button>
        </form>
    </div>
   </div>
</div>