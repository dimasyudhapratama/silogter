<script>
    var password = document.getElementById("password");
    var repassword = document.getElementById("repassword");

    function validatePassword(){
        if(password.value != repassword.value) {
            repassword.setCustomValidity("Password Tidak Sesuai");
        } else {
            repassword.setCustomValidity('');
        }
    }

// password.onchange = validatePassword;
// confirm_password.onkeyup = validatePassword;
</script>
<?php
include "../../config/koneksi.php";
$id = $_POST['id'];
$query = $connect->prepare("SELECT jabatan FROM pegawai WHERE id_pegawai='$id'");
$query->execute();
foreach($query as $data){
    $jabatan = $data['jabatan'];
}
?>
<input type="hidden" name="id_pegawai" value="<?php echo $id; ?>">
<div class="form-group">
    <div class="row">
        <div class="col-md-6 ">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required="">
            </div>
        </div>
        <div class="col-md-6 ">
            <div class="form-group">
                <label>Password</label>
                <input type="password" id="password" name="password" class="form-control" required="">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label >Masukkan Ulang password</label>
                <input type="password" id="repassword" name="repassword" class="form-control" onkeyup="validatePassword()">
            </div>
        </div>
        <input type="hidden" name="level" value="<?php if($jabatan=='Pimpinan'){echo "Pimpinan";}else if($jabatan=="Pegawai"){echo "Operator";} ?>">
        <div class="col-md-6 ">
            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="">--Pilih--</option>
                    <option value="Aktif">Aktif</option>
                    <option value="Non Aktif">Non Aktif</option>
                </select>
            </div>
        </div>
    </div>
</div>
