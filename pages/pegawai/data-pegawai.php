<?php
if(isset($_POST['simpan'])){
    $nip = $_POST['nip'];
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $status = $_POST['status_pegawai'];
    if($jabatan=="Pimpinan"){
        //Validasi Hanya Ada 1 Pimpinan Berstatus Aktif
        $cek_pimpinan = $connect->prepare("SELECT id_pegawai FROM pegawai WHERE jabatan='Pimpinan' AND status='Aktif'");
        $cek_pimpinan->execute();
        if($cek_pimpinan->rowCount()>0){ //Jika Ada Pemimpin Yang Aktif, Maka Pemimpin Lain Harus Dinonaktifkan Terlebih Dahulu
                echo "<script>window.location.href='?pages=pegawai&add_stat=false&error=Silahkan Nonaktifkan Status Pimpinan Yang Lama Untuk Menambahkan Pimpinan Baru'</script>";
        }else if($cek_pimpinan->rowCount()==0){ //Tidak Ada Pemimpin Aktif, Input Bisa Dilakukan
            $query_tambah = $connect->prepare("INSERT INTO pegawai(nip,nama,jabatan,status) VALUES ('$nip','$nama','Pimpinan','$status')");
            $query_tambah->execute();
            echo "<script>window.location.href='?pages=pegawai&add_stat=true'</script>";
        }
    }else if($jabatan=="Penanggung Jawab" || $jabatan=="Petugas Gudang"){
        $query_tambah = $connect->prepare("INSERT INTO pegawai(nip,nama,jabatan,status) VALUES ('$nip','$nama','$jabatan','$status')");
        $query_tambah->execute();
        echo "<script>window.location.href='?pages=pegawai&add_stat=true'</script>";
    }
    //Simpan Data User
    if($_POST['jabatan']=="Pimpinan" || $_POST['jabatan']=="Petugas Gudang"){
        $id_pegawai = $connect->lastInsertId();
        $username = $_POST['username'];
        $password=$_POST['password'];
        $repassword = $_POST['repassword'];
        $level=$_POST['level'];
        $status_user =$_POST['status_user'];

        $password_hash = password_hash($password,PASSWORD_DEFAULT);
        $query_tambah_user= $connect->prepare("INSERT INTO user(id_pegawai,username,password,level,status) VALUES ('$id_pegawai','$username','$password_hash','$level','$status')");
        $query_tambah_user->execute();
    }
}
if(isset($_POST['edit'])){
    $id = $_POST['id'];
    $nip = $_POST['nip'];
    $nama=$_POST['nama'];
    $jabatan=$_POST['jabatan-e'];
    $status_pegawai =$_POST['status_pegawai'];
    
    $query_edit = $connect->prepare("UPDATE pegawai SET nip='$nip',nama='$nama',jabatan='$jabatan',pegawai.status='$status_pegawai' WHERE id_pegawai='$id'");
    $query_edit->execute();
    if($status_pegawai=="Tidak Aktif"){//Menonaktifkan User Bila Pegawai Sudah Tidak Aktif
        $cek = $connect->query("SELECT id_user FROM user WHERE id_pegawai='$id'");
        if($cek->rowCount()>0){
            $query_update_status_user = $connect->prepare("UPDATE user SET status='Tidak Aktif' WHERE id_pegawai='$id'"); 
            $query_update_status_user->execute();   
        }
    }
    if($jabatan=="Penanggung Jawab"){
        //Cek Apakah Sudah Punya User, Jika Sudah Maka Dihapus, Karena Penanggung Jawab Tidak Butuh Login
        $cek = $connect->query("SELECT id_user FROM user WHERE id_pegawai='$id'");
        if($cek->rowCount()>0){ //Jika Punya
            $query = $connect->query("DELETE FROM user WHERE id_pegawai='$id'");
        }
    }else if($jabatan=="Petugas Gudang"){
        $username = $_POST['username'];
        $level = $_POST['level'];
        $status_user = $_POST['status_user'];
        //Cek Apakah Sudah Punya User, Jika Sudah Maka Gunakan Update, Jika Belum Gunakan Insert User Baru
        $cek = $connect->query("SELECT id_user FROM user WHERE id_pegawai='$id'");
        if($cek->rowCount()>0){ //Jika Punya, Lakukan Update
            $query_update_user = $connect->prepare("UPDATE user SET username='$username', level='$level', status='$status_user' WHERE id_pegawai='$id' ");
            $query_update_user->execute();
        }else if($cek->rowCount()==0){//Tidak Punya, Insert User Baru
            $password = $_POST['password-e'];
            $repassword = $_POST['repassword-e'];
            if($password==$repassword){
                $password_hash = password_hash($password,PASSWORD_DEFAULT);
                $query_insert_user = $connect->prepare("INSERT INTO user (id_pegawai,username,password,level,status) 
                VALUES ('$id','$username','$password_hash','$level','$status_user')");
                $query_insert_user->execute();
            }
        }
    }else if($jabatan=="Pimpinan"){
        //Cek Apakah Ada Pimpinan Aktif Selain Record Pegawai ini
        $cek_pimpinan = $connect->prepare("SELECT id_pegawai FROM pegawai WHERE jabatan='Pimpinan' AND status='Aktif' AND id_pegawai!='$id'");
        $cek_pimpinan->execute();
        if($cek_pimpinan->rowCount()>0){ //Jika Ada Pemimpin Yang Aktif, Maka Pemimpin Lain Harus Dinonaktifkan Terlebih Dahulu
            echo "<script>window.location.href='?pages=pegawai&edit_stat=false&error=Silahkan Nonaktifkan Status Pimpinan Yang Lama Untuk Menambahkan Pimpinan Baru'</script>";
        }else if($cek_pimpinan->rowCount()==0){ //Tidak Ada Pemimpin Aktif, Edit Bisa Dilakukan
            //Cek Apakah Sudah Punya User, Jika Sudah Maka Gunakan Update, Jika Belum Gunakan Insert User Baru
            $username = $_POST['username'];
            $level = $_POST['level'];
            $status_user = $_POST['status_user'];
            //Cek Apakah Sudah Punya User, Jika Sudah Maka Gunakan Update, Jika Belum Gunakan Insert User Baru
            $cek = $connect->query("SELECT id_user FROM user WHERE id_pegawai='$id'");
            if($cek->rowCount()>0){ //Jika Punya, Lakukan Update
                $query_update_user = $connect->prepare("UPDATE user SET username='$username', level='$level', status='$status_user' WHERE id_pegawai='$id' ");
                $query_update_user->execute();
            }else if($cek->rowCount()==0){//Tidak Punya, Insert User Baru
                $password = $_POST['password-e'];
                $repassword = $_POST['repassword-e'];
                if($password==$repassword){
                    $password_hash = password_hash($password,PASSWORD_DEFAULT);
                    $query_insert_user = $connect->prepare("INSERT INTO user (id_pegawai,username,password,level,status) 
                    VALUES ('$id','$username','$password_hash','$level','$status_user')");
                    $query_insert_user->execute();
                }
            }
            echo "<script>window.location.href='?pages=pegawai&edit_stat=true'</script>";
        }
    }
}
if(isset($_POST['changepassword'])){
    $id_pegawai = $_POST['id_pegawai'];
    $newpassword = $_POST['newpassword'];
    $repassword = $_POST['repassword'];
    
    if($newpassword==$repassword){
        $password_hash = password_hash($newpassword,PASSWORD_DEFAULT);
        try{
            $query = $connect->prepare("UPDATE user SET password='$password_hash' WHERE id_pegawai='$id_pegawai'");
            $query->execute();
            echo "<script>window.location.href='?pages=pegawai&changepassword_stat=true'</script>";
        }catch(Exception $e){
            echo "<script>window.location.href='?pages=pegawai&changepassword_stat=false'</script>";
        }
    }
}
?>
<!-- //pilih jabatan kalau berubah  pindah ke tambah user -->
<script src="src/jquery.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#jabatan").change(function(e){
            var m = $(this).val();
            $.ajax({
                url : "pages/pegawai/tambah-user.php",
                type : "POST",
                data : {jabatan:m},
                success:function(ajaxData){
                    $(".input-user").html(ajaxData);
                }
            });
        });
    });
   
