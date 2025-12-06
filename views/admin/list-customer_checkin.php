<style>
    .main-content {
        padding-left: 10px !important;
        margin-left: 0 !important;
    }

    /* ======= SWITCH MODERN ======= */
    .switch {
        position: relative;
        display: inline-block;
        width: 44px;
        height: 24px;
    }

    .switch input {
        display: none;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: #d0d7de;
        transition: .4s;
        border-radius: 24px;
        box-shadow: inset 0 0 4px rgba(0, 0, 0, 0.2);
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 20px;
        width: 20px;
        left: 2px;
        bottom: 2px;
        background: white;
        transition: .4s;
        border-radius: 50%;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    input:checked+.slider {
        background-color: #28a745;
    }

    input:checked+.slider:before {
        transform: translateX(20px);
    }

    /* ======= CARD TOUR ======= */
    .card {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
    }

    .card-header {
        background: #eef4ff !important;
        border-bottom: 1px solid #dce3f0;
        font-size: 15px;
        padding: 12px 16px !important;
    }

    /* ======= TABLE ======= */
    .table-wrapper {
        background: white;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .table thead th {
        background: #f0f3f7;
        font-size: 14px;
        font-weight: 600;
    }

    .table tbody td {
        vertical-align: middle;
    }

    .status-label {
        font-weight: 600;
        white-space: nowrap;
        display: inline-block;
    }
</style>


<div class="container-fluid">
    <div class="row">

        <div class="col-2 p-0">
            <?php include "views/admin/sidebar.php"; ?>
        </div>

        <div class="col-10 main-content">

            <div class="page-header ">
                <h2 class="mb-0">Danh sách Check-in khách</h2>
                <a href="<?= BASE_URL ?>?action=admin-create-customer_checkin"
                    class="btn btn-primary btn-sm">Thêm mới</a>
            </div>

            <div class="table-wrapper mt-3">
                <?php if (!empty($groups)): ?>
                    <?php foreach ($groups as $grp):
                        $dep = $grp['departure'];
                        $customers = $grp['customers'];
                        $schedules = $grp['schedules'];
                        $checkins = $grp['checkins'];
                    ?>
                        <div class="card mb-4">
                            <div class="card-header bg-light" style="margin-bottom: 0; padding-bottom: 0;">
                                <strong>Tour:</strong> <?= htmlspecialchars($dep['tour_name']) ?> | <strong>Khởi hành:</strong> <?= htmlspecialchars($dep['start_date']) ?> - <?= htmlspecialchars($dep['end_date']) ?>
                            </div>
                            <div class="card-body p-0" style="padding-bottom: 2rem;">
                                <?php if (!empty($schedules)): ?>
                                    <?php foreach ($schedules as $sch):
                                        $sid = $sch['schedule_id'];
                                    ?>
                                        <div class="p-3 border-bottom">
                                            <strong>Ngày <?= htmlspecialchars($sch['day_number']) ?>:</strong>
                                            <span class="text-muted"><?= htmlspecialchars($sch['activities']) ?></span>
                                        </div>
                                        <table class="table table-bordered mb-3 mb-0">
                                            <thead>
                                                <tr>
                                                    <th style="width:4%">#</th>
                                                    <th style="width:24%">Khách hàng</th>
                                                    <th style="width:18%">Điện thoại</th>
                                                    <th style="width:18%">Trạng thái</th>
                                                    <th style="width:24%">Ghi chú</th>
                                                    <th style="width:12%">Hành động</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($customers as $i => $c):
                                                    $cid = $c['customer_id'];
                                                    $checkin = $checkins[$sid][$cid] ?? null;
                                                ?>
                                                    <tr>
                                                        <td><?= $i + 1 ?></td>
                                                        <td><?= htmlspecialchars($c['full_name']) ?></td>
                                                        <td><?= htmlspecialchars($c['phone']) ?></td>
                                                        <td>
                                                            <label class="switch">
                                                                <input type="checkbox" class="checkin-switch" data-departure="<?= $dep['departure_id'] ?>" data-customer="<?= $cid ?>" data-schedule="<?= $sid ?>" <?= ($checkin && $checkin['status'] == 'đã đến') ? 'checked' : '' ?> />
                                                                <span class="slider"></span>
                                                            </label>
                                                            <span class="ms-2 status-label">
                                                                <?= $checkin ? htmlspecialchars($checkin['status']) : 'Chưa điểm danh' ?>
                                                            </span>
                                                        </td>
                                                        <td><?= $checkin ? htmlspecialchars($checkin['note']) : '<span class="text-muted">-</span>' ?></td>
                                                        <td>
                                                            <a href="<?= BASE_URL ?>?action=admin-update-customer_checkin&departure_id=<?= $dep['departure_id'] ?>&customer_id=<?= $cid ?>&schedule_id=<?= $sid ?>" class="btn btn-warning btn-sm">Sửa</a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div class="p-3 text-muted">Không có lịch trình cho tour này.</div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="alert alert-warning">Không có chuyến khởi hành nào.</div>
                <?php endif; ?>
            </div>

            <script>
                document.querySelectorAll('.checkin-switch').forEach(function(switchEl) {
                    switchEl.addEventListener('change', function() {
                        var departure_id = this.dataset.departure;
                        var customer_id = this.dataset.customer;
                        var schedule_id = this.dataset.schedule || '';
                        var checked = this.checked;
                        var status = checked ? 'đã đến' : 'vắng mặt';
                        var label = this.closest('td').querySelector('.status-label');
                        label.textContent = checked ? 'Đã đến' : 'Vắng mặt';

                        var fd = new FormData();
                        fd.append('departure_id', departure_id);
                        fd.append('customer_id', customer_id);
                        fd.append('schedule_id', schedule_id);
                        fd.append('guide_id', ''); // controller will auto-assign if empty
                        fd.append('checkin_date', new Date().toISOString().split('T')[0]);
                        fd.append('status', status);
                        fd.append('note', '');

                        fetch(window.location.pathname + '?action=admin-create-customer_checkin', {
                            method: 'POST',
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            body: fd,
                            credentials: 'same-origin'
                        }).then(function(res) {
                            return res.text().then(function(text) {
                                try {
                                    var json = JSON.parse(text);
                                    if (!json.success) throw new Error(json.message || 'Lỗi cập nhật');
                                } catch (e) {
                                    alert('Lỗi: ' + (e.message || text));
                                }
                            });
                        });
                    });
                });
            </script>