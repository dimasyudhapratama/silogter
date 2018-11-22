<?php
if(isset($_POST['simpan'])){
    $nip = $_POST['nip'];
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $status = $_POST['status_pegawai'];
    //Validasi Hanya Ada 1 Pimpinan Berstatus Aktif
    if($jabatan=="Pimpinan"){
        $cek_pimpinan = $connect->prepare("SELECT id_pegawai FROM pegawai WHERE jabatan='Pimpinan' AND status='Aktif'");
        $cek_pimpinan->execute();
        if($cek_pimpinan->rowCount()>0){ //Gagal
                echo "<script>window.location.href='?pages=pegawai&add_stat=false&error=Silahkan Nonaktifkan Status Pimpinan Yang Lama Untuk Menambahkan Pimpinan Baru'</script>";
        }
    }
    $query_tambah_pegawai = $connect->prepare("INSERT INTO pegawai(nip,nama,jabatan,status) VALUES ('$nip','$nama','$jabatan','$status')");
    $query_tambah_pegawai->execute();
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
// if(isset($_POST['edit'])){
//     $id = $_POST['id'];
//     $nip = $_POST['nip'];
//     $nama=$_POST['nama'];
//     $jabatan=$_POST['jabatan'];
//     $status =$_POST['status'];
//     $query_edit = $connect->exec("UPDATE pegawai SET nip='$nip',nama='$nama',jabatan='$jabatan',status='$status' WHERE id_pegawai='$id'");
//     if($query_edit){
//         echo "<script>window.location.href='?pages=pegawai&edit_stat=true'</script>";
//     }else{
//         echo "<script>window.location.href='?pages=pegawai&edit_stat=false'</script>";
//     }
// }
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
<script src="src/jquery.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".click-edit").click(function(e) {
            var m = $(this).attr("id");
            $.ajax({
                url: "pages/pegawai/edit-pegawai.php",
                type: "POST",
                data : {id: m,},
                success: function (ajaxData){
                    $("#data-edit").html(ajaxData);
                }
            });
        });
    });
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
                    <button style="margin-left:10px;margin-bottom: 10px;" class="btn btn-primary btn-sm" data-target="#modaladd" data-toggle="modal">Tambah Data</button>
                    <div class="col-md-12">
                        <?php
                        // if(isset($_GET['delete_stat'])){
                        //     if($_GET['delete_stat']=="true") {
                        //         echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>Data Berhasil Dihapus
                        //         <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        //         <span aria-hidden='true'>&times;</span>
                        //         </button></div>";
                        //     }else if($_GET['delete_stat']=="false"){
                        //         echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Data Gagal Dihapus
                        //         <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        //         <span aria-hidden='true'>&times;</span>
                        //         </button></div>";
                        //     }
                        // }
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
                    <table class="data-table stripe hover nowrap">
                        <thead>
                            <tr>
                                <th class="table-plus datatable-nosort">No.</th>
                                <th class="table-plus datatable-nosort">Nip</th>
                                <th class="table-plus datatable-nosort">Nama</th>
                                <th class="table-plus datatable-nosort">Jabatan</th>
                                <th class="table-plus datatable-nosort">Status</th>
                                <th class="datatable-nosort">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $query = $connect->query("SELECT * FROM pegawai");
                            foreach($query as $data){
                                ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $data['nip']; ?></td>
                                    <td><?php echo $data['nama']; ?></td>
                                    <td><?php echo $data['jabatan']; ?></td>
                                    <td><?php echo $data['status']; ?></td>
                                    
                                    <td>
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-outline-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                                Pilih
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" onclick="detail(<?php echo $data['id_pegawai'] ?>,'<?php echo $data['jabatan'] ?>')" href="#" data-toggle="modal" data-target="#modaldetail"><i class="fa fa-eye"></i> Detail</a>
                                            <a class="dropdown-item click-edit" id="<?php echo $data['id_pegawai'] ?>" href="#" data-toggle="modal" data-target="#modaledit"><i class="fa fa-pencil"></i> Edit</a>
                                            <?php if($data['jabatan']=="Pimpinan" || $data['jabatan']=="Petugas Gudang"){ ?>
                                            <a class="dropdown-item change-password" onclick="admin_changepassword(<?php echo $data['id_pegawai'] ?>)" href="#" data-toggle="modal" data-target="#modalchangepassword"><i class="fa fa-gear"></i> Ubah Password</a>
                                            <?php } ?>
                                            <a onclick="return confirm('Anda Yakin Ingin menghapus Data?')" class="dropdown-item" href="?pages=pegawai&delete=<?php echo $data['id_pegawai'] ?>"><i class="fa fa-trash"></i> Delete</a>
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
                                <input type="text" name="nip" class="form-control" required="">
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
                <div class="modal-footer">
                    <button type="reset" class="btn btn-dark">Reset</button>
                    <button type="simpan" name="edit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modaledit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" name="edit-pegawai" action="?pages=pegawai&editdata">
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