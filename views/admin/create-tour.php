<div class="container">
    <div class="row">
        <div class="col-3">
            <?php include "views/admin/sidebar.php"; ?>
        </div>

        <div class="col-9">
            <form action="<?= BASE_URL ?>?action=admin-create-tour" method="POST" enctype="multipart/form-data">

                <h3>Thêm tour</h3>

                <div class="mb-3">
                    <label>Danh mục tour</label>
                    <select name="category_id" class="form-control">
                        <?php foreach ($listCategories as $value): ?>
                            <option value="<?= $value['category_id'] ?>">
                                <?= $value['name'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Tên tour</label>
                    <input type="text" class="form-control" name="name" required>
                </div>

                <div class="mb-3">
                    <label>Description</label>
                    <textarea class="form-control" name="description" rows="3"></textarea>
                </div>

                <div class="mb-3">
                    <label>Policy</label>
                    <textarea class="form-control" name="policy" rows="3"></textarea>
                </div>

                <div class="mb-3">
                    <label>Nhà cung cấp</label>
                    <select name="provider_id" class="form-control">
                        <?php foreach ($listProviders as $value): ?>
                            <option value="<?= $value['provider_id'] ?>">
                                <?= $value['name'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <!-- ========================= Giá ========================= -->
                <h5 class="mt-4">Giá tour</h5>

                <div id="price-list">
                    <?php if (!empty($prices)): ?>
                        <?php foreach ($prices as $i => $p): ?>
                            <div class="price-item border p-3 mt-2">
                                <label>Loại giá:</label>
                                <input type="text" class="form-control" name="prices[<?= $i ?>][target_group]" value="<?= $p['target_group'] ?>" required>

                                <label class="mt-2">Giá tiền:</label>
                                <input type="number" class="form-control" name="prices[<?= $i ?>][price]" value="<?= $p['price'] ?>" required>

                             <label>Ngày bắt đầu áp dụng:</label>
                                <input type="date" class="form-control" name="prices[<?= $i ?>][valid_from]" value="<?= $p['valid_from'] ?>" required>

                                <label class="mt-2">Ngày kết thúc áp dụng:</label>
                                <input type="date" class="form-control" name="prices[<?= $i ?>][valid_to]" value="<?= $p['valid_to'] ?>" required>

                                <button type="button" class="btn btn-danger btn-sm mt-2 remove-price">Xóa</button>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <button type="button" id="add-price" class="btn btn-secondary btn-sm mt-3">+ Thêm giá</button>
                <script>
                    let priceIndex = <?= !empty($prices) ? count($prices) : 0 ?>;

                    document.getElementById('add-price').addEventListener('click', function() {
                        let html = `
        <div class="price-item border p-3 mt-2">
            <label>Loại giá:</label>
            <input type="text" class="form-control" name="prices[\${priceIndex}][target_group]" required>

            <label class="mt-2">Giá tiền:</label>
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

                    document.addEventListener('click', function(e) {
                        if (e.target.classList.contains('remove-price')) {
                            e.target.parentElement.remove();
                        }
                    });
                </script>


                <div class="mb-3">
                    <label>Trạng thái tour</label>
                    <select name="status" class="form-control">
                        <option value="active">Hoạt động</option>
                        <option value="inactive">Không hoạt động</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Hình ảnh tour</label>
                    <input type="file" class="form-control" name="images">
                </div>


           
                <h4 class="mt-4">Lịch trình Tour</h4>

                <div id="schedule-container"></div>

                <button type="button" class="btn btn-secondary btn-sm mt-2" onclick="addSchedule()">
                    + Thêm lịch trình
                </button>

                <script>
                    let scheduleIndex = 0;

                    function addSchedule() {

                        const box = `
            <div class="border rounded p-3 mt-3 bg-light" id="schedule-${scheduleIndex}">
                
                <div class="mb-2">
                    <label>Ngày</label>
                    <input type="number" name="schedules[${scheduleIndex}][day_number]"
                           class="form-control" required>
                </div>

                <!-- nơi chứa các hoạt động -->
                <div class="activities-container" id="activities-${scheduleIndex}"></div>

                <button type="button" class="btn btn-success btn-sm mt-2"
                        onclick="addActivity(${scheduleIndex})">
                    + Thêm Hoạt động
                </button>

                <button type="button" class="btn btn-danger btn-sm mt-2"
                        onclick="document.getElementById('schedule-${scheduleIndex}').remove()">
                    Xóa Ngày
                </button>

            </div>
        `;

                        document.getElementById("schedule-container").insertAdjacentHTML("beforeend", box);

                        scheduleIndex++;
                    }


                    // ============================================
                    // Thêm 1 hoạt động trong 1 ngày
                    // ============================================
                    function addActivity(scheduleId) {

                        const container = document.getElementById(`activities-${scheduleId}`);

                        const activityIndex = container.children.length;

                        const activityBox = `
            <div class="border p-2 mt-2 bg-white rounded">

                <div class="mb-2">
                    <label>Hoạt động</label>
                    <textarea name="schedules[${scheduleId}][activities][${activityIndex}][activity]" 
                              class="form-control" required></textarea>
                </div>

                <div class="mb-2">
                    <label>Địa điểm</label>
                    <input type="text" name="schedules[${scheduleId}][activities][${activityIndex}][location]" 
                           class="form-control" required>
                </div>

                <div class="mb-2">
                    <label>Bắt đầu</label>
                    <input type="time" name="schedules[${scheduleId}][activities][${activityIndex}][start_time]"
                           class="form-control" required>
                </div>

                <div class="mb-2">
                    <label>Kết thúc</label>
                    <input type="time" name="schedules[${scheduleId}][activities][${activityIndex}][end_time]"
                           class="form-control" required>
                </div>

                <button type="button" class="btn btn-danger btn-sm"
                        onclick="this.parentElement.remove()">
                    Xóa hoạt động
                </button>

            </div>
        `;

                        container.insertAdjacentHTML("beforeend", activityBox);
                    }
                </script>
      


                <div class="mb-3 mt-4">
                    <button type="submit" class="btn btn-primary btn-sm">Thêm mới</button>
                </div>

            </form>
        </div>
    </div>
</div>