<div class="container">
    <div class="row">
        <div class="col-3">
            <?php include "views/admin/sidebar.php"; ?>
        </div>

        <div class="col-9">
            <h4 class="mb-3">Cập nhật tour</h4>

            <form action="<?= BASE_URL ?>?action=admin-update-tour" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="tour_id" value="<?= $tour['tour_id'] ?>">

                <!-- Thông tin tour -->
                <div class="mb-3">
                    <label>Danh mục tour</label>
                    <select name="category_id" class="form-control">
                        <?php foreach ($listCategories as $value): ?>
                            <option value="<?= $value['category_id'] ?>" <?= $value['category_id'] == $tour['category_id'] ? 'selected' : '' ?>>
                                <?= $value['name'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Tên tour</label>
                    <input type="text" class="form-control" name="name" value="<?= $tour['name'] ?>" required>
                </div>

                <div class="mb-3">
                    <label>Mô tả</label>
                    <textarea class="form-control" name="description" rows="3"><?= $tour['description'] ?></textarea>
                </div>

                <div class="mb-3">
                    <label>Chính sách</label>
                    <textarea class="form-control" name="policy" rows="3"><?= $tour['policy'] ?></textarea>
                </div>

                <div class="mb-3">
                    <label>Nhà cung cấp</label>
                    <select name="provider_id" class="form-control">
                        <?php foreach ($listProviders as $value): ?>
                            <option value="<?= $value['provider_id'] ?>" <?= $value['provider_id'] == $tour['provider_id'] ? 'selected' : '' ?>>
                                <?= $value['name'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Trạng thái tour</label>
                    <select name="status" class="form-control">
                        <option value="active" <?= $tour['status'] == 'active' ? 'selected' : '' ?>>Hoạt động</option>
                        <option value="inactive" <?= $tour['status'] == 'inactive' ? 'selected' : '' ?>>Không hoạt động</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Hình ảnh tour</label>
                    <input type="file" class="form-control" name="images">
                    <?php if (!empty($tour['images'])): ?>
                        <img src="<?= BASE_URL . $tour['images'] ?>" width="150" class="mt-2 border rounded">
                    <?php endif; ?>
                </div>

               
                <h5 class="mt-4">Giá tour</h5>
                <div id="price-list">
                    <?php if(!empty($prices)): ?>
                        <?php foreach ($prices as $i => $price): ?>
                            <div class="price-item border p-3 mt-2">
                                <label>Đối tượng</label>
                                <input type="text" class="form-control" name="prices[<?= $i ?>][target_group]" value="<?= $price['target_group'] ?>" required>

                                <label class="mt-2">Giá</label>
                                <input type="number" class="form-control" name="prices[<?= $i ?>][price]" value="<?= $price['price'] ?>" required>

                                <label>Ngày bắt đầu áp dụng:</label>
                                <input type="date" class="form-control" name="prices[<?= $i ?>][valid_from]" value="<?= $price['valid_from'] ?>" required>

                                <label class="mt-2">Ngày kết thúc áp dụng:</label>
                                <input type="date" class="form-control" name="prices[<?= $i ?>][valid_to]" value="<?= $price['valid_to'] ?>" required>

                                <button type="button" class="btn btn-danger btn-sm mt-2 remove-price">Xóa</button>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <button type="button" id="add-price" class="btn btn-secondary btn-sm mt-2">+ Thêm giá</button>

                
                <h5 class="mt-4">Lịch trình tour</h5>
                <div id="schedule-list">
                    <?php if(!empty($schedules)): ?>
                        <?php foreach ($schedules as $i => $sc): ?>
                            <div class="schedule-item border p-3 mt-2">
                                <label>Ngày số</label>
                                <input type="number" class="form-control" name="schedules[<?= $i ?>][day_number]" value="<?= $sc['day_number'] ?>" required>

                                <label class="mt-2">Hoạt động</label>
                                <textarea class="form-control" name="schedules[<?= $i ?>][activities]" required><?= $sc['activities'] ?></textarea>

                                <label class="mt-2">Địa điểm</label>
                                <input type="text" class="form-control" name="schedules[<?= $i ?>][location]" value="<?= $sc['location'] ?>" required>

                                <label class="mt-2">Bắt đầu</label>
                                <input type="time" class="form-control" name="schedules[<?= $i ?>][start_time]" value="<?= $sc['start_time'] ?>" required>

                                <label class="mt-2">Kết thúc</label>
                                <input type="time" class="form-control" name="schedules[<?= $i ?>][end_time]" value="<?= $sc['end_time'] ?>" required>

                                <button type="button" class="btn btn-danger btn-sm mt-2 remove-schedule">Xóa</button>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <button type="button" id="add-schedule" class="btn btn-secondary btn-sm mt-2">+ Thêm lịch trình</button>

                <br><br>
                <button type="submit" class="btn btn-primary btn-sm">Cập nhật</button>
            </form>
        </div>
    </div>
</div>

<script>
let scheduleIndex = <?= !empty($schedules) ? count($schedules) : 0 ?>;
let priceIndex = <?= !empty($prices) ? count($prices) : 0 ?>;


document.getElementById('add-schedule').addEventListener('click', function () {
    let html = `
        <div class="schedule-item border p-3 mt-2">
            <label>Ngày số</label>
            <input type="number" class="form-control" name="schedules[\${scheduleIndex}][day_number]" required>

            <label class="mt-2">Hoạt động</label>
            <textarea class="form-control" name="schedules[\${scheduleIndex}][activities]" required></textarea>

            <label class="mt-2">Địa điểm</label>
            <input type="text" class="form-control" name="schedules[\${scheduleIndex}][location]" required>

            <label class="mt-2">Bắt đầu</label>
            <input type="time" class="form-control" name="schedules[\${scheduleIndex}][start_time]" required>

            <label class="mt-2">Kết thúc</label>
            <input type="time" class="form-control" name="schedules[\${scheduleIndex}][end_time]" required>

            <button type="button" class="btn btn-danger btn-sm mt-2 remove-schedule">Xóa</button>
        </div>
    `;
    document.getElementById('schedule-list').insertAdjacentHTML('beforeend', html);
    scheduleIndex++;
});


document.getElementById('add-price').addEventListener('click', function () {
    let html = `
        <div class="price-item border p-3 mt-2">
            <label>Đối tượng</label>
            <input type="text" class="form-control" name="prices[\${priceIndex}][target_group]" required>

            <label class="mt-2">Giá</label>
            <input type="number" class="form-control" name="prices[\${priceIndex}][price]" required>

            <label>Ngày bắt đầu áp dụng:</label>
            <input type="date" class="form-control" name="prices[\${priceIndex}][valid_from]" required>

            <label class="mt-2">Ngày kết thúc áp dụng:</label>
            <input type="date" class="form-control" name="prices[\${priceIndex}][valid_to]" required>


            <button type="button" class="btn btn-danger btn-sm mt-2 remove-price">Xóa</button>
        </div>
    `;
    document.getElementById('price-list').insertAdjacentHTML('beforeend', html);
    priceIndex++;
});

// Xóa lịch trình / giá
document.addEventListener('click', function (e) {
    if (e.target.classList.contains('remove-schedule') || e.target.classList.contains('remove-price')) {
        e.target.parentElement.remove();
    }
});
</script>
