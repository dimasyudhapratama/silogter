<?php
  if(isset($_POST['change_status'])){
        $id = $_POST['id'];
        $change_stat = $_POST['change_stat'];
        //Update Field Status Di Tabel Trx_logistik_keluar
        $query = $connect->prepare("UPDATE trx_logistik_keluar SET status='$change_stat' WHERE no_regist_keluar='$id'");
        $query->execute();
        if($change_stat==1){//Transaksi Selesai
            //Load Berdasarkan ID dari Tabel Detail Keluar
            $query2 = $connect->prepare("SELECT tdlk.id_detail_logistik,dl.id_logistik,qty FROM trx_detail_logistik_keluar tdlk JOIN detail_logistik dl ON tdlk.id_detail_logistik=dl.id_detail_logistik ");
            $query2->execute();
            foreach($query2 as $data2){ //Menampilkan id_detail_logistik dan qty
                //Memproses Untuk Mengurangi Stok Pada Tabel Logistik
                $query3 = $connect->prepare("SELECT stok FROM logistik WHERE id_logistik='$data2[id_logistik]'");
                $query3->execute();
                foreach ($query3 as $data3) {
                    $new_stok = $data3['stok'] - $data2['qty'];
                }
                //Update Stok Logistik
                $update_stok = $connect->prepare("UPDATE logistik SET stok='$new_stok' WHERE id_logistik='$data2[id_logistik]'");
                $update_stok->execute();
                //Memproses Untuk Mengurangi Stok Pada Detail Logistik
                $query4 = $connect->prepare("SELECT id_logistik,jml_detail_stok FROM detail_logistik WHERE id_detail_logistik='$data2[id_detail_logistik]'");
                $query4->execute();
                foreach($query4 as $data4){
                    $new_detail_stok = $data4['jml_detail_stok'] - $data2['qty'];
                }
                //Update Detail Stok
                $update_detail_stok = $connect->prepare("UPDATE detail_logistik SET jml_detail_stok='$new_detail_stok' WHERE id_detail_logistik='$data2[id_detail_logistik]'");
                $update_detail_stok->execute();
            }
            // foreach ($query2 as $data2) {
            //     //Ambil Stok Sekarang Di Tabel Logistik
            //     $query3 = $connect->prepare("SELECT stok FROM logistik WHERE id_logistik='$data2[id_logistik]'");
            //     $query3->execute();
            //     foreach ($query3 as $data3) {
            //         $new_stok = $data3['stok'] - $data2['qty'];
            //     }
            //     //Update Stok Logistik
            //     $update_stok = $connect->prepare("UPDATE logistik SET stok='$new_stok' WHERE id_logistik='$data2[id_logistik]'");
            //     $update_stok->execute();
            // }
        }
        if($query==TRUE){
            echo "<script>window.location.href='?pages=logistik_keluar&change_stat=true'</script>";
        }else{
            echo "<script>window.location.href='?pages=logistik_keluar&change_stat=false'</script>";
        }
  }  
  if(isset($_POST['filter'])){
        if($_POST['filter_by']=="date"){
            $param = "filter_by=".$_POST['filter_by']."&tgl=".$_POST['tgl'];
        }elseif ($_POST['filter_by']=="month") {
            $tanggal_awal = $_POST['btahun']."-".$_POST['bulan']."-01";
            $tanggal_akhir = date("Y-m-t",strtotime($tanggal_awal));
            $param = "filter_by=".$_POST['filter_by']."&tgl_awal=".$tanggal_awal."&tgl_akhir=".$tanggal_akhir;
        }elseif ($_POST['filter_by']=="year") {
            $tanggal_awal = $_POST['tahun']."-01-01";
            $tanggal_akhir = $_POST['tahun']."-12-30";
            $param = "filter_by=".$_POST['filter_by']."&tgl_awal=".$tanggal_awal."&tgl_akhir=".$tanggal_akhir;
        }elseif ($_POST['filter_by']=="custom"){
            $tanggal_awal = $_POST['tgl_awal'];
            $tanggal_akhir = $_POST['tgl_akhir'];
            $param = "filter_by=".$_POST['filter_by']."&tgl_awal=".$tanggal_awal."&tgl_akhir=".$tanggal_akhir;
        }
        echo "<script>window.location.href='?pages=logistik_keluar&".$param."'</script>";
    }
