<?php 
if (realpath($_SERVER["SCRIPT_FILENAME"]) === realpath(__FILE__))
    include "../config/config.php";
?>
<?php
    define("SIFRELEME_ANAHTARI", "emirhan.luaVe.PH");
    define("IV", "1234567890123456"); 
    function veriSifrele($sifrelenecekVeri){
        $sifreli = openssl_encrypt($sifrelenecekVeri,"AES-128-CBC",SIFRELEME_ANAHTARI,0,IV);
        return base64_encode($sifreli);
    }

    function veriCoz($cozulecekVeri){
        $cozulecekVeri = base64_decode($cozulecekVeri);
        $cozulmus = openssl_decrypt($cozulecekVeri,"AES-128-CBC",SIFRELEME_ANAHTARI,0,IV);
        return $cozulmus;
    }   

    function isCreatedProfileById($id){
        require "libs/baglanti.php";
        $query = "SELECT * FROM hesap_detay WHERE hesap_id=?";
        $stmt = mysqli_prepare($baglanti,$query);
        mysqli_stmt_bind_param($stmt,"i",$id);
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

function updateProfil($hesapID, $isim, $soyisim, $resim_url, $cinsiyetID) {
    require "libs/baglanti.php";

    $query = "SELECT 1 FROM hesap_detay WHERE hesap_id = ?";
    $stmt = mysqli_prepare($baglanti, $query);
    mysqli_stmt_bind_param($stmt, "i", $hesapID);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $count = mysqli_stmt_num_rows($stmt);
    mysqli_stmt_close($stmt);

    if ($count > 0) {
        $query = "UPDATE hesap_detay SET isim = ?, soyisim = ?, profil_url = ?, cinsiyet = ? WHERE hesap_id = ?";
        $mesaj = "Profil bilgileriniz güncellendi!";
    } else {
        $query = "INSERT INTO hesap_detay (isim, soyisim, profil_url, cinsiyet, hesap_id) VALUES (?, ?, ?, ?, ?)";
        $mesaj = "Profil bilgileriniz oluşturuldu!";
    }

    $stmt = mysqli_prepare($baglanti, $query);
    mysqli_stmt_bind_param($stmt, "sssii", $isim, $soyisim, $resim_url, $cinsiyetID, $hesapID);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($baglanti);

    return $mesaj;
}


    function getGenderById($genderID){
        require "libs/baglanti.php";
        $query = "SELECT * FROM cinsiyetler WHERE id=?";
        $stmt = mysqli_prepare($baglanti,$query);
        mysqli_stmt_bind_param($stmt,"i",$genderID);
        mysqli_stmt_execute($stmt);
        $cinsiyet = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt))["cinsiyet_adi"];
        mysqli_stmt_close($stmt);
        mysqli_close($baglanti);
        return $cinsiyet;
    }

    function getProfileDetailById($hesapID){
        require "libs/baglanti.php";
        $query = "SELECT hd.isim,hd.soyisim,hd.profil_url,hd.cinsiyet FROM hesaplar h INNER JOIN hesap_detay hd ON h.id = hd.hesap_id WHERE h.id=?";
        $stmt=mysqli_prepare($baglanti,$query);
        mysqli_stmt_bind_param($stmt,"i",$hesapID);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($baglanti);
        return $result;
    }

    function deleteNoteById($id){
        require "libs/baglanti.php";
        $query = "DELETE notlar FROM notlar WHERE id=?";
        $stmt = mysqli_prepare($baglanti,$query);
        mysqli_stmt_bind_param($stmt,"i",$id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($baglanti);
    }

    function updateNoteById($id,$baslik,$detay,$notRenk){
        require "libs/baglanti.php";
        $query = "UPDATE notlar SET not_baslik=?,not_detay=?,not_renk=? WHERE id=?";
        $stmt = mysqli_prepare($baglanti,$query);
        $baslikSifrele =veriSifrele($baslik);
        $detaySifrele =veriSifrele($detay);
        mysqli_stmt_bind_param($stmt,"sssi", $baslikSifrele, $detaySifrele,$notRenk,$id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($baglanti);
       // statement stmt
    }

    function readNoteById($ID){
        require "libs/baglanti.php";
        $query = "SELECT * FROM notlar WHERE id=?";
        $stmt = mysqli_prepare($baglanti,$query);
        mysqli_stmt_bind_param($stmt,"i",$ID);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($baglanti);
        return $result;
    }

    function getLastNoteById($ID){
        require "libs/baglanti.php";
        $query = "SELECT * FROM notlar WHERE not_sahip_id=? ORDER BY id DESC LIMIT 1";
        $stmt = mysqli_prepare($baglanti,$query);
        mysqli_stmt_bind_param($stmt,"i",$ID);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($baglanti);
        return $result;
    }

    //kullanıcının not sayısı
    
    function getNoteCountById($ID){
        require "libs/baglanti.php";
        $query = "SELECT * FROM notlar WHERE not_sahip_id=?";
        $stmt = mysqli_prepare($baglanti,$query);
        mysqli_stmt_bind_param($stmt,"i",$ID);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($baglanti);
        return mysqli_num_rows($result);
    }

    function createNote($baslik,$detay,$renk,$olusturanID){
        require "libs/baglanti.php";
        $query = "INSERT INTO notlar(not_baslik,not_detay,not_renk,not_sahip_id) VALUES (?,?,?,?)";
        $stmt = mysqli_prepare($baglanti,$query);
        $baslikSifrele =veriSifrele($baslik);
        $detaySifrele =veriSifrele($detay);
        mysqli_stmt_bind_param($stmt,"sssi",$baslikSifrele,$detaySifrele,$renk,$olusturanID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($baglanti);
    }

    function getAccountId($username){
       require "libs/baglanti.php";
       $QUERY = "SELECT * FROM hesaplar WHERE username = ? OR email = ?";
       $stmt = mysqli_prepare($baglanti,$QUERY);
       mysqli_stmt_bind_param($stmt,"ss",$username,$username);
       mysqli_stmt_execute($stmt);
       $result = mysqli_stmt_get_result($stmt);
       $assoc = mysqli_fetch_assoc($result)["id"];
       mysqli_stmt_close($stmt);
       mysqli_close($baglanti);
       return $assoc;
    }

    function getNotesById($id){
        require "libs/baglanti.php";
        $QUERY = "SELECT * FROM notlar WHERE not_sahip_id=? ORDER BY id DESC";
        $stmt = mysqli_prepare($baglanti,$QUERY);
        mysqli_stmt_bind_param($stmt,"i",$id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($baglanti);
        return $result;
    }

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

    function accountControl($usernameOREmail){
        require "libs/baglanti.php";
        $query = "SELECT  * FROM hesaplar WHERE username=? OR email=?";
        $stmt = mysqli_prepare($baglanti,$query);
        mysqli_stmt_bind_param($stmt,"ss",$usernameOREmail,$usernameOREmail);
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

    function url_duzenle($veri){
        if (strlen($veri)>50)
            return substr($veri,0,50)."...";
        else
            return $veri;
    }

    function safe_html($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }    
?>