<?php
    session_start();
    session_unset();
    session_destroy();
    session_start();
    $_SESSION["message"] = "Başarıyla hesabından çıkış yaptın!";
    $_SESSION["type"] = "info";
    header("Location: login.php");
    exit;
?>