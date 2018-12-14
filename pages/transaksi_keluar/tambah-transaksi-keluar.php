<script src="src/jquery.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#detail_cart").load("pages/transaksi_keluar/detail_cart.php");
    });
    $(document).ready(function (){
        $("#id_kat_logistik").change(function(e){
            var id = $(this).val();
            $.ajax({
                url : "pages/transaksi_keluar/getIdLogistik.php",
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
                url : "pages/transaksi_keluar/getDataLogistik.php",
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
            var real_stok = parseInt($("#real_stok").val());
            if(qty > real_stok){
                alert("Real Stok Adalah "+real_stok+". Data Tidak Mencukupi");
            }else{
                $.ajax({
                    url : "pages/transaksi_keluar/add_cart.php",
                    type: "POST",
                    data : {id:id,qty,qty},
                    success : function(ajaxData){
                        $("#detail_cart").load("pages/transaksi_keluar/detail_cart.php");
                    }
                });   
            } 
        }
    }
    function deleteCart(index){
        var id = index;
        $.ajax({
            url : "pages/transaksi_keluar/delete_cart.php",
            type : "POST",
            data : {index:id},
            success : function(ajaxData){
                $("#detail_cart").load("pages/transaksi_keluar/detail_cart.php");
            }
        });
    }
    function FilterInput(event) {
        var txt = String.fromCharCode(event.which);
        var keyCode = ('which' in event) ? event.which : event.keyCode;
        var ascii = [32,48,49,50,51,52,53,54,55,56,57,8,9,11,127,24,25,26,27];
        var t = ascii.indexOf(keyCode);
        if(t==-1){
            return false;
        }
    };
</script>
<div class="main-container">
    <div class="pd-ltr-20 customscroll customscroll-10-p height-100-p xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Tambah Data Logistik Keluar</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="index.php?pages=logistik_keluar">Data Logistik Keluar</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Tambah Data Logistik Keluar</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Form grid Start -->
                <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
                    <form name="add-transaksi-keluar" method="POST" action="pages/transaksi_keluar/input-act.php">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <?php
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
                                    <label>Pimpinan IPFK</label>
                                    <select name="id_pegawai_pimpinan" id="" class="form-control custom-select2" style="width: 100%" required="">
                                        <option value="">--Pilih--</option>
                                        <?php
                                        $query_pimpinan = $connect->query("SELECT id_pegawai,nama FROM pegawai WHERE jabatan='Pimpinan' AND status='Aktif' ORDER BY nama ASC");
                                        foreach($query_pimpinan as $pimpinan){
                                            echo "<option value='".$pimpinan['id_pegawai']."'>".$pimpinan['nama']."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Penanggung Jawab Transaksi</label>
                                    <select name="id_pegawai_pen_jawab" class="form-control custom-select2" style="width: 100%" required="">
                                        <option value="">--Pilih--</option>
                                        <?php
                                        $query_pegawai = $connect->query("SELECT id_pegawai,nama FROM pegawai WHERE jabatan='Penanggung Jawab' AND status='Aktif' ORDER BY nama ASC");
                                        foreach($query_pegawai as $pegawai){
                                        ?>
                                        <option value="<?php echo $pegawai['id_pegawai'] ?>"><?php echo $pegawai['nama']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                   <label>Instansi Penerima</label>
                                    <select name="id_instansi_penerima" class="form-control custom-select2" style="width: 100%" required="">
                                        <option value="">--Pilih--</option>
                                        <?php
                                        $query_instansi_penerima = $connect->query("SELECT id_instansi_penerima,nm_instansi_penerima FROM instansi_penerima ORDER BY nm_instansi_penerima ASC");
                                        foreach($query_instansi_penerima as $ip){
                                        ?>
                                        <option value="<?php echo $ip['id_instansi_penerima'] ?>"><?php echo $ip['nm_instansi_penerima'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Nama Penerima</label>
                                    <input type="text" name="penerima" id="penerima" class="form-control" value="">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>NIP Penerima</label>
                                    <input type="text" name="NIP" id="NIP" class="form-control" value="" onkeydown="return FilterInput(event)">
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
                                        $query_kat_logistik = $connect->query("SELECT * FROM kat_logistik ORDER BY nm_kat_logistik ASC");
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
                            <div class="col-md-1 col-sm-3">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <button type="button" class="btn btn-xs btn-outline-primary form-control" onclick="addCart()"><i class="icon-copy fa fa-plus-square" aria-hidden="true"></i></button>
                                </div>
                            </div>
                            <div class="col-md-8">
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
