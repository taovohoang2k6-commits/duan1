<div class="container">
   <div class="row">
    <div class="col-3">
     <?php  include "views/admin/sidebar.php"; ?>
    </div>
    <div class="col-9">
        <form action="<?= BASE_URL ?>?action=admin-create-users" method="POST">
            <div class="md-4">
                <label for="">tên người dùng</label>
                <input type="text" class="form-control" name="name">
            </div>
            <div class="md-4">
                <label for="">email</label>
                <input type="email" class="form-control" name="email">
            </div>            <div class="md-4">
                <label for="">mật khẩu</label>
                <input type="password" class="form-control" name="password">
            </div>
                        <div class="md-4">
                <label for="">phone</label>
                <input type="text" class="form-control" name="phone">
            </div>
                        <div class="md-4">
                <label for="">address</label>
                <input type="text" class="form-control" name="address">
            </div>
                        <div class="md-4">
                <label for="">role</label>
               <select name="role" class="form-control">
<option value="0">HDV</option>
<option value="1">ADMIN</option>
               </select>
            </div>

            <button class="btn btn-primary btn-sm">thêm mới</button>
        </form>
    </div>
   </div>
</div>