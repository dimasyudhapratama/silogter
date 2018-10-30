<?php
$id_kat_logistik = $_POST['id_kat_logistik'];
include '../../config/koneksi.php';
$query = $connect->query("SELECT * FROM logistik WHERE id_kat_logistik='$id_kat_logistik'");
echo "<option value=''>--Pilih--</option>";
foreach($query as $data){
?>
<option value="<?php echo $data['id_logistik'] ?>"><?php echo $data['nm_logistik']; ?></option>
<?php } ?>