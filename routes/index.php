<?php

$action = $_GET['action'] ?? '/';

match ($action) {
    '/'         => (new HomeController)->index(),
    'login'         => (new HomeController)->login(),
    'register'         => (new HomeController)->register(),
    'logout'         => (new HomeController)->logout(),

    //admin
    'admin-sidebar' => (new AdminController)->sidebar(),
    'admin-dashboard'         => (new DashboardController)->index(),
    // ql nhân sự
    'admin-list-guides'           => (new GuidesController)->index(),
    'admin-create-guides'         => (new GuidesController)->create(),
    'admin-update-guides'         => (new GuidesController)->update(),
    'admin-delete-guides'         => (new GuidesController)->delete(),

    //nhân sự
    'admin-list-users'         => (new UserController)->index(),
    'admin-create-users'         => (new UserController)->create(),
    'admin-update-users'         => (new UserController)->update(),
    'admin-delete-users'         => (new UserController)->delete(),


    //ql danh mục
    'admin-list-Tourcategory'         => (new TourcategoryController)->index(),
    'admin-create-Tourcategory'         => (new TourcategoryController)->create(),
    'admin-update-Tourcategory'         => (new TourcategoryController)->update(),
    'admin-delete-Tourcategory'         => (new TourcategoryController)->delete(),
    //ql tour
    'admin-list-tour'         => (new TourController)->index(),
    'admin-create-tour'         => (new TourController)->create(),
    'admin-update-tour'         => (new TourController)->update(),
    'admin-delete-tour'         => (new TourController)->delete(),


    'admin-add-schedule'         => (new TourController)->addSchedule(),
    //giá
    'admin-list-prices'         => (new PricesController)->index(),
    'admin-create-prices'         => (new PricesController)->create(),
    'admin-update-prices'         => (new PricesController)->update(),
    'admin-delete-prices'         => (new PricesController)->delete(),
    //lịch trình
    'admin-list-schedules'         => (new SchedulesController)->index(),
    'admin-create-schedules'         => (new SchedulesController)->create(),
    'admin-update-schedules'         => (new SchedulesController)->update(),
    'admin-delete-schedules'         => (new SchedulesController)->delete(),
    //chuyến khởi hành 
    'admin-list-departures'         => (new DeparturesController)->index(),
    'admin-create-departures'         => (new DeparturesController)->create(),
    'admin-update-departures'         => (new DeparturesController)->update(),
    'admin-delete-departures'         => (new DeparturesController)->delete(),
    //phân công hướng dẫn viên / nhà cung cấp
    'admin-list-assignments'         => (new AssignmentsController)->index(),
    'admin-create-assignments'         => (new AssignmentsController)->create(),
    'admin-update-assignments'         => (new AssignmentsController)->update(),
    'admin-delete-assignments'         => (new AssignmentsController)->delete(),
    //ql nhà cung cấp
    'admin-list-providers'         => (new ProvidersController)->index(),
    'admin-create-providers'         => (new ProvidersController)->create(),
    'admin-update-providers'         => (new ProvidersController)->update(),
    'admin-delete-providers'         => (new ProvidersController)->delete(),
    //ql đặt tour
    'admin-list-bookings'         => (new BookingController)->index(),
    'admin-create-bookings'         => (new BookingController)->create(),
    'admin-update-bookings'         => (new BookingController)->update(),

    //'admin-delete-bookings'         => (new BookingController)->delete(),
    'assign-guide' => (new BookingController)->assignGuide(),
    'assign-customer' => (new BookingController)->assignCustomer(),
    //lịch sử thay đổi đặt tour
    'admin-list-booking_history'         => (new HistoryController)->index(),
    'admin-create-booking_history'         => (new HistoryController)->create(),
    'admin-update-booking_history'         => (new HistoryController)->update(),
    'admin-delete-booking_history'         => (new HistoryController)->delete(),
    //khách hàng
    'admin-list-customers'         => (new CustomersController)->index(),
    'admin-create-customers'         => (new CustomersController)->create(),
    'admin-update-customers'         => (new CustomersController)->update(),
    'admin-delete-customers'         => (new CustomersController)->delete(),
    //yêu cầu đặc biệt
    'admin-list-special_requests'         => (new SpecialRequestsController)->index(),
    'admin-create-special_requests'         => (new SpecialRequestsController)->create(),
    'admin-update-special_requests'         => (new SpecialRequestsController)->update(),
    'admin-delete-special_requests'         => (new SpecialRequestsController)->delete(),
    //tài chính
    'admin-list-tour_finance'   => (new TourFinanceController)->index(),
    'admin-create-tour_finance' => (new TourFinanceController)->create(),
    'admin-update-tour_finance' => (new TourFinanceController)->update(),
    'admin-delete-tour_finance' => (new TourFinanceController)->delete(),
    // nhật ký
    'admin-list-tour_logs'   => (new TourLogsController)->index(),
    'admin-create-tour_logs' => (new TourLogsController)->create(),
    //'admin-update-tour_logs' => (new TourLogsController)->update(),
    //'admin-delete-tour_logs' => (new TourLogsController)->delete(),   

    //tour phân công
    'admin-list-guide_tours'   => (new GuideToursController)->index(),
    'admin-detail-guide_tours' => (new GuideToursController)->detail(),
    // alias used in sidebar / guide area
    'admin-guide_tours'        => (new GuideToursController)->index(),


    //checkin
    'admin-list-customer_checkin'   => (new CustomerCheckinController)->index(),
    'admin-create-customer_checkin' => (new CustomerCheckinController)->create(),
    'admin-update-customer_checkin' => (new CustomerCheckinController)->update(),
    'admin-delete-customer_checkin' => (new CustomerCheckinController)->delete(),
};
