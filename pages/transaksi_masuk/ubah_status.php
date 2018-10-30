<?php
    include '../../config/koneksi.php';
    $id = $_POST['id'];
    $query = $connect->prepare("SELECT status FROM trx_logistik_masuk WHERE no_regist_masuk='$id'");
    $query->execute();
    foreach ($query as $data) {
?>
<input type="hidden" name="id" value="<?php echo $id ?>">
<div class="form-group">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="form-group">
                <label>Status</label>
                <select name="change_stat" class="form-control" required="">
                    <option value="0" <?php if($data['status']==0){echo "Selected";} ?>>Proses</option>
                    <option value="1" <?php if($data['status']==1){echo "Selected";} ?>>Selesai</option>
                    <option value="2" <?php if($data['status']==2){echo "Selected";} ?>>Batal</option>
                </select>
            </div>
        </div>
    </div>
</div>
<?php } ?>