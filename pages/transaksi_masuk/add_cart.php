<?php
session_start();
include "../../config/koneksi.php";
include "item.php";

$id = $_POST['id'];
$harga = $_POST['harga'];
$qty = $_POST['qty'];
$id_anggaran = $_POST['id_anggaran'];
$exp_date = $_POST['exp_date'];

$query = $connect->prepare("SELECT asal_anggaran FROM anggaran WHERE id_anggaran='$id_anggaran'");
$query->execute();
foreach($query as $data){
	$asal_anggaran = $data['asal_anggaran'];
}

//Membuat Objek Item
$item = new Item();
$item->id = $id;
$item->harga = $harga;
$item->qty = $qty;
$item->id_anggaran = $id_anggaran;
$item->asal_anggaran = $asal_anggaran;
$item->exp_date = $exp_date;
//Cek Apakah Produk Sudah Ada dalam Session Cart Masuk
$index = -1;
$cart = unserialize(serialize($_SESSION['cart_masuk']));
for($i=0;$i<count($cart);$i++)
	if($cart[$i]->id==$id && $cart[$i]->harga==$harga && $cart[$i]->id_anggaran==$id_anggaran && $cart[$i]->exp_date==$exp_date){
		$index = $i;
		break;
	}
	
	if($index==-1){
		$_SESSION['cart_masuk'][] = $item; //Make New Session Cart Masuk Dengan Isi dari Object item
	}else{
		//Tambahkan Qty pada Id Yang Sama
		$cart[$index]->qty+=$qty;
		$_SESSION['cart_masuk'] = $cart;	
	}
	
?>