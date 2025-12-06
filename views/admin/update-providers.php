<div class="container">
   <div class="row">
    <div class="col-3">
     <?php  include "views/admin/sidebar.php"; ?>
    </div>
    <div class="col-9">
        <form action="<?= BASE_URL ?>?action=admin-update-providers&id=<?= $data['provider_id'] ?>" method="POST">
            <div class="md-4">
                <label for="">Tên nhà cung cấp</label>
                <input type="text" class="form-control" name="name" value="<?= $data['name'] ?>">
            </div>
                        <div class="md-4">
                <label for="">Loại</label>
                <input type="text" class="form-control" name="type"  value="<?= $data['type'] ?>">
            </div>
                                    <div class="md-4">
                <label for="">Thông tin liên hệ</label>
                <input type="text" class="form-control" name="contact"  value="<?= $data['contact'] ?>">
            </div>
            <div class="md-4">
    <label for="">Địa chỉ</label>
    <input type="text" class="form-control" name="address" value="<?= $data['address'] ?>">
</div>
            <button class="btn btn-warning btn-sm">chỉnh sửa</button>
        </form>
    </div>
   </div>
</div>