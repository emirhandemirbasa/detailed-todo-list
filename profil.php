<?php include "libs/functions.php"; ?>

<head>
    <title>Profil</title>
</head>

<?php
session_start();
$isimErr = $soyisimErr = $profilFotoErr = $cinsiyetErr = "";

if (!isset($_SESSION["accountID"])) {
    header("Location: login.php");
} else {
    if (mysqli_num_rows(getProfileDetailById($_SESSION["accountID"])) > 0) {
        $profil = mysqli_fetch_assoc(getProfileDetailById($_SESSION["accountID"]));
        $isim = $profil["isim"];
        $soyisim = $profil["soyisim"];
        $profilFoto = $profil["profil_url"];
        $cinsiyet = $profil["cinsiyet"];
    } else {
        $isim = $soyisim = $profilFoto = $cinsiyet = "";
    }
    if ($profilFoto == "") {
        $profilFotoGoster = "profile.jpg";
    } else {
        $profilFotoGoster = $profil["profil_url"];
    }
}
if (isset($_POST["guncelle"]) && $_POST["guncelle"] == "Bilgileri Güncelle") {
    //İsim kontrolü
    if (!empty($_POST["isim"])) {
        $isim = trim($_POST["isim"]);

        if (!preg_match('/^[a-zA-ZçÇğĞıİöÖşŞüÜ\s-]+$/u', $isim)) {
            $isimErr = "İsminizde rakam veya özel karakter olmamalıdır!";
        } elseif (mb_strlen($isim) > 25) {
            $isimErr = "Girdiğiniz isim 25 karakterden fazla olmamalı!";
        }
    } else {
        $isimErr = "Lütfen isim alanını boş bırakmayın!";
    }
    //Soyisim kontrolü
    if (!empty($_POST["soyisim"])) {
        $soyisim = trim($_POST["soyisim"]);

        if (!preg_match('/^[a-zA-ZçÇğĞıİöÖşŞüÜ\s-]+$/u', $soyisim)) {
            $soyisimErr = "Soyisminizde rakam veya özel karakter olmamalıdır!";
        } elseif (mb_strlen($soyisim) > 25) {
            $soyisimErr = "Girdiğiniz soyisim 25 karakterden fazla olmamalı!";
        }
    } else {
        $soyisimErr = "Lütfen soyisim alanını boş bırakmayın!";
    }


    if ($_POST["cinsiyet"] == 1 || $_POST["cinsiyet"] == 2) {
        $cinsiyet = $_POST["cinsiyet"];
    } else {
        $cinsiyetErr = "Lütfen bir cinsiyet seçin!";
    }
    
    if (isset($_FILES["profilFoto"]) && $_FILES["profilFoto"]["size"] != 0) {
    $dosya = $_FILES["profilFoto"];
    $dosyaAdi = $dosya["name"];
    $dosyaPath = $dosya["tmp_name"];
    $dosyaAyir = explode(".", $dosyaAdi);
    $dosyaUzanti = strtolower(end($dosyaAyir)); // küçük harfe çevir
    $dosyaAdi = implode(".", array_slice($dosyaAyir, 0, -1));
    $dosyaAdiDegistir = md5(time() . $dosyaAdi . rand(1, 9999999999)) . "." . $dosyaUzanti;
    $yeniDosyaKonumu = "profil_fotograflari/" . $dosyaAdiDegistir;
    $izinVerilenUzantilar = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    $izinVerilenMimeTipleri = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeTip = finfo_file($finfo, $dosyaPath);
    finfo_close($finfo);

    if (!in_array($dosyaUzanti, $izinVerilenUzantilar) || !in_array($mimeTip, $izinVerilenMimeTipleri)) {
        $profilFotoErr = "Sadece resim ve gif formatlarında dosya yükleyebilirsiniz! (jpg, jpeg, png, gif, webp)";
    }
} else {
    $dosyaAdiDegistir = $profilFoto;
    $yeniDosyaKonumu = "";
}

    if (empty($isimErr) && empty($soyisimErr) && empty($profilFotoErr) && empty($cinsiyetErr)) {
        $dosyaTasindi = true;
        if ($yeniDosyaKonumu != "") {
            $dosyaTasindi = move_uploaded_file($dosyaPath, $yeniDosyaKonumu);
        }

        if ($dosyaTasindi) {
            $_SESSION["message"] = updateProfil($_SESSION["accountID"], $isim, $soyisim, $dosyaAdiDegistir, $cinsiyet);
            $_SESSION["type"] = "success";
            header("Location: index.php");
        } else {
            echo "HATA!";
        }
    }
}
?>

