<form action="<?= BASE_URL ?>?action=admin-update-schedules" method="POST">
    <input type="hidden" name="id" value="<?= $schedule['schedule_id'] ?>">

    <div class="md-4">
        <label>Tour</label>
        <select name="tour_id" class="form-control">
            <?php foreach ($listTour as $value): ?>
                <option 
                    value="<?= $value['tour_id'] ?>"
                    <?= $value['tour_id'] == $schedule['tour_id'] ? 'selected' : '' ?>
                >
                    <?= $value['tour_name'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="md-4">
        <label>Ngày thứ mấy của tour</label>
        <input type="number" class="form-control" name="day_number"
               value="<?= $schedule['day_number'] ?>">
    </div>

    <div class="md-4">
        <label>Mô tả hoạt động trong ngày</label>
        <input type="text" class="form-control" name="activities"
               value="<?= $schedule['activities'] ?>">
    </div>

    <div class="md-4">
        <label>Giờ bắt đầu</label>
        <input type="time" class="form-control" name="start_time"
               value="<?= $schedule['start_time'] ?>">
    </div>

    <div class="md-4">
        <label>Giờ kết thúc</label>
        <input type="time" class="form-control" name="end_time"
               value="<?= $schedule['end_time'] ?>">
    </div>

    <button class="btn btn-primary btn-sm">Sửa</button>
</form>
