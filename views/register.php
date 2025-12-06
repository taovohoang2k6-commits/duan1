<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Đăng ký</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
  body {
    background: #f2f4f7;
    font-family: Arial, sans-serif;
  }

  .register-box {
    max-width: 500px;
    margin: 60px auto;
    padding: 35px;
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
  }

  .register-box .form-control {
    height: 45px;
    border-radius: 10px;
  }

  .register-box button {
    height: 45px;
    border-radius: 10px;
    font-size: 16px;
    font-weight: 600;
  }
</style>
</head>

<body>

<form class="register-box" action="<?= BASE_URL ?>?action=register" method="POST">
  <h3 class="text-center mb-4">Đăng ký tài khoản</h3>

  <div class="mb-3">
    <label class="form-label">Họ và tên</label>
    <input type="text" class="form-control" name="name" placeholder="Nhập họ tên">
  </div>

  <div class="mb-3">
    <label class="form-label">Email</label>
    <input type="email" class="form-control" name="email" placeholder="Nhập email">
  </div>

  <div class="mb-3">
    <label class="form-label">Mật khẩu</label>
    <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu">
  </div>

  <div class="mb-3">
    <label class="form-label">Xác nhận mật khẩu</label>
    <input type="password" class="form-control" name="confirm" placeholder="Nhập lại mật khẩu">
  </div>

  <div class="mb-3">
    <label class="form-label">Số điện thoại</label>
    <input type="text" class="form-control" name="phone" placeholder="Nhập số điện thoại">
  </div>

  <div class="mb-3">
    <label class="form-label">Địa chỉ</label>
    <input type="text" class="form-control" name="address" placeholder="Nhập địa chỉ">
  </div>

  <div class="d-flex justify-content-between mb-3">
    <span>Bạn đã có tài khoản?</span>
    <a href="<?= BASE_URL ?>?action=login">Đăng nhập</a>
  </div>

  <button type="submit" class="btn btn-primary w-100">Đăng ký</button>
</form>

</body>
</html>
