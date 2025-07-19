<head>
    <title>NOT OKUMA</title>
</head>
<!-- functions.php not-duzenle ve not-sil için ortak bir fonksiyonlar dosyası gibi bir işlev görüyor şuanda 
çünkü aşağıda bu dosyaları include ettik
-->
<?php require "libs/functions.php";?>

<!--Kesinlikle bu dosyada olmalılar yapı gereği-->
<?php include "modals/not-duzenle_modal.php";?>
<?php include "modals/not-sil_modal.php";?>

<?php

    if (isset($_GET["notID"]) && is_numeric($_GET["notID"])) {
        $not = mysqli_fetch_assoc(readNoteById($_GET["notID"]));
        if ($not["not_sahip_id"] != $_SESSION["accountID"])
            header("Location: notlar.php");
        $baslik = $not["not_baslik"];
        $detay = $not["not_detay"];
        $notRenk = $not["not_renk"];
    } else {
        header("Location: index.php");
    }

?>

<?php include "partials/_header.php" ?>
<?php include "partials/_sidebar.php" ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-5">
            <div class="card shadow-sm">
                <div class="card-header p-3 mt-2">
                    <h2 class="text-center mb-3"><?php echo veriCoz($baslik); ?></h2>
                </div>
                <div class="card-body" style="height:300px;">
                    <p class="text-muted"><?php echo nl2br(veriCoz($detay)); ?></p>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-12 col-md-8 d-flex justify-content-start mb-2 mb-md-0">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#notDuzenle" class="btn btn-success me-2" style="width:100px;">Düzenle</button>
                            <button type="button" data-bs-toggle="modal" data-bs-target="#notSil" class="btn btn-danger" style="width:100px;">Sil</button>
                        </div>
                        <div class="col-12 col-md-4 d-flex justify-content-end">
                            <a href="notlar.php"><button type="button" class="btn btn-primary" style="width:100px;">Kapat</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "partials/_footer.php" ?>