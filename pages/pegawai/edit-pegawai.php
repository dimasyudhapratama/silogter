<?php 
$id= $_POST['id'];
include"../../config/koneksi.php";

$query=$connect->query(	"SELECT * FROM pegawai WHERE id_pegawai='$id'");
foreach ($query as $temp) {

?>
<input type="hidden" name="id" value="<?php echo $id; ?>">
<div class="form-group">
                        <div class="row">
                            <div class="col-md-6 ">
                                <div class="form-group">
                                    <label>NIP</label>
                                    <input type="text" name="nip" class="form-control" required="" value="<?php echo $temp['nip']?>">
                                </div>
                                
                            </div>
                            <div class="col-md-6 ">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" name="nama" class="form-control" required="" value="<?php echo $temp['nama']?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                    <label>Jabatan</label>
                                    <select class="form-control" name="jabatan">
                                        <option value="">--Pilih--</option>
                                        <option value="pimpinan"<?php if($temp['jabatan']=='pimpinan'){echo "Selected";} ?>>Pimpinan</option>
                                        <option value="pegawai"<?php if($temp['jabatan']=='pegawai'){echo "Selected";} ?>>Pegawai Biasa</option>
                                    </select>
                                </div>
                        </div>
                    </div>
<?php } ?>