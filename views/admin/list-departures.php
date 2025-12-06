<div class="container">
   <div class="row">
      <div class="col-3">
         <?php include "views/admin/sidebar.php"; ?>
      </div>
      <div class="col-9">
         <a href="<?= BASE_URL ?>?action=admin-create-departures" class="btn btn-primary btn-sm">Thêm mới</a>
         <table class="table">
            <thead>
               <tr>
                  <th>STT</th>
                  <th>Tour</th>
                  <th>Ngày bắt đầu</th>
                  <th>Ngày kết thúc</th>
                  <th>Điểm tập trung</th>
                  <th>Hành động</th>
               </tr>
            </thead>
            <tbody>
            <?php if (!empty($listData) && is_array($listData)): ?>
                <?php foreach ($listData as $key => $value): ?>
                    <tr>
                        <td><?= $key + 1 ?></td>
                        <td><?= $value['tour_name'] ?></td>
                        <td><?= $value['start_date']?></td>
                        <td><?= $value['end_date']?></td>
                        <td><?= $value['meeting_point']?></td>
                        <td>
                            <a href="<?= BASE_URL ?>?action=admin-update-departures&id=<?= $value['departure_id'] ?>" class="btn btn-primary">Sửa</a>
                            <a href="<?= BASE_URL ?>?action=admin-delete-departures&id=<?= $value['departure_id'] ?>" onclick="return confirm('Bạn có muốn xóa không')" class="btn btn-danger">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="4">Không có dữ liệu</td></tr>
            <?php endif; ?>
            </tbody>
         </table>
      </div>
   </div>
</div>
