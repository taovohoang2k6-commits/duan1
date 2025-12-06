<div class="container">
   <div class="row">
      <div class="col-3">
         <?php include "views/admin/sidebar.php"; ?>
      </div>
      <div class="col-9">
         <a href="<?= BASE_URL ?>?action=admin-create-assignments" class="btn btn-primary btn-sm">Thêm mới</a>
         <table class="table ">
            <thead>
               <tr>
                  <th>STT</th>
                  <th>Chuyến đi</th>
                  <th>HDV phân công</th>
                  <th>Dịch vụ</th>
                  <th>Vai trò</th>
                  <th>Hành động</th>
               </tr>
            </thead>
            <tbody>
            <?php if (!empty($listData) && is_array($listData)): ?>
                <?php foreach ($listData as $key => $value): ?>
                    <tr>
                        <td><?= $key + 1 ?></td>
                        <td><?= $value['departure_name'] ?></td>
                        <td><?= $value['guide_name']?></td>
                        <td><?= $value['provider_name']?></td>
                        <td><?= $value['role']?></td>
                        <td>
                            <a href="<?= BASE_URL ?>?action=admin-update-assignments&id=<?= $value['assignment_id'] ?>" class="btn btn-primary">Sửa</a>
                            <a href="<?= BASE_URL ?>?action=admin-delete-assignments&id=<?= $value['assignment_id'] ?>" onclick="return confirm('Bạn có muốn xóa không')" class="btn btn-danger">Xóa</a>
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
