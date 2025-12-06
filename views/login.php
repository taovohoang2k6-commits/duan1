
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
  body {
    background: #f2f4f7;
    font-family: Arial, sans-serif;
  }

  .login-box {
    max-width: 420px;
    margin: 80px auto;
    padding: 35px;
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
  }

  .login-box .form-control {
    height: 45px;
    border-radius: 10px;
  }

  .login-box button {
    height: 45px;
    border-radius: 10px;
    font-size: 16px;
    font-weight: 600;
  }
</style>
</head>

<body>

<form class="login-box" action="<?= BASE_URL?>?action=login" method="post">
  <h3 class="text-center mb-4">Đăng nhập</h3>

  <div class="mb-3">
    <label class="form-label">Email</label>
    <input type="email" class="form-control" name="email" placeholder="Nhập email">
  </div>

  <div class="mb-3">
    <label class="form-label">Password</label>
    <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu">
  </div>

  <div class="d-flex justify-content-between mb-3">
    <a href="<?= BASE_URL ?>?action=register">Đăng ký</a>
  </div>

  <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
</form>

</body>
</html>
