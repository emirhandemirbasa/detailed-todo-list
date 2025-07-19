<?php 

if (realpath($_SERVER["SCRIPT_FILENAME"]) === realpath(__FILE__))
    include "../config/config.php";
    require "actions/not-ekle.php";
    
?>


<div class="modal fade" tabindex="-1" id="notEkle">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">Not Ekle</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-dark text-white">
                <form action="notlar.php" method="POST">
                    <div class="mb-3">
                        <label for="notBaslik" class="form-label">Not Başlığı</label>
                        <input type="text" name="notBaslik" id="notBaslik" class="form-control" placeholder="Başlık giriniz..." required>
                    </div>
                    <div class="mb-3">
                        <label for="notDetay" class="form-label">Not İçeriği</label>
                        <textarea name="notDetay" id="notDetay" class="form-control" rows="6" placeholder="Not detayını buraya yaz..." required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="notRenk" class="form-label">Arkaplan Rengi</label>
                        <input type="color" name="notRenk" id="notRenk" class="form-control form-control-color" value="#ffffff">
                    </div>
                    <div class="d-grid">
                        <input type="submit" class="btn btn-primary" name="kaydetBtn" value="Notu Kaydet">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>