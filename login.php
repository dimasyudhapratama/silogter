<?php
session_start();
include 'config/koneksi.php';
if(isset($_POST['Submit'])){
	$username = $_POST['usernamez'];
	$password = $_POST['passwordz'];
	$query = $connect->prepare("SELECT id_pegawai,password,level FROM user WHERE username='$username' AND status='Aktif'");
	$query->execute();
	if($query->rowCount()==1){
		$_SESSION['user_username'] = $username;
		foreach($query as $data){
			if(password_verify($password,$data['password'])){
				$_SESSION['user_id_pegawai'] = $data['id_pegawai'];
				$_SESSION['user_level'] = $data['level'];
				echo "<script>window.location.href='index.php'</script>";
			}else{
				header("location:login.php?errorlogin");
			}
		}
	}
	if($query->rowCount()==0){
		// echo "<script>window.location.href='loginz.php?error</script>";	
		header("location:login.php?errorlogin");
	}
	
}
?>
<!DOCTYPE html>
<html>
<head>
	<?php include('include/head.php'); ?>
</head>
<body style="font-family: 'Open Sans', sans-serif;">
	<div class="login-wrap customscroll d-flex align-items-center flex-wrap justify-content-center pd-20">
		<div class="login-box bg-white box-shadow pd-30 border-radius-5">
			<img src="vendors/images/silogter-logo.png" alt="login">
			<hr>
			<h2 class="text-center mb-30 text-muted">Login</h2>
			<?php
			if(isset($_GET['loginFirst'])){
				echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Silahkan Login Terlebih Dahulu<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span>
                                </button></div>";
			}else if(isset($_GET['logout'])){
				echo "<div class='alert alert-primary alert-dismissible fade show' role='alert'>Logout Berhasil<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span>
                                </button></div>";
			}else if(isset($_GET['errorlogin'])){
				echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Username Dan Password Tidak Sesuai<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span>
                                </button></div>";
			}
			?>
			<form method="POST" action="">
				<div class="input-group custom input-group-lg">
					<input type="text" name="usernamez" class="form-control" placeholder="Username">
					<div class="input-group-append custom">
						<span class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></span>
					</div>
				</div>
				<div class="input-group custom input-group-lg">
					<input type="password" name="passwordz" class="form-control" placeholder="**********">
					<div class="input-group-append custom">
						<span class="input-group-text"><i class="fa fa-lock" aria-hidden="true"></i></span>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-3 col-md-3"></div>
					<div class="col-lg-6 col-md-6">
						<button name="Submit" type="submit" class="btn btn-outline-primary btn-lg btn-block">Sign In</button>
					</div>
					<div class="col-lg-3 col-md-3"></div>
				</div>
			</form>
		</div>
	</div>
	<?php include('include/script.php'); ?>
</body>
</html>