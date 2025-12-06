<div class="container">
    <div class="row">

        <div class="col-3">
            <?php include "views/admin/sidebar.php"; ?>
        </div>

        <div class="col-9">

            <h3 class="mb-3">Thêm nhật ký tour</h3>

            <form action="<?= BASE_URL ?>?action=admin-create-tour_logs" method="POST">

          
                <div class="mb-3">
                    <label class="form-label">Chuyến đi</label>
                    <select name="departure_id" class="form-control" required>
                        <?php foreach ($listDepartures as $value): ?>
                            <option value="<?= $value['departure_id'] ?>">
                                <?= $value['departure_id'] ?> - 
                                Tour: <?= htmlspecialchars($value['tour_name']) ?> 
                                (<?= $value['start_date'] ?> → <?= $value['end_date'] ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

        
                <div class="mb-3">
                    <label class="form-label">Hướng dẫn viên</label>
                    <select name="guide_id" class="form-control" required>
                        <?php foreach ($listGuides as $value): ?>
                            <option value="<?= $value['guide_id'] ?>">
                                <?= htmlspecialchars($value['full_name']) ?> 
                                (<?= $value['language'] ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Ngày ghi nhật ký</label>
                    <input type="date" name="date" class="form-control" required>
                </div>

     
                <div class="mb-3">
                    <label class="form-label">Nội dung nhật ký</label>
                    <textarea name="note" class="form-control" rows="4" placeholder="Nhập ghi chú trong ngày..." required></textarea>
                </div>


                <div class="mb-3">
                    <label class="form-label">Sự cố / phản hồi</label>
                    <textarea name="issues" class="form-control" rows="4" placeholder="Mô tả sự cố, phản hồi hoặc vấn đề..."></textarea>
                </div>

                <button type="submit" class="btn btn-primary btn-sm">Thêm mới</button>

            </form>

        </div>
    </div>
</div>
