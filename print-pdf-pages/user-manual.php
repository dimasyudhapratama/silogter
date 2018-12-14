<?php
session_start();
$nama_dokumen='User Manual';
include '../config/koneksi.php';
include '../vendors/mpdf60/mpdf.php';
$mpdf = new mPDF();

$mpdf->SetImportUse();
if($_SESSION['user_level']=="Admin"){
	$pagecount = $mpdf->SetSourceFile('../docs/admin-user-manual.pdf');
}else if($_SESSION['user_level']=="Operator"){
	$pagecount = $mpdf->SetSourceFile('../docs/operator-user-manual.pdf');
}else if($_SESSION['user_level']=="Pimpinan"){
	$pagecount = $mpdf->SetSourceFile('../docs/pimpinan-user-manual.pdf');
}
for($i=1;$i<=$pagecount;$i++){
	$tplId = $mpdf->ImportPage($i);
	$mpdf->UseTemplate($tplId);
	if($i<$pagecount){
		$mpdf->AddPage();
	}
}

$mpdf->Output();
?>