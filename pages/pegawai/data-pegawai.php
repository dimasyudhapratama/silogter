<?php
if(isset($_GET['delete'])){
    $id_pegawai = $_GET['delete'];
    $query_user = $connect->query("SELECT id_user FROM user WHERE id_pegawai='$id_pegawai'");
    foreach($query_user as $qu){
        $id_user = $qu['id_user'];
        $delete_user=$connect->exec("DELETE FROM user WHERE id_user='$id_user'");
    }
    $delete_pegawai=$connect->exec("DELETE FROM pegawai WHERE id_pegawai='$id_pegawai'");

    if($delete_user && $delete_pegawai){
        echo "<script>window.location.href='?pages=pegawai&delete_stat=true'</script>";
    } else{
        echo "<script>window.location.href='?pages=pegawai&delete_stat=false'</script>";
    }
}
if(isset($_POST['simpan'])){
    $nip = $_POST['nip'];
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $status = $_POST['status'];

    $query_tambah_pegawai = $connect->exec("INSERT INTO pegawai(nip,nama,jabatan,status) VALUES ('$nip','$nama','$jabatan','$status')");

    if($query_tambah_pegawai){
        echo "<script>window.location.href='?pages=pegawai&add_stat=true'</script>";
    }else{
        echo "<script>window.location.href='?pages=pegawai&add_stat=false'</script>";
    }
}
if(isset($_POST['edit'])){
    $id = $_POST['id'];
    $nip = $_POST['nip'];
    $nama=$_POST['nama'];
    $jabatan=$_POST['jabatan'];
    $status =$_POST['status'];
    $query_edit = $connect->exec("UPDATE pegawai SET nip='$nip',nama='$nama',jabatan='$jabatan',status='$status' WHERE id_pegawai='$id'");
    if($query_edit){
        echo "<script>window.location.href='?pages=pegawai&edit_stat=true'</script>";
    }else{
        echo "<script>window.location.href='?pages=pegawai&edit_stat=false'</script>";
    }
}
if(isset($_POST['tambahuser'])){
    $id_pegawai = $_POST['id_pegawai'];
    $username = $_POST['username'];
    $password=$_POST['password'];
    $level=$_POST['level'];
    $status1 =$_POST['status1'];
    
    if ($_POST["password"] == $_POST["password1"]) {
       // echo "success";  
        $password_hash = password_hash($_POST['password']);
        
        $query_tambah_user= $connect->prepare("INSERT INTO user(id_pegawai,username,password,level,status) VALUES ('$id_pegawai','$username','$password_hash','$level','$status1')");
        $query_tambah_user->execute();
    }
    else {
       echo "Pasword berbeda";
   }

    // if($query_tambah_user){
    //     echo "<script>window.location.href='?pages=user&add_stat=true'</script>";
    // }else{
    //     echo "<script>window.location.href='?pages=pegawai&add_stat=false'</script>";
    // }
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

    $(document).ready(function() {
        $(".click-tambah").click(function(e) {
            var m = $(this).attr("id");
            $.ajax({
                url:"pages/pegawai/tambah-user.php",
                type:"POST",
                data:{id:m,},
                success:function(ajaxData){
                    $(".input-user").html(ajaxData);
                }
            });
        });
    });
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
                        if(isset($_GET['delete_stat'])){
                            if($_GET['delete_stat']=="true") {
                                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>Data Berhasil Dihapus
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                                </button></div>";
                            }else if($_GET['delete_stat']=="false"){
                                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Data Gagal Dihapus
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                                </button></div>";
                            }
                        }
                        if(isset($_GET['add_stat'])){
                            if($_GET['add_stat']=="true") {
                                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>Data Berhasil Ditambahkan
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                                </button></div>";
                            }else if($_GET['add_stat']=="false"){
                                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Data Gagal Ditambahkan
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
                                             <?php 
                                             $query_user = $connect->prepare("SELECT id_user FROM user WHERE id_pegawai='$data[id_pegawai]'");
                                             $query_user->execute();
                                             if($query_user->rowCount()==0){

                                                ?>
                                                <a class="dropdown-item click-tambah" id="<?php echo $data['id_pegawai'] ?>" href="#" data-toggle="modal" data-target="#modaltambah"><i class="fa fa-address-book-o"></i> Tambah User</a>
                                            <?php } ?>
                                            <a class="dropdown-item click-edit" id="<?php echo $data['id_pegawai'] ?>" href="#" data-toggle="modal" data-target="#modaledit"><i class="fa fa-pencil"></i> Edit</a>
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
                                <label>Jabatan</label>
                                <select class="form-control" name="jabatan">
                                   <option value="">--Pilih--</option>
                                   <option value="pimpinan">Pimpinan</option>
                                   <option value="pegawai">Pegawai Biasa</option>
                               </select>
                           </div>
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
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-dark">Reset</button>
                <button type="submit" name="simpan" class="btn btn-primary">Save changes</button>
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

<div class="modal fade bs-example-modal-lg" id="modaltambah" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" name="input-pegawai" action="?pages=pegawai&tambahdatauser">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Tambah Data User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                </div>
                <div class="modal-body input-user">
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-dark">Reset</button>
                    <button type="submit" name="tambahuser" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>