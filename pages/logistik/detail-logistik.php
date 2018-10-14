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
                                    <input type="text" class="form-control" disabled="" name="Kategori" value="<?php echo $ql['nm_kat_logistik'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Satuan</label>
                                    <input type="text" class="form-control" disabled="" 
                                    value="<?php
                                        if($ql['satuan']=='Botol'){echo "Botol";}
                                        else if($ql['satuan']=='Tablet'){echo "Tablet";}
                                        else if($ql['satuan']=='Tablet'){echo "Tablet";}
                                        else if($ql['satuan']=='Kapsul'){echo "Kapsul";}
                                        else if($ql['satuan']=='Supp'){echo "Supp";}
                                        else if($ql['satuan']=='Biji'){echo "Biji";}
                                        else if($ql['satuan']=='Ampule'){echo "Ampule";}
                                        else if($ql['satuan']=='Tampon'){echo "Tammpon";}
                                        else if($ql['satuan']=='Galon 3 ltr'){echo "Galon 3 ltr";}
                                        else if($ql['satuan']=='Galon 5 ltr'){echo "Galon 5 ltr";}
                                        else if($ql['satuan']=='Tube'){echo "Tube";}
                                        else if($ql['satuan']=='Prefilied'){echo "Prefilied";}
                                            
                                       ?>
                                    ">
                                </div>
                                <div class="form-group">
                                    <label>Asal Anggaran</label>
                                    <input type="text" class="form-control" disabled="" value="<?php echo $ql['asal_anggaran'] ?>">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group ">
                                    <label>Nama Logistik</label>
                                    <input type="text" name="nm_logistik" class="form-control" required="" value="<?php echo $ql['nm_logistik'] ?>" disabled="">
                                </div>
                                
                                <div class="form-group">
                                    <label>Harga Satuan </label>
                                    <input type="number" name="harga_satuan" class="form-control" value="<?php echo $ql['harga_satuan'] ?>" disabled="">
                                </div>
                            </div>
                        </div>
                    </div>
<?php } ?>