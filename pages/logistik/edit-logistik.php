<?php
include '../../config/koneksi.php';
$id = $_POST['id'];
$query = $connect->query("SELECT * FROM logistik WHERE id_logistik='$id'");
foreach ($query as $ql) {
?>
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Kategori</label>
                                    <select name="id_kat_logistik" class="form-control" required="">
                                        <option value="" disabled="">--Pilih--</option>
                                        <?php
                                        $query_kat = $connect->query("SELECT * FROM kat_logistik");
                                        foreach ($query_kat as $data) {
                                        ?>
                                        <option value="<?php echo $data['id_kat_logistik'] ?>" 
                                            <?php
                                            if($data['id_kat_logistik']==$ql['id_kat_logistik']){echo "Selected";}
                                            ?>
                                            ><?php echo  $data['nm_kat_logistik']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Satuan</label>
                                    <select name="satuan" class="form-control" required="">
                                        <option value="" disabled="">--Pilih--</option>
                                        <option value="Botol" <?php if($ql['satuan']=='Botol'){echo "Selected";} ?>>Botol</option>
                                        <option value="Tablet" <?php if($ql['satuan']=='Tablet'){echo "Selected";} ?>>Tablet</option>
                                        <option value="Kapsul" <?php if($ql['satuan']=='Kapsul'){echo "Selected";} ?>>Kapsul</option>
                                        <option value="Supp" <?php if($ql['satuan']=='Supp'){echo "Selected";} ?>>Supp</option>
                                        <option value="Biji" <?php if($ql['satuan']=='Biji'){echo "Selected";} ?>>Biji</option>
                                        <option value="Ampule" <?php if($ql['satuan']=='Ampule'){echo "Selected";} ?>>Ampule</option>
                                        <option value="Tampon" <?php if($ql['satuan']=='Tampon'){echo "Selected";} ?>>Tampon</option>
                                        <option value="Galon 3 ltr" <?php if($ql['satuan']=='Galon 3 ltr'){echo "Selected";} ?>>Galon 3 ltr</option>
                                        <option value="Galon 5 ltr" <?php if($ql['satuan']=='Galon 5 ltr'){echo "Selected";} ?>>Galon 5 ltr</option>
                                        <option value="Tube" <?php if($ql['satuan']=='Tube'){echo "Selected";} ?>>Tube</option>
                                        <option value="Prefilied" <?php if($ql['satuan']=='Prefilied'){echo "Selected";} ?>>Prefilied</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Asal Anggaran</label>
                                    <select name="id_anggaran" class="form-control" required="">
                                        <option value="">--Pilih--</option>
                                        <?php
                                        $query_anggaran = $connect->query("SELECT * FROM anggaran");
                                        foreach ($query_anggaran as $data) {

                                        ?>
                                        <option value="<?php echo $data['id_anggaran'] ?>" <?php if($data['id_anggaran']==$ql['id_anggaran']){echo "Selected";} ?>><?php echo $data['asal_anggaran']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group ">
                                    <label>Nama Logistik</label>
                                    <input type="text" name="nm_logistik" class="form-control" required="" value="<?php echo $ql['nm_logistik'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Harga Satuan </label>
                                    <input type="number" name="harga_satuan" class="form-control" value="<?php echo $ql['harga_satuan'] ?>">
                                </div>
                            </div>
                        </div>
                    </div>
<?php } ?>