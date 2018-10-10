<?php
	include '../../config/koneksi.php';
	$id = $_POST['id'];
	$query = $connect->query("SELECT nm_kat_logistik FROM kat_logistik WHERE id_kat_logistik='$id'");
	foreach($query as $data){
?>
<input type="hidden" name="id" value="<?php echo $id ?>">
<div class="form-group col-md-6">
    <label>Nama Kategori logistik</label>
    <input type="text" name="nm_kat_logistik" class="form-control" value="<?php echo $data['nm_kat_logistik'] ?>">
</div>
<?php } ?>