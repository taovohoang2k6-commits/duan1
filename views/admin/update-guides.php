<div class="container">
   <div class="row">
    <div class="col-3">
     <?php include "views/admin/sidebar.php"; ?>
    </div>

    <div class="col-9">
        <form action="<?= BASE_URL ?>?action=admin-update-guides&id=<?= $data['guide_id'] ?>" method="POST">

            <div class="md-4">
                <label for="">Email</label>
                <input type="email" class="form-control" 
                       name="email" value="<?= $data['email'] ?>">
            </div>

            <div class="md-4">
                <label for="">Mật khẩu (nhập lại nếu muốn đổi)</label>
                <input type="password" class="form-control" name="password">
            </div>

            <div class="md-4">
                <label for="">Số điện thoại</label>
                <input type="text" class="form-control" 
                       name="phone" value="<?= $data['phone'] ?>">
            </div>

            <div class="md-4">
                <label for="">Tên</label>
                <input type="text" class="form-control" 
                       name="full_name" value="<?= $data['full_name'] ?>">
            </div>

            <div class="md-4">
                <label for="">Ngôn ngữ sử dụng</label>
                <input type="text" class="form-control" 
                       name="language" value="<?= $data['language'] ?>">
            </div>

            <div class="md-4">
                <label for="">Trạng thái</label>
                <select name="status" class="form-control">
                    <option value="active"   <?= $data['status']=='active' ? 'selected' : '' ?>>active</option>
                    <option value="inactive" <?= $data['status']=='inactive' ? 'selected' : '' ?>>inactive</option>
                </select>
            </div>
<div class="md-4">
    <label for="">Vai trò</label>
    <select name="role" class="form-control">
        <option value="HDV"     <?= $data['role']=='HDV' ? 'selected' : '' ?>>HDV</option>
        <option value="support" <?= $data['role']=='support' ? 'selected' : '' ?>>Support</option>
    </select>
</div>
            <button class="btn btn-primary btn-sm">Sửa</button>
        </form>
    </div>
   </div>
</div>
