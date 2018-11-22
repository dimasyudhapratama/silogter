<?php
    if(isset($_GET['delete'])){
        try{
            $query_delete = $connect->exec("DELETE FROM supplier WHERE id_supplier='$_GET[delete]'");
            echo "<script>window.location.href='?pages=supplier&delete_stat=true'</script>";
        }catch(Exception $e){
            echo "<script>window.location.href='?pages=supplier&delete_stat=false'</script>";
        }
    } 
    if(isset($_POST['simpan'])){
        $id_kat_logistik = $_POST['id_kat_logistik'];
        $nm_logistik = $_POST['nm_logistik'];
        $satuan = $_POST['satuan'];
        $harga_satuan = $_POST['harga_satuan'];
        $id_anggaran = $_POST['id_anggaran'];
        $minimal_stok  = $_POST['minimal_stok'];
        
        $query_tambah = $connect->exec("INSERT INTO logistik(id_kat_logistik,nm_logistik,stok,minimal_stok,satuan,harga_satuan,id_anggaran) VALUES ('$id_kat_logistik','$nm_logistik','0',$minimal_stok,'$satuan','$harga_satuan','$id_anggaran')");
        if($query_tambah == TRUE){
            echo "<script>window.location.href='?pages=logistik&add_stat=true'</script>";
        }else{
            echo "<script>window.location.href='?pages=logistik&add_stat=false'</script>";
        }
       
    }
    if(isset($_POST['edit'])){
        $id = $_POST['id'];
        $id_kat_logistik = $_POST['id_kat_logistik'];
        $nm_logistik = $_POST['nm_logistik'];
        $satuan = $_POST['satuan'];
        $harga_satuan = $_POST['harga_satuan'];
        $id_anggaran = $_POST['id_anggaran'];
        $query_edit = $connect->exec("UPDATE logistik SET id_kat_logistik='$id_kat_logistik', nm_logistik='$nm_logistik',satuan='$satuan',harga_satuan='$harga_satuan',id_anggaran='$id_anggaran' WHERE id_logistik='$id'");
        if($query_edit == TRUE){
            echo "<script>window.location.href='?pages=logistik&edit_stat=true'</script>";
        }else{
            echo "<script>window.location.href='?pages=logistik&edit_stat=false'</script>";
        }
    }
