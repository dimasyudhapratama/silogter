<?php
if($_POST['filter_by']=="date"){
?>
<div class="col-md-12 col-sm-12">
    <div class="form-group">
        <label>Tanggal</label>
        <input type="date" name="tgl" class="form-control" required="">
    </div>
 </div>
 <?php }else if($_POST['filter_by']=="month"){ ?>
<div class="col-md-12 col-sm-12">
   <div class="form-group">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                 <div class="form-group">
                     <label>Bulan</label>
                     <select name="bulan" class="form-control" required="">
                         <option value="01">Januari</option>
                         <option value="02">Februari</option>
                         <option value="03">Maret</option>
                         <option value="04">April</option>
                         <option value="05">Mei</option>
                         <option value="06">Juni</option>
                         <option value="07">Juli</option>
                         <option value="08">Agustus</option>
                         <option value="09">September</option>
                         <option value="10">Oktober</option>
                         <option value="11">November</option>
                         <option value="12">Desember</option>
                     </select>
                 </div>
             </div>
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label>Tahun</label>
                    <select name="btahun" class="form-control" required="">
                     <?php 
                     for($i=2018;$i>=2010;$i--){
                        echo "<option value='".$i."'>".$i."</option>";
                     }
                     ?>
                    </select>
                </div>
            </div>
        </div>
    </div> 
</div>
 
 
<?php }else if($_POST['filter_by']=="year"){ ?>
<div class="col-md-12 col-sm-12">
    <div class="form-group">
        <label>Tahun</label>
        <select name="tahun" class="form-control" required="">
         <?php 
         for($i=2018;$i>=2010;$i--){
            echo "<option value='".$i."'>".$i."</option>";
         }
         ?>
        </select>
    </div>
</div>
<?php }else if($_POST['filter_by']=="custom"){ ?>
<div class="col-md-12 col-sm-12">
   <div class="form-group">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label>Tanggal Awal</label>
                    <input type="date" name="tgl_awal" class="form-control" required="">
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                <label>Tanggal Akhir</label>
                <input type="date" name="tgl_akhir" class="form-control" required="">
            </div>
            </div>
        </div>
    </div> 
</div>
 <?php } ?>