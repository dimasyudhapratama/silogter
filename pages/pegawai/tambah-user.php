<script>
    var password = document.getElementById("password");
    var confirm_password = document.getElementById("repassword");

    function validatePassword(){
        if(password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Password Tidak Sesuai");
        } else {
            confirm_password.setCustomValidity('');
        }
    }

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
</script>
<input type="hidden" name="id_pegawai" value="<?php echo $_POST['id'] ?>">
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
        <div class="col-md-6 ">
            <label>Level</label>
            <select class="form-control" name="level">
                <option value="">--Pilih--</option>
                <option value="Admin">Admin</option>
                <option value="Pimpinan">Pimpinan</option>
                <option value="Operator">Operator</option>
            </select>
        </div>
        <div class="col-md-6 ">
            <div class="form-group">
                <label>Status</label>
                <select name="status1" class="form-control">
                    <option value="">--Pilih--</option>
                    <option value="Aktif">Aktif</option>
                    <option value="Non Aktif">Non Aktif</option>
                </select>
            </div>
        </div>
    </div>
</div>
