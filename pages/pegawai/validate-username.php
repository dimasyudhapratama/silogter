<?php
include "../../config/koneksi.php";
$username = $_POST['username'];

$query = $connect->prepare("SELECT id_user FROM user WHERE username='$username'");
$query->execute();
if($query->rowCount()!=0){
	echo "Username Sudah Digunakan";
}else{
	echo "";
}
?>