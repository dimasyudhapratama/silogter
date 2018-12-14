<script src="src/jquery.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#detail_cart").load("pages/transaksi_masuk/detail_cart.php");
    });
    $(document).ready(function (){
        $("#id_kat_logistik").change(function(e){
            var id = $(this).val();
            $.ajax({
                url : "pages/transaksi_masuk/getIdLogistik.php",
                type: "POST",
                data : {id_kat_logistik: id},
                success: function(ajaxData){
                    $("#id_logistik").html(ajaxData);
                }
            });

        });
    });
    $(document).ready(function (){
        $("#id_logistik").change(function(e){
            var id = $(this).val();
            $.ajax({
                url : "pages/transaksi_masuk/getDataLogistik.php",
                type: "POST",
                data : {id_logistik: id},
                success: function(ajaxData){
                    $("#divAjaxData").html(ajaxData);
                }
            });

        });
    });
    function addCart(){
        if($("#id_logistik").val()=="" || $("#qty").val()==""){
            return alert("Lengkapi Data");
        }else{
            var id = $("#id_logistik").val();
            var qty = parseInt($("#qty").val());
            // var real_stok = parseInt($("#real_stok").val());

            $.ajax({
                url : "pages/transaksi_masuk/add_cart.php",
                type: "POST",
                data : {id:id,qty:qty},
                success : function(ajaxData){
                    $("#detail_cart").load("pages/transaksi_masuk/detail_cart.php");
                }
            });  
        }
    }
    function deleteCart(index){
        var id = index;
        $.ajax({
            url : "pages/transaksi_masuk/delete_cart.php",
            type : "POST",
            data : {index:id},
            success : function(ajaxData){
                $("#detail_cart").load("pages/transaksi_masuk/detail_cart.php");
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
                            <h4>Tambah Data Logistik Masuk</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="index.php?pages=logistik_masuk">Data Logistik Masuk</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Tambah Data Logistik Masuk</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Form grid Start -->
                <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
                    <form name="add-transaksi-masuk" method="POST" action="pages/transaksi_masuk/input-act.php">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <?php
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
                                ?>    
                            </div>
                            
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input type="date" class="form-control" name="tgl_regist" placeholder="Pilih Tanggal" required="">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Supplier</label>
                                    <select name="id_supplier" class="form-control custom-select2" style="width: 100%" required="">
                                        <option value="">--Pilih--</option>
                                        <?php
                                        $query_supplier = $connect->query("SELECT id_supplier,nm_supplier FROM supplier");
                                        foreach($query_supplier as $supplier){
                                        ?>
                                        <option value="<?php echo $supplier['id_supplier'] ?>"><?php echo $supplier['nm_supplier']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="Pimpinan">Pimpinan</label>
                                    <select name="id_pegawai_pimpinan" id="" class="form-control custom-select2" style="width:100%">
                                        <option value="">Pilih</option>
                                        <?php 
                                        $query_pimpinan = $connect->query("SELECT id_pegawai,nama FROM pegawai WHERE jabatan='pimpinan' AND status='Aktif'");
                                        foreach($query_pimpinan as $pimpinan){
                                            echo "<option value='".$pimpinan['id_pegawai']."'>".$pimpinan['nama']."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Penanggung Jawab</label>
                                    <select name="id_pegawai_pen_jawab" class="form-control custom-select2" style="width: 100%" required="">
                                        <option value="">--Pilih--</option>
                                        <?php
                                        $query_pegawai = $connect->query("SELECT id_pegawai,nama FROM pegawai WHERE jabatan='Penanggung Jawab' AND status='Aktif'");
                                        foreach($query_pegawai as $pegawai){
                                        ?>
                                        <option value="<?php echo $pegawai['id_pegawai'] ?>"><?php echo $pegawai['nama']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <hr>
                                <small class="form-text text-muted">** input Data Logistik</small>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Kategori</label>
                                    <select name="id_kat_logistik" id="id_kat_logistik" class="form-control custom-select2" style="width: 100%" required="">
                                        <option value="">--Pilih--</option>
                                        <?php
                                        $query_kat_logistik = $connect->query("SELECT * FROM kat_logistik");
                                        foreach($query_kat_logistik as $kat){
                                        ?>
                                        <option value="<?php echo $kat['id_kat_logistik'] ?>"><?php echo $kat['nm_kat_logistik']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Nama Logistik</label>
                                    <select name="id_logistik" id="id_logistik" class="form-control custom-select2" style="width: 100%" required="">
                                        <option value="">--Pilih--</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Harga</label>
                                    <div id="divAjaxData"> <!-- Digunakan Untuk Menampung Hasil Inputan -->
                                    <input type="text" name="harga" value="" class="form-control" readonly="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-5 col-sm-12">
                                <div class="form-group">
                                    <label>Qty</label>
                                    <input type="text" name="qty" id="qty" class="form-control" value="">
                                </div>
                            </div>
                            <div class="col-md-1 col-sm-12">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <button type="button" class="btn btn-xs btn-outline-primary form-control" onclick="addCart()"><i class="icon-copy fa fa-plus-square" aria-hidden="true"></i></button>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <hr>
                                <table class="table strip hover nowrap">
                                    <thead>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>Harga</th>
                                        <th>Qty</th>
                                        <th>Subtotal</th>
                                        <th>Aksi</th>
                                    </thead>
                                    <tbody id="detail_cart" onload="load_cart()">
                                        
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <center>
                                        <input type="submit" name="simpan" value="Simpan" class="btn btn-primary btn-xs" onclick="return confirm('Anda Yakin Sudah Mengisi Data Dengan Benar ?')">    
                                    </center>
                                    
                                </div>
                            </div>
                        </div>
                        
                    </form>
                </div>
                <!-- Form grid End -->
        </div>
        
        <?php include('include/footer.php'); ?>
    </div>
</div>
