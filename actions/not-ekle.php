<?php include "settings/settings.php"?>
<?php 
if (realpath($_SERVER["SCRIPT_FILENAME"]) === realpath(__FILE__))
    include "../config/config.php";
?>

<?php
    if (isset($_POST["kaydetBtn"]) && $_POST["kaydetBtn"] == "Notu Kaydet") {
        $notCount = getNoteCountById($_SESSION["accountID"]);
        if ($notCount==$maxNot){
            $_SESSION["message"] = "Zaten Maksimum sayıda not oluşturdunuz. Lütfen bir kaç tanesini silin!";
            $_SESSION["type"] = "danger";
        }else{
            $baslik = safe_html($_POST["notBaslik"]);
            $detay = safe_html($_POST["notDetay"]);
            $renk = safe_html($_POST["notRenk"]);
            $_SESSION["message"] = "Notunuz başarıyla oluşturuldu!";
            $_SESSION["type"] = "success";
            createNote($baslik, $detay, $renk, $_SESSION["accountID"]);
        }
    }
?>