<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <?php include('include/head.php'); ?>
    <link rel="stylesheet" type="text/css" href="src/plugins/datatables/media/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="src/plugins/datatables/media/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="src/plugins/datatables/media/css/responsive.dataTables.css">
</head>
<body>
<?php
include 'config/koneksi.php';
include('include/header.php');
include('include/sidebar.php');
if($_GET['pages']=='pegawai') {
    include 'pages/pegawai/data-pegawai.php';
}else if($_GET['pages']=='user'){
    include 'pages/user/data-user.php';
}else if($_GET['pages']=='supplier'){
    include 'pages/supplier/data-supplier.php';
}else if($_GET['pages']=='anggaran'){
    include 'pages/anggaran/data-anggaran.php';
}else if($_GET['pages']=='kategori_logistik'){
    include 'pages/kategori_logistik/data_kategori_logistik.php';
}else if($_GET['pages']=='instansi_penerima') {
    include 'pages/instansi_penerima/data_instansi_penerima.php';

}

?>
<?php include('include/script.php'); ?>
<script src="src/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="src/plugins/datatables/media/js/dataTables.bootstrap4.js"></script>
<script src="src/plugins/datatables/media/js/dataTables.responsive.js"></script>
<script src="src/plugins/datatables/media/js/responsive.bootstrap4.js"></script>
<!-- buttons for Export datatable -->
<script src="src/plugins/datatables/media/js/button/dataTables.buttons.js"></script>
<script src="src/plugins/datatables/media/js/button/buttons.bootstrap4.js"></script>
<script src="src/plugins/datatables/media/js/button/buttons.print.js"></script>
<script src="src/plugins/datatables/media/js/button/buttons.html5.js"></script>
<script src="src/plugins/datatables/media/js/button/buttons.flash.js"></script>
<script src="src/plugins/datatables/media/js/button/pdfmake.min.js"></script>
<script src="src/plugins/datatables/media/js/button/vfs_fonts.js"></script>
<script>
    $('document').ready(function(){
        $('.data-table').DataTable({
            scrollCollapse: true,
            autoWidth: false,
            responsive: true,
            columnDefs: [{
                targets: "datatable-nosort",
                orderable: false,
            }],
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "language": {
                "info": "_START_-_END_ of _TOTAL_ entries",
                searchPlaceholder: "Search"
            },
        });
        $('.data-table-export').DataTable({
            scrollCollapse: true,
            autoWidth: false,
            responsive: true,
            columnDefs: [{
                targets: "datatable-nosort",
                orderable: false,
            }],
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "language": {
                "info": "_START_-_END_ of _TOTAL_ entries",
                searchPlaceholder: "Search"
            },
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'pdf', 'print'
            ]
        });
        var table = $('.select-row').DataTable();
        $('.select-row tbody').on('click', 'tr', function () {
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        });
        var multipletable = $('.multiple-select-row').DataTable();
        $('.multiple-select-row tbody').on('click', 'tr', function () {
            $(this).toggleClass('selected');
        });
    });
</script>
</body>
</html>