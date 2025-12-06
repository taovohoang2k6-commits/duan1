<div class="container">
   <div class="row">
    <div class="col-3">
     <?php  include "views/admin/sidebar.php"; ?>
    </div>
    <div class="col-9">
        <form action="<?= BASE_URL ?>?action=admin-update-Tourcategory&id=<?= $data['category_id'] ?>" method="POST">
            <div class="md-4">
                <label for="">tên tour</label>
                <input type="text" class="form-control" name="name" value="<?= $data['name'] ?>">
            </div>
                        <div class="md-4">
                <label for="">mô tả</label>
                <input type="text" class="form-control" name="description"  value="<?= $data['name'] ?>">
            </div>
            <button class="btn btn-warning btn-sm">chỉnh sửa</button>
        </form>
    </div>
   </div>
</div>