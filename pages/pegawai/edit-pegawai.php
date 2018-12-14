
<script type="text/javascript">
    function validateUsername_e(){
        var usernameval = $("#username").val();
        var username_saved = $("#username_saved").val();
        $.ajax({
            url : "pages/pegawai/validate-username-e.php",
            type : "POST",
            data : {username : usernameval,username_saved:username_saved},
            success : function(ajaxData){
                $("#error-username").html(ajaxData);
                username.setCustomValidity(ajaxData);
            }
        });
    }
</script>

<?php 
$id= $_POST['id']; 
include "../../config/koneksi.php";
if($_POST['jbt']=="Pimpinan" || $_POST['jbt']=="Petugas Gudang"){
    $query=$connect->query("SELECT nip,nama,jabatan,pegawai.status as status_pegawai,id_user,username,user.level as level_user,user.status as status_user 
    FROM pegawai JOIN user ON pegawai.id_pegawai=user.id_pegawai WHERE pegawai.id_pegawai='$id'");
}else if($_POST['jbt']=="Penanggung Jawab"){
    $query = $connect->query("SELECT nip,nama,jabatan,pegawai.status as status_pegawai FROM pegawai WHERE id_pegawai='$id'"); 
}
foreach ($query as $temp) { 
?>
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<div class="form-group">
  <div class="row">
    <div class="col-md-6 ">
      <div class="form-group">
        <label>NIP</label>
        <input type="text" name="nip" class="form-control" value="<?php echo $temp['nip']; ?>" required="" />
      </div>
    </div>
    <div class="col-md-6 ">
      <div class="form-group">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" value="<?php echo $temp['nama'] ?>" required="" />
      </div>
    </div>
    
    <div class="col-md-6 ">
      <div class="form-group">
        <label>Jabatan</label>
        <select class="form-control" name="jabatan-e" id="jabatan-e" onchange="edituser()" required>
          <option value="" disabled>--Pilih--</option>
          <option value="Pimpinan" <?php if($temp['jabatan']=="Pimpinan"){echo "selected";} ?>>Pimpinan</option>
          <option value="Penanggung Jawab" <?php if($temp['jabatan']=="Penanggung Jawab"){echo "selected";} ?>>Penanggung Jawab</option>
          <option value="Petugas Gudang" <?php if($temp['jabatan']=="Petugas Gudang"){echo "selected";} ?>>Petugas Gudang</option>
        </select>
      </div>
    </div>
    <div class="col-md-6 ">
      <div class="form-group">
        <label>Status</label>
        <select name="status_pegawai" class="form-control" required="">
          <option value="" disabled>--Pilih--</option>
          <option value="Aktif" <?php if($temp['status_pegawai']=="Aktif"){echo "selected";} ?>>Aktif</option>
          <option value="Non Aktif" <?php if($temp['status_pegawai']=="Non Aktif"){echo "selected";} ?>>Non Aktif</option>
        </select>
      </div>
    </div>
  </div>
  <!-- Digunakan Untuk Passing Data Username, Level, Dan Status_User Menggunakan Javascipt Ajax-->
  <?php
    if($temp['jabatan']=="Pimpinan" || $temp['jabatan']=="Petugas Gudang"){
        echo "<input type='hidden' name='id_user' id='id_user' value='".$temp['id_user']."'>";
        echo "<input type='hidden' name='username_saved' id='username_saved' value='".$temp['username']."'>";
        echo "<input type='hidden' name='level_saved' id='level_saved' value='".$temp['level_user']."'>";
        echo "<input type='hidden' name='status_user_saved' id='status_user_saved' value='".$temp['status_user']."'>";
    }else if($temp['jabatan']=="Penanggung Jawab"){
        echo "<input type='hidden' name='id_user' id='id_user' value=''>";
        echo "<input type='hidden' name='username_saved' id='username_saved' value=''>";
        echo "<input type='hidden' name='level_saved' id='level_saved' value=''>";
        echo "<input type='hidden' name='status_user_saved' id='status_user_saved' value=''>";
    }
  ?>
  <div class="row edit-user"> <!-- Akan Berganti Sesuai Dengan Pilihan Jabatan -->
<?php
    if($temp['jabatan']=="Pimpinan" || $temp['jabatan']=="Petugas Gudang"){
?>
    <div class="col-md-12">
        <hr>
    </div>
    <div class="col-md-6 ">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" id="username" class="form-control" value="<?php echo $temp['username'] ?>" onkeyup="validateUsername_e()" onchange="validateUsername_e()" required="">
            <small class="form-text text-danger" id="error-username"></small>
        </div>
    </div>
    <?php
    if($temp['jabatan']=="Pimpinan"){
        echo "<input type='hidden' name='level' value='Pimpinan'>";
    }else if($temp['jabatan']=="Petugas Gudang"){
    ?>
    <div class="col-md-6 ">
        <div class="form-group">
            <label>Level</label>
            <select name="level" id="level" class="form-control" required="">
                <option value="" disabled>--Pilih--</option>
                <option value="Admin" <?php if($temp['level_user']=="Admin"){echo "Selected";} ?>>Admin</option>
                <option value="Operator" <?php if($temp['level_user']=="Operator"){echo "Selected";} ?>>Operator</option>
            </select>
        </div>
    </div>
    <?php
    }
    ?>
    
    <div class="col-md-6 ">
        <div class="form-group">
            <label>Status Akses Login</label>
            <select name="status_user" class="form-control" required="">
                <option value="">--Pilih--</option>
                <option value="Aktif" <?php if($temp['status_user']=="Aktif"){echo "Selected";} ?>>Aktif</option>
                <option value="Non Aktif" <?php if($temp['status_user']=="Non Aktif"){echo "Selected";} ?>>Non Aktif</option>
            </select>
        </div>
    </div>
  </div>
</div>
<?php }} ?>
