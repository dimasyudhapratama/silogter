<?php
include '../../config/koneksi.php'; 
if($_POST['jabatan']=="Pimpinan" || $_POST['jabatan']=="Petugas Gudang"){
    $username_saved = $_POST['username_saved'];
    $level_saved = $_POST['level_saved'];
    $status_user_saved = $_POST['status_user_saved'];
?>
<script>
    var password = document.getElementById("password-e");
    var repassword = document.getElementById("repassword-e");
    function validatePassword(){
        
        if(password.value != repassword.value) {
            repassword.setCustomValidity("Password Tidak Sesuai");
        } else {
            repassword.setCustomValidity('');
        }
    }
    password.onchange = validatePassword;
    repassword.onkeyup = validatePassword;
</script>
<div class="col-md-12">
    <hr>
</div>
<div class="col-md-6 ">
    <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" id="username" class="form-control" onkeyup="validateUsername_e()" onchange="validateUsername_e()" value="<?php echo $username_saved ?>" required>
        <small class="form-text text-danger" id="error-username"></small>
    </div>
</div>
<?php
$cek = $connect->query("SELECT id_user FROM user WHERE username='$username_saved'");
if($cek->rowCount()==0){
?>
<div class="col-md-6 ">
    <div class="form-group">
        <label>Password</label>
        <input type="password" id="password-e" name="password-e" class="form-control" onkeyup="test()" required="">
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label >Masukkan Ulang password</label>
        <input type="password" id="repassword-e" name="repassword-e" class="form-control" required>
    </div>
</div>
<?php
}
if($_POST['jabatan']=="Pimpinan"){
    echo "<input type='hidden' name='level' value='Pimpinan'>";
}else if($_POST['jabatan']=="Petugas Gudang"){
?>
<div class="col-md-6 ">
    <div class="form-group">
        <label>Level</label>
        <select name="level" class="form-control" required="">
            <option value="" disabled>--Pilih--</option>
            <option value="Admin" <?php if($level_saved=="Admin"){echo "Selected";} ?>>Admin</option>
            <option value="Operator" <?php if($level_saved=="Operator"){echo "Selected";} ?>>Operator</option>
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
            <option value="" disabled>--Pilih--</option>
            <option value="Aktif" <?php if($status_user_saved=='Aktif'){echo "Selected";} ?>>Aktif</option>
            <option value="Non Aktif" <?php if($status_user_saved=='Non Aktif'){echo "Selected";} ?>>Non Aktif</option>
        </select>
    </div>
</div>
<?php } ?>
