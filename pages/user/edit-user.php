<?php 
$id= $_POST['id'];
include "../../config/koneksi.php";

$query=$connect->query(	"SELECT * FROM user WHERE id_user='$id'");
foreach ($query as $temp) {

?>
<input type="hidden" name="id" value="<?php echo $id; ?>">
<div class="form-group">
    <div class="row">
            <div class="col-md-6 col-sm-12">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $temp['username'];?>" required="">
            </div>
            <div class="form-group ">
                <label>Level</label>
                <select class="form-control" name="level">
                    <option value="">--Pilih--</option>
                    <option value="admin" <?php if($temp['level']=='admin'){echo "Selected";} ?>>Admin</option>
                    <option value="operator" <?php if ($temp['level']=='operator') {echo"Selected";} ?>>Operator</option>
                </select>
            </div>
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="form-group">
                <label>Password</label>
                <input type="text" name="nm_pegawai" class="form-control" value="<?php echo $temp['password'];?>" required="">
            </div>
        </div>
    </div>
</div>
<?php } ?>