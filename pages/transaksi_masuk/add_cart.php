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
	//Cek Sisa Stok
	$query = $connect->prepare("SELECT stok FROM logistik WHERE id_logistik='$id'");
	$query->execute();
	foreach($query as $data){
		$stok_db = $data['stok'];
		$qty_cart_new = $cart[$index]->qty+$qty;
		if($qty_cart_new>$stok_db){
			
		}else {	
			if($index==-1){
				$_SESSION['cart_masuk'][] = $item; //Make New Session Cart Masuk Dengan Isi dari Object item
			}else{
				
				//Tambahkan Qty pada Id Yang Sama
				$cart[$index]->qty+=$qty;
				$_SESSION['cart_masuk'] = $cart;	
			}

		}
	}
	
?>