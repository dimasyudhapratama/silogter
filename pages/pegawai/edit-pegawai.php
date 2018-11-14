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
                    <option value=""disabled="">--Pilih--</option>
                    <option value="Pimpinan"<?php if($temp['jabatan']=='Pimpinan'){echo "Selected";} ?>>Pimpinan</option>
                    <option value="Pegawai"<?php if($temp['jabatan']=='Pegawai'){echo "Selected";} ?>>Pegawai Biasa</option>
                </select>
                
            </div>
            <div class="col-md-6 ">
                <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="status">
                        <option value=""disabled="">--Pilih--</option>
                        <option value="Aktif"<?php if($temp['status']=='Aktif'){echo "Selected";} ?>>Aktif</option>
                        <option value="Non Aktif"<?php if($temp['status']=='Non Aktif'){echo "Selected";} ?>>Non Aktif</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>