<?php
include '../../config/koneksi.php';
$id = $_POST['id'];
$query = $connect->query("SELECT * FROM logistik JOIN kat_logistik ON logistik.id_kat_logistik=kat_logistik.id_kat_logistik WHERE id_logistik='$id'");
foreach ($query as $ql) {
?>
    <div class="form-group">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label>Kategori</label>
                    <input type="text" class="form-control-plaintext" disabled="" name="Kategori" value="<?php echo $ql['nm_kat_logistik'] ?>">
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="form-group ">
                    <label>Nama Logistik</label>
                    <input type="text" name="nm_logistik" class="form-control-plaintext" required="" value="<?php echo $ql['nm_logistik'] ?>" disabled="">
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label>Satuan</label>
                    <input type="text" class="form-control-plaintext" disabled="" value="<?php echo $ql['satuan'] ?>
                    ">
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="">Minimal Stok</label>
                    <input type="text" class="form-control-plaintext" disabled="" value="<?php echo $ql['minimal_stok'] ?>">
                </div>
            </div>
        </div>
    </div>
<?php } ?>