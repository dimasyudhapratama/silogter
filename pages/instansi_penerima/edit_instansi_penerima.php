<?php
include '../../config/koneksi.php';
$id=$_POST['id']; 
$query=$connect->query("SELECT * FROM instansi_penerima WHERE id_instansi_penerima='$id'");
foreach ($query as $data) {
?> 
<input type="hidden" name="id" value="<?php echo $id; ?>">
<div class="form-group">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Nama Instansi Penerima</label>
                                    <input type="text" name="nm_instansi_penerima" class="form-control" required="" value="<?php echo $data['nm_instansi_penerima'] ?>">
                                </div>
                               
                                <div class="form-group">
                                    <label>Email Instansi Penerima</label>
                                    <input type="text" name="email_instansi_penerima" class="form-control" required="" value="<?php echo $data['email_instansi_penerima']?>">
                                </div>
                                
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group ">
                                    <label>CP Instansi Penerima</label>
                                    <input type="text" name="cp_instansi_penerima" class="form-control" required="" value="<?php echo $data['cp_instansi_penerima']?>">
                                </div>
                                
                                <div class="form-group">
                                    <label>Alamat Instansi Penerima</label>
                                    <textarea class="form-control" name="alamat_instansi_penerima" required=""><?php echo $data['alamat_instansi_penerima']?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
<?php } ?>