?>
<script src="src/jquery.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".click-edit").click(function(e) {
            var m = $(this).attr("id");
            $.ajax({
                url: "pages/logistik/edit-logistik.php",
                type: "POST",
                data : {id: m,},
                success: function (ajaxData){
                    $("#data-edit").html(ajaxData);
                }
            });
        });
    });
    $(document).ready(function () {
        $(".click-detail").click(function(e) {
            var m = $(this).attr("id");
            $.ajax({
                url: "pages/logistik/detail-logistik.php",
                type: "POST",
                data : {id: m,},
                success: function (ajaxData){
                    $("#data-detail").html(ajaxData);
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
                            <h4>Logistik</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Logistik</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Simple Datatable start -->
            <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
                <div class="row">
                    <button style="margin-left:10px;margin-bottom: 10px;" class="btn btn-primary btn-sm" data-target="#modaladd" data-toggle="modal">Tambah Data</button>
                     <button style="margin-left:10px;margin-bottom: 10px;" class="btn btn-success btn-sm" data-target="#modalfilter" data-toggle="modal">Filter</button>
                    <div class="col-md-12">
                        <?php
                        if(isset($_GET['delete_stat'])){
                            if($_GET['delete_stat']=='true') {
                                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>Data Berhasil Dihapus
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button></div>";
                            }else if($_GET['delete_stat']=='false'){
                                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Data Gagal Dihapus<br><i>Data Digunakan/Terhubung Dengan Data Lain</i>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button></div>";
                            }

                        }
                        if(isset($_GET['add_stat'])){
                            if($_GET['add_stat']=='true') {
                                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>Data Berhasil Ditambahkan
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button></div>";
                            }else if($_GET['add_stat']=='false'){
                                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Data Gagal Ditambahkan
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button></div>";
                            }
                        }
                        if(isset($_GET['edit_stat'])){
                            if($_GET['edit_stat']=='true') {
                                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>Data Berhasil Diubah
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button></div>";
                            }else if($_GET['edit_stat']=='false'){
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
                            <th class="table-plus ">Nama</th>
                            <th class="table-plus">Kategori</th>
                            <th class="table-plus datatable-nosort">Stok</th>
                            <th class="table-plus datatable-nosort">Satuan</th>
                            <th class="datatable-nosort">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $no = 1;
                        if(isset($_POST['filter'])){
                            $key = $_POST['key'];
                            if($_POST['filter_by']=='kat_logistik'){
                                $query_logistik = $connect->query("SELECT * FROM logistik JOIN kat_logistik ON logistik.id_kat_logistik=kat_logistik.id_kat_logistik JOIN anggaran ON logistik.id_anggaran=anggaran.id_anggaran WHERE kat_logistik.nm_kat_logistik LIKE '%".$key."%' ORDER BY nm_logistik ASC");
                            }else if($_POST['filter_by']=='nm_logistik'){
                                $query_logistik = $connect->query("SELECT * FROM logistik JOIN kat_logistik ON logistik.id_kat_logistik=kat_logistik.id_kat_logistik JOIN anggaran ON logistik.id_anggaran=anggaran.id_anggaran WHERE logistik.nm_logistik LIKE '%".$key."%' ORDER BY nm_logistik ASC");
                            }    
                        } else{
                            $query_logistik = $connect->query("SELECT * FROM logistik JOIN kat_logistik On logistik.id_kat_logistik=kat_logistik.id_kat_logistik JOIN anggaran ON logistik.id_anggaran=anggaran.id_anggaran ");
                        }
                        foreach($query_logistik as $ql){
                        ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $ql['nm_logistik'] ?></td>
                            <td><?php echo $ql['nm_kat_logistik']; ?></td>
                            <td><?php echo $ql['stok'] ?></td>
                            <td><?php echo $ql['satuan']; ?></td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-sm btn-outline-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                        Pilih
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item click-detail" id="<?php echo $ql['id_logistik'] ?>" href="#" data-toggle="modal" data-target="#modaldetail"><i class="fa fa-pencil"></i> Detail</a>
                                        <a class="dropdown-item click-edit" id="<?php echo $ql['id_logistik'] ?>" href="#" data-toggle="modal" data-target="#modaledit"><i class="fa fa-pencil"></i> Edit</a>
                                        <a class="dropdown-item" href="?pages=supplier&delete=<?php echo $ql['id_supplier'] ?>"><i class="fa fa-trash"></i> Delete</a>
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
            <form method="POST" name="input-supplier" action="?pages=logistik&tambahdata">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Tambah Data Logistik</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Kategori</label>
                                    <select name="id_kat_logistik" class="form-control" required="">
                                        <option value="">--Pilih--</option>
                                        <?php
                                        $query_kat = $connect->query("SELECT * FROM kat_logistik");
                                        foreach ($query_kat as $data) {
                                        ?>
                                        <option value="<?php echo $data['id_kat_logistik'] ?>"><?php echo  $data['nm_kat_logistik']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group ">
                                    <label>Nama Logistik</label>
                                    <input type="text" name="nm_logistik" class="form-control" required="">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Satuan</label>
                                    <select name="satuan" class="form-control" required="">
                                        <option value="">--Pilih--</option>
                                        <option value="Botol">Botol</option>
                                        <option value="Tablet">Tablet</option>
                                        <option value="Kapsul">Kapsul</option>
                                        <option value="Supp">Supp</option>
                                        <option value="Biji">Biji</option>
                                        <option value="Ampule">Ampule</option>
                                        <option value="Tampon">Tampon</option>
                                        <option value="Galon 3 ltr">Galon 3 ltr</option>
                                        <option value="Galon 5 ltr">Galon 5 ltr</option>
                                        <option value="Tube">Tube</option>
                                        <option value="Prefilied">Prefilied</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12"> 
                                <div class="form-group">
                                    <label>Harga Satuan </label>
                                    <input type="number" name="harga_satuan" class="form-control" required="" min="1">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Asal Anggaran</label>
                                    <select name="id_anggaran" class="form-control" required="">
                                        <option value="">--Pilih--</option>
                                        <?php
                                        $query_anggaran = $connect->query("SELECT * FROM anggaran");
                                        foreach ($query_anggaran as $data) {
                                        ?>
                                        <option value="<?php echo $data['id_anggaran'] ?>"><?php echo $data['asal_anggaran']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Min Stok (Untuk Pengingat)</label>
                                    <input type="text" class="form-control" name="minimal_stok" required="">
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
            <form method="POST" name="input-anggaran" action="?pages=logistik&editdata">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Edit Data Logistik</h4>
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
<div class="modal fade" id="modaldetail" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" name="input-logistik" action="?pages=supplier&editdata">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Detail Data Logistik</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                </div>
                <div class="modal-body" id="data-detail">
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modalfilter" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" name="filter-logistik" action="?pages=logistik&filterkeyword">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Filter Pencarian Data Logistik</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group ">
                                    <label>Filter Berdasarkan</label>
                                    <select name="filter_by" class="form-control">
                                        <option value="">--Pilih--</option>
                                        <option value="kat_logistik">Kategori Logistik</option>
                                        <option value="nm_logistik">Nama Logistik</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Masukkan Keyword Pencarian</label>
                                    <input type="text" name="key" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-dark">Reset</button>
                    <button type="submit" name="filter" class="btn btn-primary">Filter</button>
                </div>
            </form>
        </div>
    </div>
</div>
