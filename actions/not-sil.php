<?php 
if (realpath($_SERVER["SCRIPT_FILENAME"]) === realpath(__FILE__))
    include "../config/config.php";
?>

<?php
    if (isset($_POST["evetBtn"]) && $_POST["evetBtn"] == "Evet"){
        $baslik = veriCoz($baslik);
        $_SESSION["message"] = "'$baslik' Başlıklı notunuz silindi!";
        $_SESSION["type"] = "danger";
        deleteNoteById($_GET["notID"]);
        header("Location: notlar.php");
    }
?>