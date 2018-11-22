<script>
    var newpassword = document.getElementById("newpassword");
    var repassword = document.getElementById("repassword");
    function validatePassword(){
        
        if(newpassword.value != repassword.value) {
            repassword.setCustomValidity("Password Tidak Sesuai");
        } else {
            repassword.setCustomValidity('');
        }
        
    }
    newpassword.onchange = validatePassword;
    repassword.onkeyup = validatePassword;
</script>
<?php
$id = $_POST['id'];
?>
<div class="form-group">
    <div class="row">
        <input type="hidden" name="id_pegawai" value="<?php echo $id ?>">
        <div class="col-md-6 ">
            <div class="form-group">
                <label>Password</label>
                <input type="password" id="newpassword" name="newpassword" class="form-control" required="">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label >Masukkan Ulang password</label>
                <input type="password" id="repassword" name="repassword" class="form-control" required>
            </div>
        </div>
    </div>
</div>