<?php include "partials/_header.php"; ?>
<?php include "partials/_sidebar.php"; ?>
<div id="main-content">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-7">
                <div class="card shadow rounded">
                    <div class="card-header bg-dark text-white fs-4 fw-semibold">Profil Düzenleme</div>
                    <div class="card-body bg-light">
                        <form action="" method="POST" enctype="multipart/form-data" novalidate>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="isim" class="form-label fw-semibold">Adınız</label>
                                    <input type="text" name="isim" id="isim" class="form-control <?php echo $isimErr ? 'is-invalid' : ''; ?>" placeholder="Adınızı girin..." value="<?php echo htmlspecialchars($isim); ?>">
                                    <?php if ($isimErr): ?>
                                        <div class="invalid-feedback"><?php echo $isimErr; ?></div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-6">
                                    <label for="soyisim" class="form-label fw-semibold">Soyadınız</label>
                                    <input type="text" name="soyisim" id="soyisim" class="form-control <?php echo $soyisimErr ? 'is-invalid' : ''; ?>" placeholder="Soyadınızı girin..." value="<?php echo htmlspecialchars($soyisim); ?>">
                                    <?php if ($soyisimErr): ?>
                                        <div class="invalid-feedback"><?php echo $soyisimErr; ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="my-4 text-center">
                                <img src="profil_fotograflari/<?php echo htmlspecialchars($profilFotoGoster); ?>" alt="Profil Fotoğrafı" class="rounded-circle shadow-sm" width="180" height="180" style="object-fit: cover;">
                            </div>

                            <div class="mb-3">
                                <label for="profilFoto" class="form-label fw-semibold">Profil Fotoğrafı Yükle</label>
                                <input type="file" name="profilFoto" id="profilFoto" class="form-control <?php echo $profilFotoErr ? 'is-invalid' : ''; ?>" accept="image/*">
                                <?php if ($profilFotoErr): ?>
                                    <div class="invalid-feedback"><?php echo $profilFotoErr; ?></div>
                                <?php else: ?>
                                    <div class="form-text">Desteklenen formatlar: JPG, PNG, GIF</div>
                                <?php endif; ?>
                            </div>

                            <fieldset class="mb-4">
                                <legend class="col-form-label fw-semibold mb-2">Cinsiyet</legend>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input <?php echo $cinsiyetErr ? 'is-invalid' : ''; ?>" type="radio" name="cinsiyet" id="cinsiyetErkek" value="1" <?php echo $cinsiyet == 1 ? "checked" : ""; ?>>
                                    <label class="form-check-label" for="cinsiyetErkek">Erkek</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input <?php echo $cinsiyetErr ? 'is-invalid' : ''; ?>" type="radio" name="cinsiyet" id="cinsiyetKadin" value="2" <?php echo $cinsiyet == 2 ? "checked" : ""; ?>>
                                    <label class="form-check-label" for="cinsiyetKadin">Kadın</label>
                                </div>
                                <?php if ($cinsiyetErr): ?>
                                    <div class="invalid-feedback d-block"><?php echo $cinsiyetErr; ?></div>
                                <?php endif; ?>
                            </fieldset>

                            <div class="d-grid">
                                <button type="submit" name="guncelle" value="Bilgileri Güncelle" class="btn btn-success btn-lg shadow-sm">Bilgileri Güncelle</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "partials/_footer.php"; ?>