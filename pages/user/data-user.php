<?php

       
    
    if(isset($_POST['edit'])){
        $id = $_POST['id'];
         $username = $_POST['username'];
         $password = $_POST['password'];
         $level = $_POST['level'];
        // $nm_kat_logistik = $_POST['nm_kat_logistik'];
        $query_edit = $connect->exec("UPDATE user SET username='$username', password='$password', level='$level' WHERE id_user='$id'");
        if($query_edit){
            echo "<script>window.location.href='?pages=user&edit_stat=true'</script>";
        }else{
            echo "<script>window.location.href='?pages=user&edit_stat=false'</script>";
        }
    }
?>
<script src="src/jquery.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".click-edit").click(function(e) {
            var m = $(this).attr("id");
            $.ajax({
                url: "pages/user/edit-user.php",
                type: "POST",
                data : {id: m,},
                success: function (ajaxData){
                    $("#data-edit").html(ajaxData);
                }
            });
        });
    });
</script>
<div class="main-container">
    <div class="pd-ltr-20 customscroll customscroll-10-p height-100-p xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>User</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">User</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Simple Datatable start -->
            <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
                <div class="row">
                   <div class="col-md-12">
                        <?php
                       
                        if(isset($_GET['edit_stat'])){
                            if($_GET['edit_stat']==true) {
                                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>Data Berhasil Diubah
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button></div>";
                            }else if($_GET['edit_stat']==false){
                                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Data Gagal Diubah
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button></div>";
                            }
                        }
                        ?>
                    </div>
                    <table class="data-table stripe hover nowrap">
                        <thead>
                        <tr>
                            <th class="table-plus datatable-nosort">No.</th>
                            <th class="table-plus datatable-nosort">Username</th>
                            <th class="table-plus datatable-nosort">Level</th>
                            <th class="table-plus datatable-nosort">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $no = 1;
                        $query = $connect->query("SELECT * FROM user");
                        foreach($query as $data){
                        ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $data['username'] ?></td>
                            <td><?php echo $data['level']; ?></td>
                            
                            
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-sm btn-outline-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                        Pilih
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item click-edit" id="<?php echo $data['id_user'] ?>" href="#" data-toggle="modal" data-target="#modaledit"><i class="fa fa-pencil"></i> Edit</a>
                                        <a class="dropdown-item" href="?pages=user&delete=<?php echo $data['id_user'] ?>"><i class="fa fa-trash"></i> Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php include('include/footer.php'); ?>
    </div>
</div>

<div class="modal fade" id="modaledit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" name="edit-user" action="?pages=user&editdata">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Edit Data User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                </div>
                <div class="modal-body" id="data-edit">
                    
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-dark">Reset</button>
                    <button type="submit" name="edit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
