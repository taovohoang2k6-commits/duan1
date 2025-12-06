<div class="container mt-4">
    <h3>Khách hàng thuộc booking #<?= $booking['booking_id'] ?></h3>

    <a href="<?= BASE_URL ?>?action=admin-list-bookings" class="btn btn-secondary mb-3">
        Quay lại
    </a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên khách</th>
                <th>SĐT</th>
           
            </tr>
        </thead>

        <tbody>
            <?php if (!empty($customerList)): ?>
                <?php foreach ($customerList as $k => $c): ?>
                    <tr>
                        <td><?= $k + 1 ?></td>
                        <td><?= htmlspecialchars($c['full_name']) ?></td>
                        <td><?= htmlspecialchars($c['phone']) ?></td>
                        
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center text-muted">Không có khách nào thuộc booking này</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
