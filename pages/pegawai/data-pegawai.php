<?php
    if(isset($_GET['delete'])){
        $query_delete = $connect->exec("DELETE FROM supplier WHERE id_supplier='$_GET[delete]'");
        if($query_delete){
            echo "<script>window.location.href='?pages=supplier&delete_stat=true'</script>";
        } else{
            echo "<script>window.location.href='?pages=supplier&delete_stat=false'</script>";
        }
    }
    if(isset($_POST['simpan'])){
        $nm_supplier = $_POST['nm_supplier'];
        $cp_supplier = $_POST['cp_supplier'];
        $email_supplier = $_POST['alamat_supplier'];
        $alamat_supplier = $_POST['alamat_supplier'];
        // $query_tambah = $connect->exec("INSERT INTO kat_logistik(nm_kat_logistik) VALUES ('$nm_kat_logistik')");
        $query_tambah = $connect->exec("INSERT INTO supplier(nm_supplier,cp_supplier,email_supplier,alamat_supplier) VALUES ('$nm_supplier','$cp_supplier','$email_supplier','$alamat_supplier')");
        if($query_tambah){
            echo "<script>window.location.href='?pages=supplier&add_stat=true'</script>";
        }else{
            echo "<script>window.location.href='?pages=supplier&add_stat=false'</script>";
        }
       
    }
    if(isset($_POST['edit'])){
        $id = $_POST['id'];
        $nm_kat_logistik = $_POST['nm_kat_logistik'];
        $query_edit = $connect->exec("UPDATE kat_logistik SET nm_kat_logistik='$nm_kat_logistik' WHERE id_kat_logistik='$id'");
        if($query_edit){
            echo "<script>window.location.href='?pages=kategori_logistik&edit_stat=true'</script>";
        }else{
            echo "<script>window.location.href='?pages=kategori_logistik&edit_stat=false'</script>";
        }
    }
?>
<script src="src/jquery.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".click-edit").click(function(e) {
            var m = $(this).attr("id");
            $.ajax({
                url: "pages/supplier/edit-supplier.php",
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
                    <table class="data-table stripe hover nowrap">
                        <thead>
                        <tr>
                            <th class="table-plus datatable-nosort">No.</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th class="datatable-nosort">Action</th>
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
                            <td><?php echo $data['nm_supplier'] ?></td>
                            <td><?php echo $data['cp_supplier']; ?></td>
                            <td><?php echo $data['email_supplier']; ?></td>
                            <td><?php echo $data['alamat_supplier']; ?></td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-sm btn-outline-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                        Pilih
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item click-edit" id="<?php echo $data['id_supplier'] ?>" href="#" data-toggle="modal" data-target="#modaledit"><i class="fa fa-pencil"></i> Edit</a>
                                        <a class="dropdown-item" href="?pages=supplier&delete=<?php echo $data['id_supplier'] ?>"><i class="fa fa-trash"></i> Delete</a>
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
            <form name="input_pegawai" method="POST" action="?pages=pegawai">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Tambah Data Pegawai</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>NIP</label>
                                    <input type="text" name="nip_pegawai" class="form-control" required="">
                                </div>
                                <div class="form-group ">
                                    <label>Jabatan</label>
                                    <select class="form-control" name="jabatan">
                                        <option value="">--Pilih--</option>
                                        <option value="Pimpinan">Pimpinan</option>
                                        <option value="Pegawai">Pegawai Biasa</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" name="nm_pegawai" class="form-control" required="">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" name="username" class="form-control" required="">
                                </div>
                                <div class="form-group ">
                                    <label>Level</label>
                                    <select class="form-control" name="jabatan">
                                        <option value="">--Pilih--</option>
                                        <option value="admin">Admin</option>
                                        <option value="operator">Operator</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="text" name="nm_pegawai" class="form-control" required="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>