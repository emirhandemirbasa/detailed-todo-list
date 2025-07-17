<?php

    function createAccount($username,$email,$password){
        require "libs/baglanti.php";
        $QUERY = "INSERT INTO hesaplar(username,email,password) VALUES (?,?,?)";
        $stmt= mysqli_prepare($baglanti,$QUERY);
        $hashed_password = password_hash($password,PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt,"sss",$username,$email,$hashed_password);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($baglanti);
    }

    function isUsing($bilgi,$tur){
        require "libs/baglanti.php";
        if ($bilgi == "email")
            $QUERY = "SELECT * FROM hesaplar WHERE email=?";
        else
            $QUERY = "SELECT * FROM hesaplar WHERE username=?";
        $stmt = mysqli_prepare($baglanti,$QUERY);
        mysqli_stmt_bind_param($stmt,"s",$tur);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $count = mysqli_num_rows($result);
        mysqli_stmt_close($stmt);
        mysqli_close($baglanti);
        if ($count>0)
            return true;
        else
            return false;
    }

    function isPasswordCorrect($username,$password){
        require "libs/baglanti.php";
        $query = "SELECT * FROM hesaplar WHERE username=?";
        $stmt = mysqli_prepare($baglanti,$query);
        mysqli_stmt_bind_param($stmt,"s",$username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($result)>0){
            $hashed_password = mysqli_fetch_assoc($result)["password"];
            mysqli_stmt_close($stmt);
            mysqli_close($baglanti);
            if (password_verify($password,$hashed_password))
                return true;
            else
                return false;     
        }else{
            return false;
        }
    }

    function accountControl($username){
        require "libs/baglanti.php";
        $query = "SELECT  * FROM hesaplar WHERE username=? OR email=?";
        $stmt = mysqli_prepare($baglanti,$query);
        mysqli_stmt_bind_param($stmt,"ss",$username,$username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $count = mysqli_num_rows($result);
        mysqli_stmt_close($stmt);
        mysqli_close($baglanti);
        if ($count>0)
            return true;
        else
            return false;
    }

    function safe_html($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }    
?>