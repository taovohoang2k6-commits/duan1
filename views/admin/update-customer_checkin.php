<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-lg-7">
      <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
          <h4 class="mb-0">Cập nhật điểm danh khách hàng</h4>
        </div>
        <div class="card-body">
          <form action="<?= BASE_URL ?>?action=admin-update-customer_checkin" method="POST">
            <input type="hidden" name="checkin_id" value="<?= $one['checkin_id'] ?>">

            <div class="mb-3">
              <label class="form-label">Chuyến khởi hành</label>
              <select name="departure_id" id="departureSelect" class="form-select">
                <option value="">-- Chọn chuyến đi --</option>
                <?php foreach ($listDepartures as $item): ?>
                  <option value="<?= $item['departure_id'] ?>" <?= $item['departure_id'] == $one['departure_id'] ? 'selected' : '' ?>>
                    <?= $item['departure_name'] ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="mb-3">
              <label class="form-label">Khách hàng</label>
              <select name="customer_id" id="customerSelect" class="form-select">
                <?php foreach ($listCustomers as $c): ?>
                  <option value="<?= $c['customer_id'] ?>" <?= $c['customer_id'] == $one['customer_id'] ? 'selected' : '' ?>>
                    <?= $c['full_name'] ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="mb-3">
              <label class="form-label">Hướng dẫn viên</label>
              <select name="guide_id" id="guideSelect" class="form-select">
                <?php foreach ($listGuides as $g): ?>
                  <option value="<?= $g['guide_id'] ?>" <?= $g['guide_id'] == $one['guide_id'] ? 'selected' : '' ?>>
                    <?= $g['full_name'] ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="mb-3">
              <label class="form-label">Lịch trình (Ngày)</label>
              <select name="schedule_id" id="scheduleSelect" class="form-select">
                <option value="">-- Chọn lịch trình --</option>
                <?php foreach ($listSchedules as $s): ?>
                  <option value="<?= $s['schedule_id'] ?>" <?= (isset($one['schedule_id']) && $one['schedule_id'] == $s['schedule_id']) ? 'selected' : '' ?>>
                    Ngày <?= $s['day_number'] ?> - <?= htmlspecialchars($s['activities']) ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="mb-3">
              <label class="form-label">Ngày check-in</label>
              <input type="date" name="checkin_date" class="form-control" value="<?= $one['checkin_date'] ?>">
            </div>

            <div class="mb-3">
              <label class="form-label">Trạng thái</label><br>
              <label class="switch">
                <input type="checkbox" name="status" value="đã đến" <?= ($one['status'] == 'đã đến') ? 'checked' : '' ?>>
                <span class="slider"></span>
              </label>
              <span class="ms-2">Đã đến</span>
              <span class="ms-2 text-muted">(Bỏ chọn: Vắng mặt)</span>
            </div>

            <div class="mb-3">
              <label class="form-label">Ghi chú</label>
              <textarea name="note" class="form-control" rows="2"><?= $one['note'] ?></textarea>
            </div>

            <button class="btn btn-primary w-100">Cập nhật</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.getElementById('departureSelect').addEventListener('change', function() {
    let departureId = this.value;
    fetch('api.php?action=get_data_by_departure&id=' + departureId)
      .then(res => res.json())
      .then(data => {
        let customerSelect = document.getElementById('customerSelect');
        customerSelect.innerHTML = "";
        data.customers.forEach(c => {
          customerSelect.innerHTML += `<option value="${c.customer_id}">${c.full_name}</option>`;
        });
        let guideSelect = document.getElementById('guideSelect');
        guideSelect.innerHTML = "";
        data.guides.forEach(g => {
          guideSelect.innerHTML += `<option value="${g.guide_id}">${g.full_name}</option>`;
        });
      });
  });
</script>

<style>
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
</style>