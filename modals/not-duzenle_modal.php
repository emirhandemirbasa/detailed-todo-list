<?php 
if (realpath($_SERVER["SCRIPT_FILENAME"]) === realpath(__FILE__))
    include "../config/config.php";
    include "actions/not-duzenle.php";
?>
<div class="modal fade shadow" tabindex="-1" id="notDuzenle">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Not Düzenleme Arayüzü</h5>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <div class="mb-2">
                        <label for="not_baslik">Not Başlık</label>
                        <input type="text" class="form-control" name="not_baslik" id="not_baslik" value="<?php echo veriCoz($baslik);?>" required>
                        <div class="text-danger"><?php echo $baslikErr;?></div>
                    </div>
                    <div class="mb-2">
                        <label for="not_detay">Not Detayları</label>
                        <textarea name="not_detay" id="not_detay" rows="7" class="form-control" required><?php echo veriCoz($detay);?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="not_renk" class="form-label">Arkaplan Rengi</label>
                        <input type="color" name="not_renk" id="not_renk" class="form-control form-control-color" value="<?php echo $notRenk;?>">
                    </div>                    
                    <div class="mb-2">
                        <input type="submit" class="btn btn-success" name="duzenleBtn" value="Düzenle">
                        <button type="submit" class="btn btn-secondary" name="geriBtn" data-bs-dismiss="modal">Geri</button>
                    </div>
                    </div>                    
                </form>
            </div>
        </div>
    </div>
</div>


<?php if ($modalAc): ?>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var myModal = new bootstrap.Modal(document.getElementById('notDuzenle'));
        myModal.show();
    });
</script>
<?php endif; ?>