?>
<script src="src/jquery.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".click-change").click(function(e) {
            var m = $(this).attr("id");
            $.ajax({
                url: "pages/transaksi_keluar/ubah_status.php",
                type: "POST",
                data : {id: m,},
                success: function (ajaxData){
                    $(".data-ajax").html(ajaxData);
                }
            });
        });
    });
    $(document).ready(function () {
        $("#filter_by").change(function(e) {
            var m = $(this).val();
            $.ajax({
                url: "pages/transaksi_keluar/filterData.php",
                type: "POST",
                data : {filter_by: m,},
                success: function (ajaxData){
                    $(".filter-data").html(ajaxData);
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
                            <h4>Data Logistik Keluar</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Data Logistik Keluar</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Simple Datatable start -->
            <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
                <div class="row">
                    <?php
                    if(isset($_SESSION['user_level'])){
                        if($_SESSION['user_level']=="Admin" || $_SESSION['user_level']=="Operator"){
                    ?>
                    <a href="?pages=tambah_transaksi_keluar" style="margin-left: 10px;margin-bottom: 10px;" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> Tambah Data</a>
                    <?php
                        }
                    }
                    ?>
                    <button style="margin-left:10px;margin-bottom: 10px;" class="btn btn-success btn-sm" data-target="#modalfilter" data-toggle="modal"><i class="fa fa-filter"></i> Filter</button>
                    <?php
                        if(isset($_GET['filter_by'])){
                            if($_GET['filter_by']=="date"){
                                $param = "filter_by=".$_GET['filter_by']."&tgl=".$_GET['tgl'];
                                $query = $connect->query("SELECT * FROM v_tlk WHERE tgl_keluar='$_GET[tgl]' ORDER BY tgl_keluar DESC");
                            }elseif ($_GET['filter_by']=="month" || $_GET['filter_by']=="year" || $_GET['filter_by']=="custom") {
                                $tanggal_awal = $_GET['tgl_awal'];
                                $tanggal_akhir = $_GET['tgl_akhir'];
                                $param = "filter_by=".$_GET['filter_by']."&tgl_awal=".$tanggal_awal."&tgl_akhir=".$tanggal_akhir;
                                $query = $connect->query("SELECT * FROM v_tlk WHERE tgl_keluar BETWEEN '$tanggal_awal' AND '$tanggal_akhir' ORDER BY tgl_keluar DESC");
                            }
                        }else{
                            $query = $connect->query("SELECT * FROM v_tlk ORDER BY tgl_keluar DESC");
                        }
                    ?>
                    <a href="javascript:void(0);" onclick="window.open('print-pdf-pages/print-data-logistik-keluar.php?<?php if(isset($_GET['filter_by'])){echo $param;} ?>','Print','width=1366,height=800,scrollbars=yes,resizeable=no')" style="margin-left: 10px;margin-bottom: 10px;" class="btn btn-warning btn-sm"><i class="fa fa-print"></i> Print</a>
                    <div class="col-md-12">
                        <?php
                        if(isset($_GET['change_stat'])){
                            if($_GET['change_stat']=="true") {
                                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>Data Berhasil Diubah
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button></div>";
                            }else if($_GET['change_stat']=="false"){
                                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Data Gagal Diubah
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
                            <th style="text-align: center;" class="datatable-nosort">No.</th>
                            <th style="text-align: center;" class="datatable-nosort">No. Regist</th>
                            <th style="text-align: center;" class="datatable-nosort">Tanggal</th>
                            <th style="text-align: center;" class="datatable-nosort">Penanggung Jawab</th>
                            <th style="text-align: center;" class="datatable-nosort">Penerima</th>
                            <th style="text-align: center;" class="datatable-nosort">Status</th>
                            <th style="text-align: center;" class="datatable-nosort">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $no = 1;
                        foreach($query as $data){
                        ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $data['no_regist_keluar']; ?></td>
                            <td><?php echo $data['tgl_keluar'] ?></td>
                            <td><?php echo $data['nm_pen_jawab']; ?></td>
                            <td><?php echo $data['nm_instansi_penerima']; ?></td>
                            <td style="text-align: center;">
                                <?php
                                    if($data['status']==0){
                                        echo "<span class='badge badge-primary'>Proses</span>";
                                    }else if($data['status']==1){
                                        echo "<span class='badge badge-success'>Selesai</span>";
                                    }else if($data['status']==2){
                                        echo "<span class='badge badge-danger'>Batal</span>";
                                    }
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <div class="dropdown">
                                    <a class="btn btn-sm btn-outline-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                        Pilih
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="?pages=detail_transaksi_keluar&val=<?php echo $data['no_regist_keluar'] ?>"><i class="icon-copy fa fa-book" aria-hidden="true"></i> Detail</a>
                                        <a class="dropdown-item" href="javascript:void(0);" onclick="window.open('print-pdf-pages/print-bukti-logistik-keluar.php?val=<?php echo $data['no_regist_keluar'] ?>','Print','width=1366,height=800,scrollbars=yes,resizeable=no')"><i class="icon-copy fa fa-print" aria-hidden="true"></i> Cetak</a>
                                        <?php
                                        if($_SESSION['user_level']=="Operator" || $_SESSION['user_level']=="Admin"){
                                        if($data['status']==0){
                                        ?>
                                        <a class="dropdown-item click-change" id="<?php echo $data['no_regist_keluar'] ?>" href="#" data-toggle="modal" data-target="#modalajax"><i class="fa fa-pencil"></i> Ubah Status</a>
                                        <?php }} ?>
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
<div class="modal fade bs-example-modal-lg" id="modalajax" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="?pages=logistik_keluar&change">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Ubah Status Transaksi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                </div>
                <div class="modal-body data-ajax">
                    
                </div>
                <div class="modal-footer">
                    <button type="submit" name="change_status" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modalfilter" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" name="filter-logistik" action="?pages=logistik_keluar&filterkeyword">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Filter</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-5 col-sm-12">
                                <div class="form-group">
                                    <label>Filter Berdasarkan</label>
                                    <select name="filter_by" id="filter_by" class="form-control" required="">
                                        <option value="">--Pilih--</option>
                                        <option value="date">Tanggal</option>
                                        <option value="month">Bulan</option>
                                        <option value="year">Tahun</option>
                                        <option value="custom">Custom</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-7 col-sm-12 filter-data">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="filter" class="btn btn-primary">Filter</button>
                </div>
            </form>
        </div>
    </div>
</div>
