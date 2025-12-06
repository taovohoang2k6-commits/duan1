<div class="container mt-4">
    <h3>Gán hướng dẫn viên cho booking #<?= $booking['booking_id'] ?></h3>

    <div class="card p-3">
        <form method="post">
            <label class="mb-2"><strong>Chọn hướng dẫn viên:</strong></label>

            <select name="guide_id" class="form-control" required>
                <?php foreach ($listGuides as $g): ?>
                    <option 
                        value="<?= $g['guide_id'] ?>"
                        <?= $booking['guide_id'] == $g['guide_id'] ? "selected" : "" ?>
                    >
                        <?= $g['full_name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button class="btn btn-primary mt-3">Lưu</button>
            <a href="<?= BASE_URL ?>?action=admin-list-bookings" class="btn btn-secondary mt-3">
                Quay lại
            </a>
        </form>
    </div>
</div>
