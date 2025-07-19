<?php require "libs/functions.php" ?>

<?php
session_start();
$username = $password = "";
$usernameErr = $passwordErr = "";
$usernameCorrect = false;
$passwordCorrect = false;
$butonDurum = "";
if (isset($_POST["girisYap"]) && $_POST["girisYap"] == "Giriş Yap") {
    if (!empty($_POST["username"])) {
        $username = safe_html($_POST["username"]);
        $hesapVarMi = accountControl($username);
        if ($hesapVarMi == false) {
            $_SESSION["message"] = "Böyle bir hesap veritabanında bulunamadı!";
            $_SESSION["type"] = "danger";
        } else {
            $usernameCorrect = true;
        }
    } else {
        $usernameErr = "Lütfen kullanıcı adınızı girin!";
    }
    if (!empty($_POST["password"])) {
        if ($usernameCorrect != false) {
            $password = $_POST["password"];
            $sifreDogruMu = isPasswordCorrect($username, $password);
            if ($sifreDogruMu == false) {
                $_SESSION["message"] = "Yanlış bir şifre girdiniz!";
                $_SESSION["type"] = "danger";
            } else {
                $passwordCorrect = true;
            }
        }
    } else {
        $passwordErr = "Lütfen şifrenizi girin!";
    }
    if ($passwordCorrect == true && $usernameCorrect == true) {
        $_SESSION["username"] = $username;
        $_SESSION["accountID"] = getAccountId($username);
        $_SESSION["message"] = "Başarıyla hesabınıza giriş yaptınız! Ana sayfaya yönlendiriliyorsunuz...";
        $_SESSION["type"] = "success";
        $butonDurum = "disabled";
    }
}
?>

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
            <?php
                require "partials/_message.php";
            ?>
            <form method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Kullanıcı adı veya E-Mail</label>
                    <input type="text" name="username" id="username" class="form-control" placeholder="email@ornek.com" value="<?php echo $username; ?>">
                    <div class="text-danger"><?php echo $usernameErr; ?></div>
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">Şifre</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="********" value="<?php echo $password; ?>">
                    <div class="text-danger"><?php echo $passwordErr; ?></div>
                </div>
                <div class="d-grid">
                    <input type="submit" class="btn btn-success" name="girisYap" value="Giriş Yap" <?php echo $butonDurum;?>>
                </div>
                <?php
                    if ($passwordCorrect == true && $usernameCorrect == true) {
                        header("Refresh: 3; url=index.php");
                        exit;
                    }
                ?>                
            </form>
        </div>
        <div class="card-footer text-center">
            <small class="text-white">Hesabınız yok mu? <a href="register.php" class="text-decoration-none">Kayıt Ol</a></small>
        </div>
    </div>
</div>

<?php include "partials/_footer.php"; ?>