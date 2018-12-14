<?php
    if(isset($_POST['filter'])){
        echo "<script>window.location.href='?pages=laporan&filter_by=".$_POST['filter_by']."'</script>";
    }
?>
<div class="main-container">
	<div class="pd-ltr-20 customscroll customscroll-10-p height-100-p xs-pd-20-10">
		<div class="min-height-200px">
			<div class="page-header">
				<div class="row">
					<div class="col-md-6 col-sm-12">
						<div class="title">
							<h4>Laporan Stok</h4>
						</div>
						<nav aria-label="breadcrumb" role="navigation">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.php">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Laporan Stok</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
            <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
                <div class="row">
                    <button style="margin-left:10px;margin-bottom: 10px;" class="btn btn-success btn-sm" data-target="#modalfilter" data-toggle="modal"><i class="fa fa-filter"></i> Filter</button>
                     <a href="javascript:void(0);" onclick="window.open('print-pdf-pages/print-data-logistik.php?<?php if(isset($_GET['filter_by'])){echo "filter_by=".$_GET['filter_by'] ;} ?>','Print','width=1366,height=800,scrollbars=yes,resizeable=no')" style="margin-left: 10px;margin-bottom: 10px;" class="btn btn-warning btn-sm"><i class="fa fa-print"></i> Cetak</a>
                    <div class="col-md-12"></div> <!-- Cuman Buat Batas -->
                    <table class="data-table table-bordered stripe hover nowrap">
                        <thead>
                        <tr>
                            <th class="table-plus td-center">No.</th>
                            <th class="table-plus td-center">Kategori Logistik</th>
                            <th class="table-plus td-center">Nama Logistik</th>
                            <th class="table-plus datatable-nosort td-center">Batas Stok</th>
                            <th class="table-plus datatable-nosort td-center">Real Stok</th>
                            <th class="table-plus datatable-nosort td-center">Asal Anggaran</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $no = 1;
                        if(isset($_GET['filter_by'])){
                            if($_GET['filter_by']=="1"){
                                $query = $connect->query("SELECT * FROM logistik JOIN kat_logistik ON logistik.id_kat_logistik=kat_logistik.id_kat_logistik JOIN anggaran ON logistik.id_anggaran=anggaran.id_anggaran");    
                            }else if($_GET['filter_by']=="2"){
                                $query = $connect->query("SELECT * FROM logistik JOIN kat_logistik ON logistik.id_kat_logistik=kat_logistik.id_kat_logistik JOIN anggaran ON logistik.id_anggaran=anggaran.id_anggaran WHERE minimal_stok>=stok");
                            }
                        }else{
                            $query = $connect->query("SELECT * FROM logistik JOIN kat_logistik ON logistik.id_kat_logistik=kat_logistik.id_kat_logistik JOIN anggaran ON logistik.id_anggaran=anggaran.id_anggaran");
                        }
                        
                        foreach($query as $data){
                        ?>
                        <tr>
                            <td class="td-center"><?php echo $no++ ?></td>
                            <td class="td-center"><?php echo $data['nm_kat_logistik']; ?></td>
                            <td class="td-center"><?php echo $data['nm_logistik']; ?></td>
                            <td class="td-center"><?php echo $data['minimal_stok']; ?></td>
                            <td class="td-center"><?php echo $data['stok']; ?></td>
                            <td class="td-center"><?php echo $data['asal_anggaran']; ?></td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
		</div>
		<?php include('include/footer.php'); ?>
	</div>
</div>
<div class="modal fade" id="modalfilter" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" name="filter-logistik" action="?pages=laporan&filterkeyword">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Filter</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-5 col-sm-12">
                                <div class="form-group">
                                    <label>Filter Berdasarkan</label>
                                    <select name="filter_by" id="filter_by" class="form-control" required="">
                                        <option value="1">Semua Stok Barang</option>
                                        <option value="2">Minimal Stok</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-7 col-sm-12 filter-data">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="filter" class="btn btn-primary">Filter</button>
                </div>
            </form>
        </div>
    </div>
</div>
