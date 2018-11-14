<?php
session_start();
include "../../config/koneksi.php";
include "item.php";

$id = $_POST['id'];
$qty = $_POST['qty'];

//Membuat Objek Item
$item = new Item();
$item->id = $id;
$item->qty = $qty;
//Cek Apakah Produk Sudah Ada dalam Session Cart Masuk
$index = -1;
$cart = unserialize(serialize($_SESSION['cart_masuk']));
for($i=0;$i<count($cart);$i++)
	if($cart[$i]->id==$id){
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