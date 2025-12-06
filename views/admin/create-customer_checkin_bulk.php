<div class="container">
    <h3>Điểm danh khách theo chuyến</h3>

    <form method="GET">
        <label>Chọn chuyến đi</label>
        <select name="departure_id" class="form-select" onchange="this.form.submit()">
            <option value="">-- chọn --</option>
            <?php foreach ($listDepartures as $dep): ?>
                <option value="<?= $dep['departure_id'] ?>"
                    <?= isset($_GET['departure_id']) && $_GET['departure_id'] == $dep['departure_id'] ? "selected" : "" ?>>
                    <?= $dep['tour_name'] ?> - <?= $dep['start_date'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </form>

    <hr>

    <?php if (!empty($customers)): ?>
    <form method="POST">

        <input type="hidden" name="departure_id" value="<?= $_GET['departure_id'] ?>">
        <input type="hidden" name="guide_id" value="<?= $guide['guide_id'] ?>">
        <input type="hidden" name="checkin_date" value="<?= date('Y-m-d') ?>">

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Khách</th>
                    <th>Trạng thái</th>
                    <th>Ghi chú</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($customers as $c): ?>
                <tr>
                    <td><?= $c['full_name'] ?></td>

                    <td>
                        <select name="status[<?= $c['customer_id'] ?>]" class="form-select">
                            <option value="đã đến">Đã đến</option>
                            <option value="đến trễ">Đến trễ</option>
                            <option value="vắng mặt">Vắng mặt</option>
                        </select>
                    </td>

                    <td>
                        <input type="text" name="note[<?= $c['customer_id'] ?>]" class="form-control">
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <button class="btn btn-primary">Lưu điểm danh</button>
    </form>
    <?php endif; ?>
</div>
