<?php
  if(isset($_POST['change_status'])){
    $id = $_POST['id'];
    $change_stat = $_POST['change_stat'];
    //Update Field Status Di Tabel Trx_logistik_masuk
    $query = $connect->prepare("UPDATE trx_logistik_masuk SET status='$change_stat' WHERE no_regist_masuk='$id'");
    $query->execute();
    if($change_stat==2){//Batalkan Pesanan
        //Load ID dari Tabel Detail Logistik Masuk
        $query2 = $connect->prepare("SELECT id_detail_masuk,id_logistik,qty FROM trx_detail_logistik_masuk WHERE no_regist_masuk='$id'");
        $query2->execute();
        foreach ($query2 as $data2) {
            //Ambil Stok Sekarang Di Tabel Logistik
            $query3 = $connect->prepare("SELECT stok FROM logistik WHERE id_logistik='$data2[id_logistik]'");
            $query3->execute();
            foreach ($query3 as $data3) {
                $new_stok = $data3['stok'] + $data2['qty'];
            }
            //Update Stok Logistik
            $update_stok = $connect->prepare("UPDATE logistik SET stok='$new_stok' WHERE id_logistik='$data2[id_logistik]'");
            $update_stok->execute();
        }
    }
    if($query==TRUE){
        echo "<script>window.location.href='?pages=logistik_masuk&change_stat=true'</script>";
    }else{
        echo "<script>window.location.href='?pages=logistik_masuk&change_stat=false'</script>";
    }
  }  
?>
<script src="src/jquery.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".click-change").click(function(e) {
            var m = $(this).attr("id");
            $.ajax({
                url: "pages/transaksi_masuk/ubah_status.php",
                type: "POST",
                data : {id: m,},
                success: function (ajaxData){
                    $(".data-ajax").html(ajaxData);
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
                            <h4>Data Logistik Masuk</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Data Logistik Masuk</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Simple Datatable start -->
            <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
                <div class="row">
                    <a href="?pages=tambah_transaksi_masuk" style="margin-left: 10px;margin-bottom: 10px;" class="btn btn-primary btn-sm">Tambah Data</a>
                    <div class="col-md-12">
                        <?php
                        
                        if(isset($_GET['change_stat'])){
                            if($_GET['change_stat']==true) {
                                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>Data Berhasil Diubah
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button></div>";
                            }else if($_GET['change_stat']==false){
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
                            <th style="text-align: center;" class="datatable-nosort">Supplier</th>
                            <th style="text-align: center;" class="datatable-nosort">Penanggung Jawab</th>
                            <th style="text-align: center;" class="datatable-nosort">Status</th>
                            <th style="text-align: center;" class="datatable-nosort">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $no = 1;
                        $query = $connect->query("SELECT no_regist_masuk,tgl_regist,nm_supplier,nama as nm_pegawai,trx_logistik_masuk.status FROM trx_logistik_masuk JOIN supplier ON trx_logistik_masuk.id_supplier=supplier.id_supplier JOIN pegawai ON trx_logistik_masuk.id_pegawai=pegawai.id_pegawai");
                        foreach($query as $data){
                        ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $data['no_regist_masuk']; ?></td>
                            <td><?php echo $data['tgl_regist'] ?></td>
                            <td><?php echo $data['nm_supplier']; ?></td>
                            <td><?php echo $data['nm_pegawai']; ?></td>
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
                                        <a class="dropdown-item" href="?pages=detail_transaksi_masuk&val=<?php echo $data['no_regist_masuk'] ?>"><i class="icon-copy fa fa-book" aria-hidden="true"></i> Detail</a>
                                        <a class="dropdown-item" href="print-pdf-pages/print-bukti-logistik-masuk.php?val=<?php echo $data['no_regist_masuk'] ?>"><i class="icon-copy fa fa-print" aria-hidden="true"></i> Cetak</a>
                                        <?php
                                        if($data['status']==0){
                                        ?>
                                        <a class="dropdown-item click-change" id="<?php echo $data['no_regist_masuk'] ?>" href="#" data-toggle="modal" data-target="#modalajax"><i class="fa fa-pencil"></i> Ubah Status</a>
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
<div class="modal fade bs-example-modal-lg" id="modalajax" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="?pages=logistik_masuk&change">
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

