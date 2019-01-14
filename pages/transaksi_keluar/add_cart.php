<?php
session_start();
error_reporting(0);
include "../../config/koneksi.php";
include "item.php";
function addToCart($id_detail_logistik,$id_logistik,$harga_satuan,$detail,$id_anggaran,$exp_date){
	$item = new Item();
    $item->id_detail_logistik = $id_detail_logistik;
	$item->id_logistik = $id_logistik;
	$item->harga_satuan = $harga_satuan;
	$item->detail_qty_ambil = $detail;
	$item->id_anggaran = $id_anggaran;
	$item->exp_date = $exp_date;
    
    $index = -1;
    $cart = unserialize(serialize($_SESSION['cart_keluar']));

    $_SESSION['cart_keluar'][] = $item;
    
    // if($index==-1){
    //     $_SESSION['cart_keluar'][] = $item;
    // }else{
    //     $_SESSION['cart_keluar'] = $cart;
    // }
}

$id_logistik = $_POST['id_logistik'];
$qty = $_POST['qty'];

//Mengecek Apakah Ada Detail Logistik Di Cart, Jika Ada Cari Total Stok
$cart = unserialize(serialize($_SESSION['cart_keluar']));
$stok_cart=0;
if(count($cart)>0){ //Jika Cart Memiliki Isi Maka dilakukan Looping
    for($i=count($cart)-1;$i>=0;$i--){ //Looping Mulai Index Terbesar (Jumlah-1)
        if($cart[$i]->id_logistik==$id_logistik){ //Jika Id_logistik Sama
            $stok_cart+=$cart[$i]->detail_qty_ambil; //Tambahkan Data
        }
	}
	if($stok_cart>0){
		$qty+=$stok_cart;
	}
}
//Mendapatkan Jumlah Stok Sekarang Di Database
$query_logistik = $connect->query("SELECT stok FROM logistik WHERE id_logistik='$id_logistik'");
foreach($query_logistik as $data_logistik){
	$stok_db = $data_logistik['stok'];
}
if($stok_db>=$qty){
	//Delete Cart
	if(count($cart)>0){ //Jika Cart Memiliki Isi Maka dilakukan Looping
		for($i=count($cart)-1;$i>=0;$i--){ //Looping Mulai Index Terbesar (Jumlah-1)
			if($cart[$i]->id_logistik==$id_logistik){ //Jika Id_logistik Sama
				unset($cart[$i]); //Unset
			}
		}
		$cart = array_values($cart);
		$_SESSION['cart_keluar'] = $cart;
	}
	//Loop Logistik->Cart
	$query = $connect->query("SELECT * FROM detail_logistik JOIN logistik ON detail_logistik.id_logistik=logistik.id_logistik WHERE detail_logistik.id_logistik='$id_logistik' AND detail_logistik.jml_detail_stok<>0 ORDER BY tgl_masuk,exp_date,id_detail_logistik");
	foreach($query as $data){
		$id_detail_logistik = $data['id_detail_logistik'];
		$harga_satuan = $data['harga_satuan'];
		$id_anggaran = $data['id_anggaran'];
		$exp_date = $data['exp_date'];
		$qty = $qty-$data['jml_detail_stok']; 
		if($qty>0){ //Jika Masih Kurang, Maka Bawa Semua Stok Yang Ada, dan Ambil Di Bawahnya
			$detail =  $data['jml_detail_stok'];
			addToCart($id_detail_logistik,$id_logistik,$harga_satuan,$detail,$id_anggaran,$exp_date);
		}else if($qty==0){ //Jika Logistik Terpenuhi, Bawa Stok Yang Ada Dan Break
			$detail =  $data['jml_detail_stok'];
			addToCart($id_detail_logistik,$id_logistik,$harga_satuan,$detail,$id_anggaran,$exp_date);
			break;
		}else if($qty<0){//Jika Logistik Kurang Maka Jumlah Stok
			$detail =  $data['jml_detail_stok']+$qty;
			addToCart($id_detail_logistik,$id_logistik,$harga_satuan,$detail,$id_anggaran,$exp_date);
			break;
		}      
	}
}else{
	echo "Gagal";
}
	
?>