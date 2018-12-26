<?php
include '../../config/koneksi.php';
$id = $_POST['id'];
$query = $connect->query("SELECT * FROM supplier WHERE id_supplier='$id'");
foreach ($query as $data) {
?>
<div class="form-group">
    <div class="row">
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <div class="col-md-6 col-sm-12">
            <div class="form-group">
                <label>Nama Supplier</label>
                <input type="text" name="nm_supplier" class="form-control" required="" value="<?php echo $data['nm_supplier'] ?>">
            </div>
            <div class="form-group">
                <label>Email Supplier</label>
                <input type="email" name="email_supplier" class="form-control" required="" value="<?php echo $data['email_supplier'] ?>">
            </div>
            
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="form-group ">
                <label>CP Supplier</label>
                <input type="number" name="cp_supplier" class="form-control" required="" value="<?php echo $data['cp_supplier'] ?>">
            </div>
            
            <div class="form-group">
                <label>Alamat Supplier</label>
                <textarea class="form-control" name="alamat_supplier" required=""><?php echo $data['alamat_supplier']; ?></textarea>
            </div>
        </div>
    </div>
</div>
<?php } ?>