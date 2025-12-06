<div class="container py-4">
    <div class="row">

        <!-- SIDEBAR -->
        <div class="col-3">
            <?php include "views/admin/sidebar.php"; ?>
        </div>

        <!-- NỘI DUNG -->
        <div class="col-9">
            <h3>Chi tiết Tour được phân công</h3>

            <?php if (empty($tourDetail)): ?>
                <div class="alert alert-warning">
                    Không tìm thấy thông tin chi tiết tour.
                </div>
            <?php else: ?>
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-light">
                        <h5 class="card-title mb-0"><?= htmlspecialchars($tourDetail['tour_name'] ?? '') ?></h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="fw-bold">Ngày khởi hành:</label>
                                <p><?= htmlspecialchars($tourDetail['start_date'] ?? 'N/A') ?></p>
                            </div>
                            <div class="col-md-6">
                                <label class="fw-bold">Ngày kết thúc:</label>
                                <p><?= htmlspecialchars($tourDetail['end_date'] ?? 'N/A') ?></p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="fw-bold">Hướng dẫn viên:</label>
                                <p><?= htmlspecialchars($tourDetail['guide_name'] ?? 'N/A') ?></p>
                            </div>
                            <div class="col-md-6">
                                <label class="fw-bold">Nhà cung cấp:</label>
                                <p><?= htmlspecialchars($tourDetail['provider_name'] ?? 'N/A') ?></p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="fw-bold">Địa điểm gặp mặt:</label>
                                <p><?= htmlspecialchars($tourDetail['meeting_point'] ?? '') ?></p>
                            </div>
                        </div>

                        <?php if (!empty($tourDetail['role'])): ?>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="fw-bold">Vai trò:</label>
                                    <p><?= htmlspecialchars($tourDetail['role']) ?></p>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <a href="<?= BASE_URL ?>?action=admin-list-customer_checkin&departure_id=<?= $tourDetail['departure_id'] ?>"
                                    class="btn btn-primary">Điểm danh khách hàng</a>

                                <a href="<?= BASE_URL ?>?action=admin-guide_tours"
                                    class="btn btn-outline-secondary">Quay lại</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>

<style>
    .card-header {
        border-bottom: 2px solid #dee2e6;
    }

    .card-body label {
        font-size: 0.95rem;
        color: #495057;
    }

    .card-body p {
        color: #212529;
        margin-bottom: 0;
    }
</style>