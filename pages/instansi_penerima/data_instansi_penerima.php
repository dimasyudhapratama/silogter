<?php
    if(isset($_GET['delete'])){
        $query_delete = $connect->exec("DELETE FROM instansi_penerima WHERE id_instansi_penerima='$_GET[delete]'");
        if($query_delete){
            echo "<script>window.location.href='?pages=instansi_penerima&delete_stat=true'</script>";
        } else{
            echo "<script>window.location.href='?pages=instansi_penerimas&delete_stat=false'</script>";
        }
    }
    if(isset($_POST['simpan'])){
        $nm_instansi_penerima = $_POST['nm_instansi_penerima'];
        $alamat_instansi_penerima = $_POST['alamat_instansi_penerima'];
        $cp_instansi_penerima = $_POST['cp_instansi_penerima']; 
        $email_instansi_penerima = $_POST['email_instansi_penerima'];
        // $query_tambah = $connect->exec("INSERT INTO kat_logistik(nm_kat_logistik) VALUES ('$nm_kat_logistik')");
        $query_tambah = $connect->exec("INSERT INTO instansi_penerima(nm_instansi_penerima,alamat_instansi_penerima,cp_instansi_penerima,email_instansi_penerima) VALUES ('$nm_instansi_penerima','$alamat_instansi_penerima','$cp_instansi_penerima','$email_instansi_penerima')");
        if($query_tambah){
            echo "<script>window.location.href='?pages=instansi_penerima&add_stat=true'</script>";
        }else{
            echo "<script>window.location.href='?pages=instansi_penerima&add_stat=false'</script>";
        }
       
    }
    if(isset($_POST['edit'])){
        $id = $_POST['id'];
        $nm_instansi_penerima = $_POST['nm_instansi_penerima'];
        $alamat_instansi_penerima = $_POST['alamat_instansi_penerima'];
        $cp_instansi_penerima = $_POST['cp_instansi_penerima'];
        $email_instansi_penerima = $_POST['email_instansi_penerima'];
        $query_edit = $connect->exec("UPDATE instansi_penerima SET nm_instansi_penerima='$nm_instansi_penerima', alamat_instansi_penerima='$alamat_instansi_penerima',cp_instansi_penerima='$cp_instansi_penerima',email_instansi_penerima='$email_instansi_penerima' WHERE id_instansi_penerima='$id'");
        if($query_edit){
            echo "<script>window.location.href='?pages=instansi_penerima&edit_stat=true'</script>";
        }else{
            echo "<script>window.location.href='?pages=instansi_penerima&edit_stat=false'</script>";
        }
    }
?>
<script src="src/jquery.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".click-edit").click(function(e) {
            var m = $(this).attr("id");
            $.ajax({
                url: "pages/instansi_penerima/edit_instansi_penerima.php",
                type: "POST",
                data : {id: m,},
                success: function (ajaxData){
                    $("#data-edit").html(ajaxData);
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
                            <h4>Instansi Penerima</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Instansi Penerima</li>
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
                            if($_GET['delete_stat']==true) {
                                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>Data Berhasil Dihapus
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
									<span aria-hidden='true'>&times;</span>
								</button></div>";
                            }else if($_GET['delete_stat']==false){
                                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Data Gagal Dihapus
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
									<span aria-hidden='true'>&times;</span>
								</button></div>";
                            }
                        }
                        if(isset($_GET['add_stat'])){
                            if($_GET['add_stat']==true) {
                                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>Data Berhasil Ditambahkan
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button></div>";
                            }else if($_GET['add_stat']==false){
                                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Data Gagal Ditambahkan
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button></div>";
                            }
                        }
                        if(isset($_GET['edit_stat'])){
                            if($_GET['edit_stat']==true) {
                                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>Data Berhasil Diubah
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button></div>";
                            }else if($_GET['edit_stat']==false){
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
                            <!-- <th class="table-plus datatable-nosort">Id Instansi Penerima</th> -->
                            <th class="table-plus datatable-nosort">Nama </th>
                            <th class="table-plus datatable-nosort">Alamat</th>
                            <th class="table-plus datatable-nosort">Cp</th>
                            <th class="table-plus datatable-nosort">Email</th>
                            <th class="datatable-nosort">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $no = 1;
                        $query = $connect->query("SELECT * FROM instansi_penerima");
                        foreach($query as $data){
                        ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $data['nm_instansi_penerima']; ?></td>
                            <td><?php echo $data['alamat_instansi_penerima']; ?></td>
                            <td><?php echo $data['cp_instansi_penerima']; ?></td>
                            <td><?php echo $data['email_instansi_penerima']; ?></td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-sm btn-outline-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                        Pilih
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item click-edit" id="<?php echo $data['id_instansi_penerima'] ?>" href="#" data-toggle="modal" data-target="#modaledit"><i class="fa fa-pencil"></i> Edit</a>
                                        <a class="dropdown-item" href="?pages=instansi_penerima&delete=<?php echo $data['id_instansi_penerima'] ?>"><i class="fa fa-trash"></i> Delete</a>
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
<div class="modal fade bs-example-modal-lg" id="modaladd" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" name="input-instansi_penerima" action="?pages=instansi_penerima&tambahdata">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Tambah Data Instansi Penerima</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Nama Instansi Penerima</label>
                                    <input type="text" name="nm_instansi_penerima" class="form-control" required="">
                                </div>
                                <div class="form-group">
                                    <label>Email Instansi Penerima</label>
                                    <input type="text" name="email_instansi_penerima" class="form-control" required="">
                                </div>
                                
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group ">
                                    <label>CP Instansi Penerima</label>
                                    <input type="text" name="cp_instansi_penerima" class="form-control" required="">
                                </div>
                                
                                <div class="form-group">
                                    <label>Alamat Instansi Penerima</label>
                                    <textarea class="form-control" name="alamat_instansi_penerima" required=""></textarea>
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
            <form method="POST" name="edit-instansi-enerima" action="?pages=instansi_penerima&editdata">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Edit Data Instansi Penerima</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                </div>
                <div class="modal-body" id="data-edit">
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-dark">Reset</button>
                    <button type="submit" name="edit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
