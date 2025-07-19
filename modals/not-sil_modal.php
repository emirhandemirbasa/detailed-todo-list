<?php 
if (realpath($_SERVER["SCRIPT_FILENAME"]) === realpath(__FILE__))
    include "../config/config.php";
    include "actions/not-sil.php";
?>

<div class="modal fade shadow" tabindex="-1" id="notSil">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <div class="modal-title">UYARI!</div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Gerçekten <?php echo veriCoz($baslik);?> başlıklı notunuzu silmek istiyor musunuz?</p>
            </div>
            <div class="modal-footer">
                <form action="" method="POST">
                    <input type="submit" class="btn btn-danger" value="Evet" name="evetBtn">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Hayır</button>
                </form>
            </div>
        </div>
    </div>  
</div>