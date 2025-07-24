<?php require "libs/functions.php"; ?>
<?php require "settings/settings.php"; ?>
<?php
if (realpath($_SERVER["SCRIPT_FILENAME"]) === realpath(__FILE__))
    include "../config/config.php";
//echo $notCount."/".$maxNot;
?>
<?php
$notCount = getNoteCountById($_SESSION["accountID"]);
$kalanNotAdet = $maxNot - $notCount;
$yaziRenk = "text-white";
$yuzde = ($notCount / $maxNot) * 100;
$sonNot = mysqli_fetch_assoc(getLastNoteById($_SESSION["accountID"]));
if ($kalanNotAdet != 0) {
    $yaziArkaPlanRenk = "bg-success";
    $yazi = $kalanNotAdet . " adet not oluşturma hakkınız kaldı.";
    $durumRenk = "text-dark";
} else {
    $yaziArkaPlanRenk = "bg-danger";
    $yazi = "Not oluşturma hakkınız kalmadı!";
    $durumRenk = "text-danger";
}
?>

<?php
if (isset($_GET["notID"]) && is_numeric($_GET["notID"])) {
    $notID = $_GET["notID"];
    $not = mysqli_fetch_assoc(readNoteById($notID));
}

$olusturulduMu = false;
if (isCreatedProfileById($_SESSION["accountID"])) {
    $profil = mysqli_fetch_assoc(getProfileDetailById($_SESSION["accountID"]));
    $profilAd = $profil["isim"];
    $profilSoyad = $profil["soyisim"];
    $profilCinsiyet = getGenderById($profil["cinsiyet"]);
    $profilFoto = $profil["profil_url"];
    $olusturulduMu = true;
}

if ($notCount>0)
    $link = "not-oku.php?notID=".$sonNot['id'];
else
    $link = "#";

?>


<div class="container py-4">
    <div class="row justify-content-center g-4">
        <?php include "partials/_message.php"; ?>

        <div class="col-12 text-center mb-3 animate__animated animate__slideInDown">
            <h2 class="text-white">Merhaba, <span class="text-secondary"><?php echo htmlspecialchars($_SESSION["username"]); ?></span> Hoşgeldin!</h2>
            <h5 class="text-white-50">Aşağıda uygulama içerisinde yaptığın istatistikler yer almaktadır.</h5>
        </div>

        <div class="col-12 col-md-6 animate__animated animate__slideInLeft" style="max-width: 520px;">
            <div class="card shadow-lg rounded">
                <div class="card-header fw-bold text-muted bg-light">Oluşturulan Not Durumu</div>
                <div class="card-body text-center">
                    <h1 class="fw-bold <?php echo $durumRenk; ?> display-3"><?php echo $notCount . " / " . $maxNot; ?></h1>
                </div>
                <div class="card-footer <?php echo $yaziArkaPlanRenk; ?> text-center text-white fs-5">
                    <?php echo $yazi; ?>
                </div>
            </div>

            <div class="card mt-4 shadow rounded animate__animated animate__slideInLeft">
                <div class="card-header fw-bold bg-white">
                    <div class="row g-0 text-center">
                        <div class="col-4 border-end">
                            <h4 class="text-primary mb-1"><?php echo $notCount; ?></h4>
                            <small class="text-muted">Not oluşturdun</small>
                        </div>
                        <div class="col-4 border-end">
                            <h4 class="text-success mb-1"><?php echo $kalanNotAdet; ?></h4>
                            <small class="text-muted">Not hakkın kaldı</small>
                        </div>
                        <div class="col-4">
                            <h4 class="text-danger mb-1"><?php echo (int)$yuzde; ?>%</h4>
                            <small class="text-muted">Oluşturma oranın</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 animate__animated animate__slideInRight" style="max-width: 520px;">
            <a href="<?php echo $link; ?>" class="text-decoration-none text-reset">
                <div class="card shadow rounded h-100 hover-shadow" style="cursor:pointer;">
                    <div class="card-header fw-bold text-muted bg-white">Oluşturulan Son Not</div>
                    <div class="card-body">
                        <?php if ($notCount > 0): ?>
                            <h5 class="card-title fw-bold text-center text-truncate" title="<?php echo htmlspecialchars($sonNot["not_baslik"]); ?>">
                                <?php echo htmlspecialchars(veriCoz($sonNot["not_baslik"])); ?>
                            </h5>
                            <p class="card-text text-truncate" style="max-height: 4.5rem; overflow: hidden;">
                                <?php echo htmlspecialchars(url_duzenle(veriCoz($sonNot["not_detay"]))); ?>
                            </p>
                        <?php else: ?>
                            <h4 class="text-primary mt-5 text-center">Şuan herhangi bir oluşturduğun not bulunmuyor!</h4>
                        <?php endif ?>
                    </div>
                    <?php if ($notCount > 0): ?>
                        <div class="card-footer text-center text-muted small">
                            Oluşturulma Tarihi: <?php echo $sonNot["created_date"]; ?>
                        </div>
                    <?php endif ?>
                </div>
            </a>
        </div>

        <div class="col-12 col-md-6 animate__animated animate__slideInUp" style="max-width: 520px;">
            <div class="card shadow-sm text-center rounded">
                <div class="card-header bg-dark text-white fw-bold">Profil Bilgilerin</div>
                <div class="card-body">
                    <?php if ($olusturulduMu == true): ?>
                        <img src="profil_fotograflari/<?php echo $profilFoto; ?>" alt="Profil Fotoğrafı" class="rounded-circle mb-3 shadow" width="130" height="130" style="object-fit: cover;">
                        <h4 class="text-primary"><?php echo htmlspecialchars($profilAd . " " . $profilSoyad); ?></h4>
                        <p class="text-muted mb-3">Cinsiyet: <?php echo $profilCinsiyet; ?></p>
                    <?php else: ?>
                        <h4 class="text-danger">Profil bilgilerini henüz oluşturmadın!</h4>
                    <?php endif ?>
                    <a href="profil.php" class="btn btn-outline-primary btn-sm px-4">Profili Düzenle</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .hover-shadow:hover {
        box-shadow: 0 0.8rem 1.2rem rgba(0, 0, 0, 0.15);
        transition: box-shadow 0.3s ease-in-out;
    }
</style>