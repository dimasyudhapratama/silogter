<div class="main-container">
    <div class="pd-ltr-20 customscroll customscroll-10-p height-100-p xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Detail Data Logistik keluar</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="index.php?pages=logistik_keluar">Data Logistik Keluar</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Detail Data Logistik Keluar</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Form grid Start -->
                <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
                        <?php
                            $query = $connect->query("SELECT * FROM v_tlk WHERE no_regist_keluar='$_GET[val]'");
                            foreach($query as $data){
                                $tgl_regist = $data['tgl_keluar'];
                                $tgl = substr($tgl_regist,8,2);
                                $bulan = substr($tgl_regist, 5,2);
                                $tahun = substr($tgl_regist,0,4);
                                $tgl_indo = $tgl."-".$bulan."-".$tahun;
                        ?>
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>No. Registrasi</label>
                                    <input type="text" name="no_regist_masuk" class="form-control-plaintext" value="<?php echo $_GET['val'] ?>" readonly="">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input type="text" class="form-control-plaintext" name="tgl_regist" value="<?php echo $tgl_indo ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Penanggung Jawab</label>
                                    <input type="text" class="form-control-plaintext" name="id_pegawai" value="<?php echo $data['nm_pen_jawab'] ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Instansi Penerima</label>
                                    <input type="text" class="form-control-plaintext" name="supplier" value="<?php echo $data['nm_instansi_penerima'] ?>" readonly=>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Jumlah Belanja</label>
                                    <input type="text" class="form-control-plaintext" name="jml" value="<?php echo "Rp. ".number_format($data['grand_total'],2,',','.') ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <hr>
                                <table class="data-table strip hover nowrap table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center" class="datatable-nosort">No.</th>
                                            <th>Nama</th>
                                            <th>Kategori</th>
                                            <th>Satuan</th>
                                            <th>Asal Anggaran</th>
                                            <th>Exp. Date</th>
                                            <th style="text-align: center" class="datatable-nosort">Harga</th>
                                            <th style="text-align: center" class="datatable-nosort">Qty</th>
                                            <th style="text-align: center" class="datatable-nosort">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody id="detail_cart">
                                        <?php
                                        $no = 1;
                                        $query_detail = $connect->query("SELECT * FROM v_tdlk WHERE no_regist_keluar='$_GET[val]'");
                                        foreach ($query_detail as $data) {
                                        ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $data['nm_logistik']; ?></td>
                                            <td><?php echo $data['nm_kat_logistik'] ?></td>
                                            <td><?php echo $data['satuan'] ?></td>
                                            <td><?php echo $data['asal_anggaran'] ?></td>
                                            <td><?php echo $data['exp_date'] ?></td>
                                            <td><?php echo "Rp. ".number_format($data['harga'],2,',','.'); ?></td>
                                            <td><?php echo $data['qty']; ?></td>
                                            <td><?php echo "Rp. ".number_format($data['subtotal'],2,',','.');?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php } ?>
                </div>
                <!-- Form grid End -->
        </div>
        
        <?php include('include/footer.php'); ?>
    </div>
</div>
