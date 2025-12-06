<?php

$currentAction = $_GET['action'] ?? 'admin-dashboard';
?>

<style>
    .sidebar {
        background: #1e1f26;
        width: 260px;
        height: 100vh;
        padding: 20px;
        overflow-y: auto;
        scrollbar-width: none;
        -ms-overflow-style: none;
        border-right: 1px solid rgba(255, 255, 255, 0.08);
        box-shadow: 2px 0 15px rgba(0, 0, 0, 0.2);
    }

    .sidebar::-webkit-scrollbar {
        display: none;
    }

    .sidebar .nav-link {
        color: #cfd2da;
        padding: 10px 15px;
        margin-bottom: 6px;
        font-size: 15px;
        border-radius: 8px;
        transition: all 0.25s ease-in-out;
        display: flex;
        align-items: center;
    }

    .sidebar .nav-link i {
        font-size: 18px;
    }

    .sidebar .nav-link:hover {
        background: rgba(255, 255, 255, 0.12);
        color: #fff;
        transform: translateX(4px);
    }

    .sidebar .nav-link.active {
        background: #0d6efd;
        color: #fff !important;
        box-shadow: 0 2px 6px rgba(13, 110, 253, 0.5);
    }


    .sidebar .dropdown-toggle img {
        border: 2px solid #fff;
    }
</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="sidebar d-flex flex-column text-white position-fixed top-0 start-0">
    <a href="<?= BASE_URL ?>?action=admin-dashboard" class="d-flex align-items-center mb-3 text-white text-decoration-none">
        <i class="bi bi-speedometer2 fs-4 me-2"></i>
        <span class="fs-5 fw-bold">Admin Panel</span>
    </a>

    <hr>

    <ul class="nav nav-pills flex-column mb-auto">
        <li><a href="<?= BASE_URL ?>?action=admin-dashboard" class="nav-link <?= $currentAction == 'admin-dashboard' ? 'active' : '' ?>"><i class="bi bi-house-door me-2"></i> Dashboard</a></li>
        <li><a href="<?= BASE_URL ?>?action=admin-list-Tourcategory" class="nav-link <?= $currentAction == 'admin-list-Tourcategory' ? 'active' : '' ?>"><i class="bi bi-tags me-2"></i> Danh mục tour</a></li>
        <li><a href="<?= BASE_URL ?>?action=admin-list-providers" class="nav-link <?= $currentAction == 'admin-list-providers' ? 'active' : '' ?>"><i class="bi bi-building me-2"></i> Nhà cung cấp</a></li>
        <li><a href="<?= BASE_URL ?>?action=admin-list-tour" class="nav-link <?= $currentAction == 'admin-list-tour' ? 'active' : '' ?>"><i class="bi bi-box-seam me-2"></i> Quản lý tour</a></li>
        <li><a href="<?= BASE_URL ?>?action=admin-list-prices" class="nav-link <?= $currentAction == 'admin-list-prices' ? 'active' : '' ?>"><i class="bi bi-currency-dollar me-2"></i> Giá tour</a></li>
        <li><a href="<?= BASE_URL ?>?action=admin-list-schedules" class="nav-link <?= $currentAction == 'admin-list-schedules' ? 'active' : '' ?>"><i class="bi bi-calendar3 me-2"></i> Lịch trình tour</a></li>


        <li><a href="<?= BASE_URL ?>?action=admin-list-bookings" class="nav-link <?= $currentAction == 'admin-list-bookings' ? 'active' : '' ?>"><i class="bi bi-cart-check me-2"></i> Đặt tour</a></li>
        <li><a href="<?= BASE_URL ?>?action=admin-guide_tours" class="nav-link <?= $currentAction == 'admin-guide_tours' ? 'active' : '' ?>"><i class="bi bi-card-checklist me-2"></i> Tour được phân công</a></li>
        <li><a href="<?= BASE_URL ?>?action=admin-list-booking_history" class="nav-link <?= $currentAction == 'admin-list-booking_history' ? 'active' : '' ?>"><i class="bi bi-clock-history me-2"></i> Lịch sử đặt tour</a></li>

        <li><a href="<?= BASE_URL ?>?action=admin-list-tour_finance" class="nav-link <?= $currentAction == 'admin-list-tour_finance' ? 'active' : '' ?>"><i class="bi bi-wallet2 me-2"></i> Tài chính tour</a></li>
        <li><a href="<?= BASE_URL ?>?action=admin-list-guides" class="nav-link <?= $currentAction == 'admin-list-guides' ? 'active' : '' ?>"><i class="bi bi-people-fill me-2"></i> Nhân sự</a></li>
        <li><a href="<?= BASE_URL ?>?action=admin-list-assignments" class="nav-link <?= $currentAction == 'admin-list-assignments' ? 'active' : '' ?>"><i class="bi bi-person-badge me-2"></i> Phân công HDV/NCC</a></li>
        <li><a href="<?= BASE_URL ?>?action=admin-list-departures" class="nav-link <?= $currentAction == 'admin-list-departures' ? 'active' : '' ?>"><i class="bi bi-geo-alt-fill me-2"></i> Chuyến khởi hành</a></li>
        <li>
            <a href="<?= BASE_URL ?>?action=admin-list-tour_logs"
                class="nav-link <?= $currentAction == 'admin-list-tour_logs' ? 'active' : '' ?>">
                <i class="bi bi-journal-text me-2"></i> Nhật ký tour
            </a>
        </li>
        <li><a href="<?= BASE_URL ?>?action=admin-list-customers" class="nav-link <?= $currentAction == 'admin-list-customers' ? 'active' : '' ?>"><i class="bi bi-person-lines-fill me-2"></i> Khách hàng</a></li>
        <li><a href="<?= BASE_URL ?>?action=admin-list-special_requests" class="nav-link <?= $currentAction == 'admin-list-special_requests' ? 'active' : '' ?>"><i class="bi bi-exclamation-circle me-2"></i> Yêu cầu đặc biệt</a></li>
        <li>
            <a href="<?= BASE_URL ?>?action=admin-list-customer_checkin"
                class="nav-link <?= $currentAction == 'admin-list-customer_checkin' ? 'active' : '' ?>">
                <i class="bi bi-check2-circle me-2"></i> Điểm danh khách
            </a>
        </li>

    </ul>

    <hr>

    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
            <img src="https://via.placeholder.com/40" class="rounded-circle me-2">
            <strong>Admin</strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
            <li><a class="dropdown-item" href="#">Thông tin cá nhân</a></li>
            <li><a class="dropdown-item" href="#">Cài đặt</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="<?= BASE_URL ?>?action=logout">Đăng xuất</a></li>
        </ul>
    </div>
</div>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>