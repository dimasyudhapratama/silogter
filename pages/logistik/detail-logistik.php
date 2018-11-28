<?php
include '../../config/koneksi.php';
$id = $_POST['id'];
$query = $connect->query("SELECT * FROM logistik JOIN kat_logistik ON logistik.id_kat_logistik=kat_logistik.id_kat_logistik JOIN anggaran ON logistik.id_anggaran=anggaran.id_anggaran WHERE id_logistik='$id'");
foreach ($query as $ql) {
?>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Kategori</label>
                                    <input type="text" class="form-control-plaintext" disabled="" name="Kategori" value="<?php echo $ql['nm_kat_logistik'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Satuan</label>
                                    <input type="text" class="form-control-plaintext" disabled="" 
                                    value="<?php echo $ql['satuan'] ?>
                                    ">
                                </div>
                                <div class="form-group">
                                    <label>Asal Anggaran</label>
                                    <input type="text" class="form-control-plaintext" disabled="" value="<?php echo $ql['asal_anggaran'] ?>">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group ">
                                    <label>Nama Logistik</label>
                                    <input type="text" name="nm_logistik" class="form-control-plaintext" required="" value="<?php echo $ql['nm_logistik'] ?>" disabled="">
                                </div>
                                
                                <div class="form-group">
                                    <label>Harga Satuan </label>
                                    <input type="number" name="harga_satuan" class="form-control-plaintext" value="<?php echo $ql['harga_satuan'] ?>" disabled="">
                                </div>
                            </div>
                        </div>
                    </div>
<?php } ?>