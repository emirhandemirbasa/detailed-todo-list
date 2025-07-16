<?php include "partials/_header.php"; ?>

<style>
  body {
    background-color: #222;
  }
</style>

<div class="d-flex justify-content-center align-items-center vh-100">
  <div class="card text-bg-dark shadow-lg" style="max-width: 400px; width: 100%;">
    <div class="card-header bg-primary text-center fs-4 fw-bold shadow-lg">
      GİRİŞ ARAYÜZÜ
    </div>
    <div class="card-body p-4">
      <form method="POST">
        <div class="mb-3">
          <label for="username" class="form-label">Kullanıcı adı veya E-Mail</label>
          <input type="text" name="username" id="username" class="form-control" placeholder="email@ornek.com">
        </div>
        <div class="mb-4">
          <label for="password" class="form-label">Şifre</label>
          <input type="password" name="password" id="password" class="form-control" placeholder="********">
        </div>
        <div class="d-grid">
          <button type="submit" class="btn btn-success" name="girisYap">Giriş Yap</button>
        </div>
      </form>
    </div>
    <div class="card-footer text-center">
      <small class="text-white">Hesabınız yok mu? <a href="register.php" class="text-decoration-none">Kayıt Ol</a></small>
    </div>
  </div>
</div>

<?php include "partials/_footer.php"; ?>
