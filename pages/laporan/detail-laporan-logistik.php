<div class="main-container">
    <div class="pd-ltr-20 customscroll customscroll-10-p height-100-p xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Detail Logistik</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="index.php?pages=logistik_masuk">Laporan Stok</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Detail Stok Per Logistik
                                <?php 
                                $query_logistik = $connect->query("SELECT nm_logistik FROM logistik WHERE id_logistik='$_GET[id_logistik]'");
                                foreach($query_logistik AS $ql){
                                    echo "<b>(".$ql['nm_logistik'].")</b>";
                                }
                                
                                ?>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Form grid Start -->
                <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="data-table stripe hover nowrap table-bordered">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Tgl. Masuk</th>
                                        <th>Asal Anggaran</th>
                                        <th>Exp. Date</th>
                                        <th>Stok Masuk</th>
                                        <th>Stok Keluar</th>
                                        <th>Stok Real</th>
                                        <th>Stok Operation</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                   $query = $connect->query("SELECT * FROM v_dl WHERE id_logistik='$_GET[id_logistik]' ORDER BY id_detail_logistik ASC");
                                   $no = 1;
                                   foreach($query as $data){             
                                ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $data['tgl_masuk'] ?></td>
                                        <td><?php echo $data['asal_anggaran']; ?></td>
                                        <td><?php echo $data['exp_date'] ?></td>
                                        <td><?php echo $data['stok_masuk'] ?></td>
                                        <td><?php echo $data['stok_keluar'] ?></td>
                                        <td><?php echo $data['jml_real'] ?></td>
                                        <td><?php echo $data['jml_operation'] ?></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Form grid End -->
        </div>
        
        <?php include('include/footer.php'); ?>
    </div>
</div>
