<div class="container">
   <div class="row">
    <div class="col-3">
        <?php include "views/admin/sidebar.php"; ?>
    </div>

    <div class="col-9">
        <h3>Thêm phân công</h3>

        <form action="<?= BASE_URL ?>?action=admin-create-assignments" method="POST">

            <div class="mb-3">
                <label>Chuyến đi</label>
                <select name="departure_id" class="form-control">
                    <?php foreach ($listDeparture as $value): ?>
                        <option value="<?= $value['departure_id'] ?>">
                            <?= $value['departure_name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label>HDV được phân công</label>
                <select name="guide_id" class="form-control">
                    <?php foreach ($listGuide as $value): ?>
                        <option value="<?= $value['guide_id'] ?>">
                            <?= $value['full_name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label>Dịch vụ liên quan</label>
                <select name="provider_id" class="form-control">
                    <?php foreach ($listProvider as $value): ?>
                        <option value="<?= $value['provider_id'] ?>">
                            <?= $value['name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label>Vai trò</label>
                <input type="text" class="form-control" name="role">
            </div>

            <button class="btn btn-primary btn-sm">Thêm mới</button>
        </form>
    </div>
   </div>
</div>
