<?php require "libs/functions.php";?>
<?php
    $username = $email = $password = $repassword = "";
    $usernameErr = $emailErr = $passwordErr = $repassErr = "";
    $usernameCorrect=false;
    $emailCorrect=false;
    $butonDurum = "";
    $created=false;
    $passwordKontrol=false;

    if (isset($_POST["kayitOl"]) && $_POST["kayitOl"] == "Kayıt Ol"){
        if (!empty($_POST["username"])){
            $username = safe_html($_POST["username"]);
            if (isUsing("username",$username)){
                $_SESSION["message"] = "Kullanıcı adı bir başkası tarafından kullanılıyor.";
                $_SESSION["type"] = "danger";
            }else{
                $usernameCorrect = true;
            }
        }else{
            $usernameErr = "Lütfen kullanıcı adınızı boş bırakmayın!";
        }
        if (!empty($_POST["email"])){
            $email = $_POST["email"];
            if (!filter_var($email,FILTER_VALIDATE_EMAIL)){
                    $_SESSION["message"] = "Geçersiz bir email adresi girdiniz!";
                    $_SESSION["type"] = "danger";
            }else{
                if (isUsing("email",$email)){
                    $_SESSION["message"] = "Bu email zaten bir başkası tarafından kullanılıyor.";
                    $_SESSION["type"] = "danger";
                }else{
                    $emailCorrect = true;
                }
            }
        }else{
            $emailErr = "Lütfen email adresinizi boş bırakmayın!";
        }
        if (!empty($_POST["password"])){
            $password = $_POST["password"];
            if (strlen($password)>=8 && strlen($password)<=32){
                $passwordKontrol = true;
            }
            else{
                $_SESSION["message"] = "Şifreniz 8 ile 32 karakterden oluşmalıdır!";
                $_SESSION["type"] = "danger";
            }
        }else{
            $passwordErr = "Lütfen şifre kısmını boş bırakmayın!";
        }
        if (!empty($_POST["repassword"])){
            $repassword = $_POST["repassword"];
        }else{
            $repassErr = "Lütfen şifre tekrar kısmını boş bırakmayın!";
        }
        if (empty($passwordErr) && empty($repassErr)){
            if ($password==$repassword){
                if ($usernameCorrect == true && $emailCorrect==true && $passwordKontrol==true){
                    $_SESSION["message"] = "Hesabınız başarıyla oluşturuldu! Giriş arayüzüne yönlendiriliyorsunuz...";
                    $_SESSION["type"] = "success";
                    $butonDurum = "disabled";
                    $created=true;
                    createAccount($username,$email,$password);
                }  
            }else{
                $_SESSION["message"] = "Şifreleriniz uyuşmuyor!";
                $_SESSION["type"] = "danger";
            }  
        }
    }
?>


<?php include "partials/_header.php";?>

<style>
    body{
        background-color: #222;
    }
</style>

<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card text-bg-dark shadow-lg" style="max-width:400px; width:100%;">
        <div class="card-header bg-primary text-center fs-4 fw-bold shadow-lg">
            Kayıt Arayüzü
        </div>
        <div class="card-body p-4">
        <?php include "partials/_message.php";?>
            <form action="" method="POST">
                <div class="mb-4">
                    <label for="username">Kullanıcı Adı</label>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Kullanıcı adınızı girin..." value="<?php echo $username?>">
                    <div class="text-danger"><?php echo $usernameErr;?></div>
                </div>
                <div class="mb-4">
                    <label for="email">E-Mail</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="ornek@mail.com" class="form-control" value="<?php echo safe_html($email)?>">
                    <div class="text-danger"><?php echo $emailErr;?></div>
                </div>
                <div class="mb-4">
                    <label for="password">Şifre</label>
                    <input type="password" name="password" id="password" placeholder="Şifrenizi girin..." class="form-control">
                    <div class="text-danger"><?php echo $passwordErr;?></div>                    
                </div>
                <div class="mb-4">
                    <label for="repassword">Şifre tekrar</label>
                    <input type="password" name="repassword" id="repassword" placeholder="Şifrenizi tekrar girin..." class="form-control">
                    <div class="text-danger"><?php echo $repassErr;?></div>
                </div>
                <div class="d-grid">
                    <input type="submit" name="kayitOl" value="Kayıt Ol" class="btn btn-danger" <?php echo $butonDurum;?>>
                </div>
                <?php
                    if (empty($passwordErr) && empty($repassErr) && $usernameCorrect == true &&  $emailCorrect==true && $passwordKontrol==true && $created==true){
                        header("Refresh: 3; url=login.php");
                        exit;
                    }
                ?>
            </form>
        </div>
        <div class="card-footer text-center">
            <small class="text-white">Hesabınız var mı? <a href="login.php" class="text-decoration-none">Giriş Yap</a></small>
        </div>        
    </div>
</div>

<?php include "partials/_footer.php";?>