<?php 
if (realpath($_SERVER["SCRIPT_FILENAME"]) === realpath(__FILE__))
    include "../config/config.php";
?>

<?php
    session_start();
    $modalAc = false;
        $baslikErr = "";
        $baslik = $detay = "";
    if(isset($_GET["notID"]) && is_numeric($_GET["notID"])){
        $ID = $_GET["notID"];
        $not = mysqli_fetch_assoc(readNoteById($ID));
        $baslik = $not["not_baslik"];
        $detay = $not["not_detay"];    
        $notRenk = $not["not_renk"];    
    }else{
        header("Location: notlar.php");
    }
    
    if (isset($_POST["duzenleBtn"]) && $_POST["duzenleBtn"] == "Düzenle"){
            $baslik = $_POST["not_baslik"];
            $detay = $_POST["not_detay"];
            $notRenk = $_POST["not_renk"];
        if (strlen($_POST["not_baslik"])>20){
            $baslikErr = "Notunuzun başlık uzunluğu 20 karakterden fazla olamaz!";            
            $modalAc = true;
        }

        if (empty($baslikErr)){
            $_SESSION["message"] = "Notunuz güncellendi!";
            $_SESSION["type"] = "success";
            updateNoteById($ID,$baslik,$detay,$notRenk);
            header("Location: notlar.php");
        }

    }
?>