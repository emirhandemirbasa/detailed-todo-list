<head>
    <title>Notlarım</title>
</head>

<?php include "libs/functions.php"?>

<?php
    session_start();
    if (!isset($_SESSION["username"])) {
        header("Location: login.php");
        exit;
    }
    $notCount = getNoteCountById($_SESSION["accountID"]);
?>

<style>
    body {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .card:hover {
        transform: scale(1.03);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }

    #plus-button {
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 60px;
        height: 60px;
        font-size: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
    }
</style>

<?php include "partials/_header.php" ?>
<?php include "partials/_sidebar.php" ?>
<div id="main-content" class="p-4">
    <div class="container mt-5">
        <h1 class="text-center text-white mb-4 fw-bold">NOT LİSTEM</h1>
        <?php include "partials/_message.php" ?>
        <div class="row justify-content-center">
            <?php if(getNoteCountById($_SESSION["accountID"])>0):?>
            <?php
            $notlar = getNotesById($_SESSION["accountID"]);
            while ($not = mysqli_fetch_assoc($notlar)): ?>

                <div class="col-sm-12 col-md-6 col-lg-4 d-flex justify-content-center mb-4 mt-5">
                    <a href="not-oku.php?notID=<?php echo $not["id"]; ?>" class="text-decoration-none w-100" style="max-width: 300px;">
                        <div class="card shadow-lg h-100" style="background-color: <?php echo $not["not_renk"]; ?>">
                            <div class="card-title text-center fs-5 fw-bold mt-3">
                                <?php echo veriCoz($not["not_baslik"]) ?: "HATA!"; ?>
                            </div>
                            <div class="card-body fs-6 text-center">
                                <p class="small">
                                    <?php echo url_duzenle(veriCoz($not["not_detay"]))?: "HATA"; ?>
                                </p>
                            </div>
                            <div class="card-footer small text-center">
                                Oluşturma Tarihi: <?php echo $not["created_date"]; ?>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endwhile; ?>
            <?php else:?>
                <h4 class="text-white text-center mt-5">Listelenecek bir not bulunmadı!</h4>
            <?php endif?>
            <button type="button" class="btn btn-primary rounded-circle shadow-lg" id="plus-button" data-bs-toggle="modal" data-bs-target="#notEkle">
                +
            </button>
        </div>
    </div>
</div>



<?php include "partials/_footer.php" ?>