</script>
<script>
  function edituser(){
    var jabatan = $("#jabatan-e").val();
    var username_saved = $("#username_saved").val();
    var level_saved = $("#level_saved").val();
    var status_user_saved = $("#status_user_saved").val();
    $.ajax({
      url : "pages/pegawai/edit-user.php",
      type : "POST",
      data : {jabatan:jabatan,username_saved:username_saved,level_saved:level_saved,status_user_saved:status_user_saved},
      success:function(ajaxData){
          $(".edit-user").html(ajaxData);
      }
    });
  }
</script>
<script>
    function detail(id_pegawai,jabatan){
        $.ajax({
            url : "pages/pegawai/detail-pegawai.php",
            type: "POST",
            data : {id : id_pegawai, jbt : jabatan},
            success : function(ajaxData){
                $("#data-detail").html(ajaxData);
            }
        });
    }
</script>
<script>
    function edit(id_pegawai,jabatan){
        $.ajax({
                url: "pages/pegawai/edit-pegawai.php",
                type: "POST",
                data : {id: id_pegawai,jbt:jabatan},
                success: function (ajaxData){
                    $("#data-edit").html(ajaxData);
                }
            });
    }
</script>
<script>
    function admin_changepassword(id_pegawai){
        $.ajax({
            url : "pages/pegawai/ubah-password.php",
            type : "POST",
            data : {id : id_pegawai},
            success : function(ajaxData){
                $("#data-changepassword").html(ajaxData);
            }
        });
    }
