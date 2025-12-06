<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
  body {
    background: #f2f4f7;
  }

  .login-box {
    max-width: 420px;
    margin: 80px auto;
    padding: 35px;
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
  }
</style>

<form class="login-box" action="<?= BASE_URL ?>?action=guide-login-post" method="POST">
  <h3 class="text-center mb-4">Đăng nhập HDV</h3>

  <div class="mb-3">
    <label>Email</label>
    <input type="text" name="email" class="form-control" required>
  </div>

  <div class="mb-3">
    <label>Password</label>
    <input type="password" name="password" class="form-control" required>
  </div>

  <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
</form>
