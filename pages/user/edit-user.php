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
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" value="<?php echo $temp['password'];?>" required="">
                </div>
                <div class="form-group ">
                    <label>Level</label>
                    <select class="form-control" name="level">
                        <option value="disabled">--Pilih--</option>
                        <option value="Admin" <?php if($temp['level']=='admin'){echo "Selected";} ?>>Admin</option>
                        <option value="Pimpinan" <?php if ($temp['level']=='pimpinan') {echo"Selected";} ?>>Pimpinan</option>
                        <option value="Operator" <?php if ($temp['level']=='operator') {echo"Selected";} ?>>Operator</option>
                    </select>
                </div>
                <div class="form-group ">
                    <label>Status</label>
                    <select class="form-control" name="status">
                        <option value="disabled">--Pilih--</option>
                        <option value="Aktif" <?php if ($temp['status']=='Aktif') {echo"Selected";} ?>>Aktif</option>
                        <option value="Non Aktif" <?php if($temp['status']=='Non Aktif'){echo "Selected";} ?>>Non Aktif</option>

                    </select>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label>Password</label>
                    <input type="text" name="password" class="form-control" value="<?php echo $temp['password'];?>" required="">
                </div>
            </div>
        </div>
    </div>
    <?php } ?>