</script>
<script type="text/javascript">
    function FilterInput(event) {
        var txt = String.fromCharCode(event.which);
        var keyCode = ('which' in event) ? event.which : event.keyCode;
        var ascii = [32,48,49,50,51,52,53,54,55,56,57,8,9,11,127,24,25,26,27];
        var t = ascii.indexOf(keyCode);
        if(t==-1){
            return false;
        }
    };
</script>
<div class="main-container">
    <div class="pd-ltr-20 customscroll customscroll-10-p height-100-p xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Pegawai</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Pegawai</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Simple Datatable start -->
            <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
                <div class="row">
                    <button style="margin-left:10px;margin-bottom: 10px;" class="btn btn-primary btn-sm" data-target="#modaladd" data-toggle="modal"><i class="fa fa-plus-circle"></i> Tambah Data</button>
                    <div class="col-md-12">
                        <?php
                        if(isset($_GET['add_stat'])){
                            if($_GET['add_stat']=="true") {
                                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>Data Berhasil Ditambahkan
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                                </button></div>";
                            }else if($_GET['add_stat']=="false"){
                                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Data Gagal Ditambahkan .".$_GET['error']."
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                                </button></div>";
                            }
                        }
                        if(isset($_GET['edit_stat'])){
                            if($_GET['edit_stat']=="true") {
                                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>Data Berhasil Diubah
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                                </button></div>";
                            }else if($_GET['edit_stat']=="false"){
                                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Data Gagal Diubah
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                                </button></div>";
                            }
                        }
                        if(isset($_GET['changepassword_stat'])){
                            if($_GET['changepassword_stat']=="true"){
                                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>Password Berhasil Diubah
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                                </button></div>";
                            }else if($_GET['changepassword_stat']=="false"){
                                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Password Gagal Diubah, Silahkan Ulangi Kembali
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                                </button></div>";
                            }
                        }
                        ?>
                    </div>
                    <table class="data-table stripe hover nowrap table-bordered">
                        <thead>
                            <tr>
                                <th class="table-plus datatable-nosort" style="text-align: center;">No.</th>
                                <th class="table-plus datatable-nosort" style="text-align: center;">Nip</th>
                                <th class="table-plus datatable-nosort" style="text-align: center;">Nama</th>
                                <th class="table-plus datatable-nosort" style="text-align: center;">Jabatan</th>
                                <th class="table-plus datatable-nosort" style="text-align: center;">Status</th>
                                <th class="datatable-nosort" style="text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $query = $connect->query("SELECT * FROM pegawai ORDER BY nama,jabatan");
                            foreach($query as $data){
                                ?>
                                <tr>
                                    <td><?php echo $no++."." ?></td>
                                    <td><?php echo $data['nip']; ?></td>
                                    <td><?php echo $data['nama']; ?></td>
                                    <td><?php echo $data['jabatan']; ?></td>
                                    <td><?php echo $data['status']; ?></td>
                                    <td style="text-align: center;">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-outline-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                                Pilih
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" onclick="detail(<?php echo $data['id_pegawai'] ?>,'<?php echo $data['jabatan'] ?>')" href="#" data-toggle="modal" data-target="#modaldetail"><i class="fa fa-eye"></i> Detail</a>
                                            <a class="dropdown-item" onclick="edit(<?php echo $data['id_pegawai'] ?>,'<?php echo $data['jabatan'] ?>')" href="#" data-toggle="modal" data-target="#modaledit"><i class="fa fa-pencil"></i> Edit</a>
                                            <?php if($data['jabatan']=="Pimpinan" || $data['jabatan']=="Petugas Gudang"){ ?>
                                            <a class="dropdown-item change-password" onclick="admin_changepassword(<?php echo $data['id_pegawai'] ?>)" href="#" data-toggle="modal" data-target="#modalchangepassword"><i class="fa fa-gear"></i> Ubah Password</a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php include('include/footer.php'); ?>
</div>
</div>
?>
<div class="modal fade bs-example-modal-lg" id="modaladd" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" name="input-pegawai" action="?pages=pegawai&tambahdata">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Tambah Data Pegawai</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6 ">
                            <div class="form-group">
                                <label>NIP</label>
                                <input type="text" name="nip" class="form-control" required="" onkeydown="return FilterInput(event)">
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="nama" class="form-control" required="">
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class="form-group">
                                <label>Jabatan</label>
                                <select class="form-control" name="jabatan" id="jabatan" required="">
                                   <option value="">--Pilih--</option>
                                   <option value="Pimpinan">Pimpinan</option>
                                   <option value="Penanggung Jawab">Penanggung Jawab</option>
                                   <option value="Petugas Gudang">Petugas Gudang</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status_pegawai" class="form-control" required="">
                                    <option value="">--Pilih--</option>
                                    <option value="Aktif">Aktif</option>
                                    <option value="Non Aktif">Non Aktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row input-user">
                        
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-dark">Reset</button>
                <button type="submit" name="simpan" class="btn btn-primary" onclick="validatePassword()">Save changes</button>
            </div>
        </form>
    </div>
</div>
</div>
<div class="modal fade" id="modaldetail" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" name="edit-pegawai" action="?pages=pegawai&editdata">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Detail Data Pegawai</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                </div>
                <div class="modal-body" id="data-detail">
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modaledit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" name="edit-pegawai" action="?pages=pegawai&editdata">
            <form method="POST" name="edit-pegawai" action="pages/pegawai/test-edit.php">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Edit Data Pegawai</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                </div>
                <div class="modal-body" id="data-edit">
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-dark">Reset</button>
                    <button type="simpan" name="edit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modalchangepassword" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" name="ubah-password" action="?pages=pegawai&changepassword">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Ubah Password</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                </div>
                <div class="modal-body" id="data-changepassword">
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-dark">Reset</button>
                    <button type="simpan" name="changepassword" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>