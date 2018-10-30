<?php
session_start();
include 'item.php';
include '../../config/koneksi.php';
if (isset($_POST['simpan'])) {
	$tgl_regist = $_POST['tgl_regist'];
	$id_supplier = $_POST['id_supplier'];
	$id_pegawai = $_POST['id_pegawai'];

	$tabel = "trx_logistik_masuk";
	$kolom = "no_regist_masuk";
	$awalan = "BM";
	//Membuat ID Inputan
	$tgl = substr($tgl_regist,8,2);
	$bulan = substr($tgl_regist, 5,2);
	$tahun = substr($tgl_regist,0,4);
	$id = $awalan."/1/".$tgl.$bulan.$tahun;

	$query = $connect->query("SELECT $kolom FROM $tabel WHERE $kolom='$id' ORDER BY $kolom DESC LIMIT 1");
	$jml_row = $query->rowCount();
	if($jml_row==0){
		$id = $awalan."/1/".$tgl.$bulan.$tahun;
	}else{
		// $query = $connect->query("SELECT no_regist_masuk FROM trx_logistik_masuk WHERE substring(no_regist_masuk from 6 for 8)='26102018' ORDER BY no_regist_masuk DESC LIMIT 1");
		$query = $connect->query("SELECT no_regist_masuk FROM trx_logistik_masuk WHERE tgl_regist='$tgl_regist' ORDER BY no_regist_masuk DESC LIMIT 1");
		foreach ($query as $data) {
			$no = intval(substr($data[0], strlen($awalan."/")))+1;
		}
		$id = $awalan."/".$no."/".$tgl.$bulan.$tahun;
	}

	
	//Query Tabel Transaksi Masuk
	$query_transaksi_masuk = $connect->prepare("INSERT INTO trx_logistik_masuk VALUES ('$id','$tgl_regist','$id_supplier','$id_pegawai','0','0')");
	$query_transaksi_masuk->execute();

	//Load Data Cart -> Insert Ke Tabel Detail Transaksi Masuk & Mengurangi Stok Di Tabel Logistik
	$cart = unserialize(serialize($_SESSION['cart_masuk']));
	$grand_total = 0;
    for($i=0;$i<count($cart);$i++){
    	//Load Data Cart -> Insert Ke Tabel Detail Transaksi Masuk
        $id_logistik = $cart[$i]->id; //Id Logistik
        $query = $connect->query("SELECT nm_logistik,harga_satuan,stok FROM logistik WHERE id_logistik='$id_logistik'");
        foreach($query as $data){
            $harga = $data['harga_satuan'];
            $stok = $data['stok'];
            $grand_total += $harga * $cart[$i]->qty;
        }
        $qty = $cart[$i]->qty; // Qty
        $subtotal = $harga*$qty;
        $query2 = $connect->prepare("INSERT INTO trx_detail_logistik_masuk VALUES ('','$id','$id_logistik','$harga','$qty','$subtotal')");
        $query2->execute();
        //Mengurangi Stok Di Tabel Logistik
        $new_stok = $stok-$qty;
        $query3= $connect->prepare("UPDATE logistik SET stok='$new_stok' WHERE id_logistik='$id_logistik'");
        $query3->execute();

    }
    //Truncate Cart
    $array_last = count($cart)-1;
	for($i=$array_last;$i>=0;$i--){
		unset($cart[$i]);
	}
	$cart = array_values($cart);
	$_SESSION['cart_masuk'] = $cart;
    //Update Grand Total 
    $update_gt = $connect->prepare("UPDATE trx_logistik_masuk SET grand_total='$grand_total' WHERE no_regist_masuk='$id'");
    $update_gt->execute();
    if($query_transaksi_masuk==TRUE || $query2==TRUE || $query3==TRUE){
    	echo "<script>window.location.href='../../index.php?pages=tambah_transaksi_masuk&add_stat=true'</script>";
    }else{
    	echo "<script>window.location.href='../../index.php?pages=tambah_transaksi_masuk&add_stat=false'</script>";
    }
    

}

?>