<?php
    $baglanti = mysqli_connect("localhost","root","","tododb");
    if (mysqli_errno($baglanti)>0){
        echo "Bağlantı hatası!";
    }
?>