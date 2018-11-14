<div class="main-container">
	<div class="pd-ltr-20 customscroll customscroll-10-p height-100-p xs-pd-20-10">
		<div class="min-height-200px">
			<div class="page-header">
				<div class="row">
					<div class="col-md-6 col-sm-12">
						<div class="title">
							<h4>Laporan</h4>
						</div>
						<nav aria-label="breadcrumb" role="navigation">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.php">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Laporan</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
			<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
                <div class="row">
                    <h4 class="mb-30 weight-500s" style="padding-left: 10px;">Stok Minimum</h4>
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
                        $query = $connect->query("SELECT * FROM logistik JOIN kat_logistik ON logistik.id_kat_logistik=kat_logistik.id_kat_logistik JOIN anggaran ON logistik.id_anggaran=anggaran.id_anggaran WHERE minimal_stok>=stok");
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
