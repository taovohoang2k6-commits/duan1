<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="d-flex">
        <div class="col-2 p-0">
            <?php include "views/admin/sidebar.php"; ?>
        </div>
        <div class="col-10">
        
        <div class="container-fluid py-4">
    <h2 class="mb-4 fw-bold">Dashboard Tổng Quan</h2>

    <div class="row g-4">
        <div class="col-md-3">
            <div class="card shadow-sm border-0 p-3">
                <h5>Tổng số tour</h5>
                <h3 class="fw-bold text-primary">128</h3>
                <p class="text-muted small">+12% tháng này</p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 p-3">
                <h5>Khách đã đặt</h5>
                <h3 class="fw-bold text-success">542</h3>
                <p class="text-muted small">+9% so với tháng trước</p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 p-3">
                <h5>Doanh thu</h5>
                <h3 class="fw-bold text-warning">89.5M</h3>
                <p class="text-muted small">Tăng mạnh</p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 p-3">
                <h5>HDV đang hoạt động</h5>
                <h3 class="fw-bold text-info">24</h3>
                <p class="text-muted small">Đang dẫn tour</p>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-8">
            <div class="card shadow-sm p-3 border-0">
                <h5 class="mb-3">Doanh thu 6 tháng gần nhất</h5>
                <canvas id="revenueChart"></canvas>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm p-3 border-0">
                <h5 class="mb-3">Tỷ lệ đặt tour</h5>
                <canvas id="bookingRateChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx1 = document.getElementById('revenueChart');
new Chart(ctx1, {
    type: 'line',
    data: {
        labels: ['T1', 'T2', 'T3', 'T4', 'T5', 'T6'],
        datasets: [{ label: 'Doanh thu (triệu)', data: [12, 19, 15, 22, 28, 35], borderWidth: 3, tension: 0.4 }]
    }
});

const ctx2 = document.getElementById('bookingRateChart');
new Chart(ctx2, {
    type: 'doughnut',
    data: {
        labels: ['Đặt thành công', 'Hủy', 'Đang xử lý'],
        datasets: [{ data: [70, 10, 20], borderWidth: 1 }]
    }
});
</script>

</body>
</html>
