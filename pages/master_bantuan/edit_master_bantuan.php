<?php
include '../../config/koneksi.php';
$id=$_POST['id']; 
$query=$connect->query("SELECT * FROM bantuan WHERE id_bantuan='$id'");
foreach ($query as $data) {
?> 
<input type="hidden" name="id" value="<?php echo $id; ?>">
<div class="form-group">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Pertanyaan</label>
                                    <input type="text" name="pertanyaan" class="form-control" required="" value="<?php echo $data['pertanyaan'] ?>">
                                </div>
                               
                                <div class="form-group">
                                    <label>Jawaban</label>
                                    <input type="text" name="jawaban" class="form-control" required="" value="<?php echo $data['jawaban']?>">
                                </div>
                                
                            </div>
                            </div>
                        </div>
                    </div>
<?php } ?>