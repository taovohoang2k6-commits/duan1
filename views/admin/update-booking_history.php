<div class="container">
   <div class="row">
      <div class="col-3">
         <?php include "views/admin/sidebar.php"; ?>
      </div>

      <div class="col-9">
         <h3>Cập nhật lịch sử booking</h3>

         <form action="<?= BASE_URL ?>?action=admin-update-booking_history" method="POST">


            <input type="hidden" name="id" value="<?= $histor['history_id'] ?>">

            <div class="mb-3">
               <label>Booking</label>
               <select name="booking_id" class="form-control" required>
                  <?php foreach ($listBooking as $value): ?>
                     <option 
                        value="<?= $value['booking_id'] ?>"
                        <?= ($histor['booking_id'] == $value['booking_id']) ? 'selected' : '' ?>
                     >
                        <?= $value['booking_id'] ?> - <?= $value['customer_name'] ?>
                     </option>
                  <?php endforeach; ?>
               </select>
            </div>


            <div class="mb-3">
               <label>Trạng thái booking</label>
               <select name="status" class="form-control" required>
                  <?php 
                     $statusList = [
                        "pending" => "Chờ xử lý", 
                        "confirmed" => "Đã xác nhận", 
                        "cancelled" => "Đã hủy"
                     ];
                  ?>
                  <?php foreach ($statusList as $key => $label): ?>
                     <option 
                        value="<?= $key ?>"
                        <?= ($histor['status'] == $key) ? 'selected' : '' ?>
                     >
                        <?= $label ?>
                     </option>
                  <?php endforeach; ?>
               </select>
            </div>


            <div class="mb-3">
               <label>Ngày thay đổi</label>
               <input 
                  type="datetime-local" 
                  name="changed_at" 
                  class="form-control"
                  value="<?= date('Y-m-d\TH:i', strtotime($histor['changed_at'])) ?>"
                  required
               >
            </div>

 
            <div class="mb-3">
               <label>Người thực hiện thay đổi</label>
               <input 
                  type="text" 
                  class="form-control" 
                  name="changed_by"
                  value="<?= $histor['changed_by'] ?>"
                  required
               >
            </div>

            <div class="mb-3">
               <button type="submit" class="btn btn-primary btn-sm">Cập nhật</button>
            </div>

         </form>
      </div>
   </div>
</div>
