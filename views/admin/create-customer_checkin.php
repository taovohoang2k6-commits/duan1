<div class="container">
    <h3 class="mb-3">Thêm mới check-in</h3>

    <form method="GET">
        <input type="hidden" name="action" value="admin-create-customer_checkin">
        <label>Chọn chuyến đi:</label>
        <select name="departure_id" class="form-control" onchange="this.form.submit()">
            <option value="">-- Chọn chuyến đi --</option>
            <?php foreach ($listDepartures as $d): ?>
                <option value="<?= $d['departure_id'] ?>"
                    <?= isset($_GET['departure_id']) && $_GET['departure_id'] == $d['departure_id'] ? 'selected' : '' ?>>
                    <?= "Tour #" . $d['tour_id'] . " | " . $d['start_date'] . " - " . $d['end_date'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </form>

    <?php if (!empty($customers)): ?>

        <form action="" method="POST">

            <input type="hidden" name="departure_id" value="<?= $_GET['departure_id'] ?>">

            <label>Khách trong chuyến:</label>
            <select name="customer_id" class="form-control" required>
                <?php foreach ($customers as $c): ?>
                    <option value="<?= $c['customer_id'] ?>">
                        <?= $c['full_name'] ?> (<?= $c['phone'] ?>)
                    </option>
                <?php endforeach; ?>
            </select>

            <label>HDV phụ trách:</label>
            <select name="guide_id" class="form-control" required>
                <?php foreach ($guides as $g): ?>
                    <option value="<?= $g['guide_id'] ?>">
                        <?= $g['full_name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label>Ngày check-in:</label>
            <input type="date" name="checkin_date" class="form-control" required>

            <label>Trạng thái:</label>
            <select name="status" class="form-control">
                <option value="đã đến">Đã đến</option>
                <option value="vắng mặt">Vắng mặt</option>
                <option value="đến trễ">Đến trễ</option>
            </select>

            <label>Ghi chú:</label>
            <textarea name="note" class="form-control"></textarea>

            <button class="btn btn-primary mt-3">Lưu</button>

        </form>

    <?php endif; ?>
</div>