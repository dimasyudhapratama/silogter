<?php
include '../../config/koneksi.php';
$id_logistik = $_POST['id_logistik'];
$query = $connect->query("SELECT harga_satuan,stok FROM logistik WHERE id_logistik='$id_logistik'");
foreach($query as $data){
?>
    <input type="text" name="harga" value="<?php echo number_format($data['harga_satuan'],2,',','.') ?>" class="form-control" readonly="">
    <input type="hidden" name="real_stok" id="real_stok" value="<?php echo $data['stok'] ?>">
<?php } ?>