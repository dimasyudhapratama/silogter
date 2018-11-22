<?php 
$id= $_POST['id'];
$jabatan = $_POST['jbt'];
include"../../config/koneksi.php";
//Cek Jabatan
if($jabatan=="Penanggung Jawab"){
    $query = $connect->prepare("SELECT nip,nama,jabatan,pegawai.status as status_pegawai FROM pegawai WHERE id_pegawai='$id'");
    $query->execute();
}else if($jabatan=="Pimpinan" || $jabatan="Petugas Gudang"){
    $query=$connect->prepare("SELECT nip,nama,jabatan,pegawai.status as status_pegawai,username,level,user.status as status_user FROM pegawai JOIN user ON pegawai.id_pegawai=user.id_pegawai WHERE pegawai.id_pegawai='$id'");
    $query->execute();
}
foreach ($query as $temp) {
?>
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <div class="form-group">
        <div class="row">
            <div class="col-md-6 ">
                <div class="form-group">
                    <label>NIP</label>
                    <input type="text" name="nip" class="form-control-plaintext" readonly="" value="<?php echo $temp['nip']?>">
                </div>
            </div>
            <div class="col-md-6 ">
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control-plaintext" readonly="" value="<?php echo $temp['nama']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <label>Jabatan</label>
                <input type="text" class="form-control-plaintext" value="<?php echo $temp['jabatan']; ?>" readonly>
            </div>
            <div class="col-md-6 ">
                <div class="form-group">
                    <label>Status Pegawai</label>
                    <input type="text" class="form-control-plaintext" value="<?php echo $temp['status_pegawai'] ?>"
                        readonly>
                </div>
            </div>
            <?php if($temp['jabatan']=="Pimpinan" || $temp['jabatan']=="Petugas Gudang"){ ?>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="username">username</label>
                    <input type="text" class="form-control-plaintext" value="<?php echo $temp['username'] ?>" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="level">Level</label>
                    <input type="text" class="form-control-plaintext" value="<?php echo $temp['level'] ?>" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="status_user">Status User</label>
                    <input type="text" class="form-control-plaintext" value="<?php echo $temp['status_user'] ?>" readonly>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    <?php } ?>