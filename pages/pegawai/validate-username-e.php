<?php
include "../../config/koneksi.php";
$username = $_POST['username'];
$username_saved = $_POST['username_saved'];
if($username==$username_saved){ //Jika Username Sama dengan yang tersimpan di database maka tidak apa-apa
	echo "";
}else{ //Jika Tidak Sama akan dilakukan pengecekan
	$query = $connect->prepare("SELECT id_user FROM user WHERE username='$username'");
	$query->execute();
	if($query->rowCount()!=0){
		echo "Username Sudah Digunakan";
	}else{
		echo "";
	}
}

?>