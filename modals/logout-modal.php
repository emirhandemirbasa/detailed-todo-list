<?php 
if (realpath($_SERVER["SCRIPT_FILENAME"]) === realpath(__FILE__))
    include "../config/config.php";
?>

<div class="modal fade" id="onay" tabindex="-1" role="dialog" aria-labelledby="onayLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title">UYARI!</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Kapat"></button>
      </div>
      <div class="modal-body">
        Hesabınızdan çıkış yapmak istediğinize emin misiniz?
      </div>
      <div class="modal-footer">
        <form action="logout.php" method="post">
          <button type="submit" class="btn btn-danger" name="cikisYap">Çıkış Yap</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Vazgeç</button>
        </form>
      </div>
    </div>
  </div>
</div>