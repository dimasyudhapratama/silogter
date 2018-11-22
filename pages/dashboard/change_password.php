<?php
if(isset($_POST['ubahpassword'])){
    $id_pegawai = $_POST['id_pegawai'];
    $lastpassword = $_POST['lastpassword'];
    $newpassword = $_POST['newpassword'];
    $repassword = $_POST['repassword'];
    
    $query = $connect->prepare("SELECT password FROM user WHERE id_pegawai='$id_pegawai'");
    $query->execute();
    foreach($query as $data){
        if(password_verify($lastpassword,$data['password'])){
            if($newpassword == $repassword){
                $password_hash = password_hash($newpassword,PASSWORD_DEFAULT);
                try{
                    $query_update = $connect->prepare("UPDATE user SET password='$password_hash' WHERE id_pegawai='$id_pegawai'");
                    $query_update->execute();
                    echo "<script>window.location.href='?pages=change_password&changepassword_stat=true'</script>";
                }catch(Exception $e){
                    echo "<script>window.location.href='?pages=change_password&changepassword_stat=false'</script>";
                }
            }else{
                echo "<script>window.location.href='?pages=change_password&changepassword_stat=false'</script>";
            }
        }else{//Password Lama Tidak Cocok Dengan Password Yang Tersimpan Di Database
           echo "<script>window.location.href='?pages=change_password&changepassword_stat=false'</script>";

        }
    }
    
}
?>
<div class="main-container">
    <div class="pd-ltr-20 customscroll customscroll-10-p height-100-p xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Ubah Password</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Ubah Password</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Form grid Start -->
                <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
                    <form name="add-transaksi-masuk" method="POST" action="">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <?php
                                if(isset($_GET['changepassword_stat'])){
                                    if($_GET['changepassword_stat']=="true") {
                                        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>Password Berhasil Diubah
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button></div>";
                                    }else if($_GET['changepassword_stat']=="false"){
                                        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Password Gagal Diubah
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button></div>";
                                    }
                                }
                                ?>    
                            </div>
                            <input type="hidden" name="id_pegawai" id="id_pegawai" value="<?php echo $_SESSION['user_id_pegawai']; ?>">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Masukkan Password Lama</label>
                                    <input type="password" id="lastpassword" name="lastpassword" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6 ">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" id="newpassword" name="newpassword" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label >Masukkan Ulang password</label>
                                    <input type="password" id="repassword" name="repassword" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group float-md-right">
                                    <button class="btn btn-primary btn-md" type="submit" name="ubahpassword"> Ubah Password</button>
                                </div>
                            </div>
                        </div>
                        
                    </form>
                </div>
                <!-- Form grid End -->
        </div>
        
        <?php include('include/footer.php'); ?>
    </div>
</div>
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