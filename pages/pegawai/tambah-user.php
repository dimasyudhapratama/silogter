<?php
if($_POST['jabatan']=="Pimpinan" || $_POST['jabatan']=="Petugas Gudang"){
?>
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
    password.onchange = validatePassword;
    repassword.onkeyup = validatePassword;
</script>
<script type="text/javascript">
    var username = document.getElementById("username");
    function validateUsername(){
        var usernameval = $("#username").val();
        $.ajax({
            url : "pages/pegawai/validate-username.php",
            type : "POST",
            data : {username : usernameval},
            success : function(ajaxData){
                $("#error-username").html(ajaxData);
                username.setCustomValidity(ajaxData);
                // cek(ajaxData);
            }
        });
    }
</script>
<script>
    function cek(ajaxData){
        // return alert(ajaxData);
        var username = document.getElementById("username");
        var cekerror = $("#errorusername").val();
        if(ajaxData="Username Sudah Digunakan"){
            username.setCustomValidity("Username Sudah Digunakan");
        }else{
            username.setCustomValidity("");
        }
        
        return alert(ajaxData)
        // if(cekerror==""){ //Benar
        //     username.setCustomValidity('');
        // }else{ //Salah
        // username.setCustomValidity("Username Sudah Dipakai");
        // }
    }
</script>
<div class="col-md-12">
    <hr>
</div>
<div class="col-md-6 ">
    <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" id="username" class="form-control" onkeyup="validateUsername()" onchange="validateUsername()" required="">
        <small class="form-text text-danger" id="error-username"></small>
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
        <input type="password" id="repassword" name="repassword" class="form-control" required>
    </div>
</div>
<?php
if($_POST['jabatan']=="Pimpinan"){
    echo "<input type='hidden' name='level' value='Pimpinan'>";
}else if($_POST['jabatan']=="Petugas Gudang"){
?>
<div class="col-md-6 ">
    <div class="form-group">
        <label>Level</label>
        <select name="level" class="form-control" required="">
            <option value="">--Pilih--</option>
            <option value="Admin">Admin</option>
            <option value="Operator">Operator</option>
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
            <option value="Aktif">Aktif</option>
            <option value="Non Aktif">Non Aktif</option>
        </select>
    </div>
</div>
<?php } ?>