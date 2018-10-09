<?php
include '../../config/koneksi.php';
$id = $_POST['id'];
$query = $connect->query("SELECT * FROM anggaran WHERE id_anggaran='$id'");
foreach($query as $data){
?>
<input type="hidden" name="id" value="<?php echo $id ?>">
<div class="form-group col-md-6">
    <label>Asal Anggaran</label>
    <input type="text" name="asal_anggaran" class="form-control" value="<?php echo $data['asal_anggaran'] ?>">
</div>
<?php } ?>