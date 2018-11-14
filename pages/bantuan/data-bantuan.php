<div class="main-container">
	<div class="pd-ltr-20 customscroll customscroll-10-p height-100-p xs-pd-20-10">
		<div class="min-height-200px">
			<div class="pd-10 bg-white rounded box-shadow mb-30">
				<div class="row">
					<div class="col-md-6 col-sm-12">
						<div class="title">
							<h4>Bantuan</h4>
						</div>
						<nav aria-label="breadcrumb" role="navigation">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.php">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Bantuan</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
			<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
				

				<div class="blog-caption">
					<p>Hal-hal yang mungkin sedikit rumit terkait dengan penggunaan Sistem Informasi Logistik Terpadu(Silogter), Sudah kami siapkan dalam fitur Bantuan/FAQ</p>
					<hr style="border:1px dashed gray;">
					<?php
					$no = 1;
					$query = $connect->prepare("SELECT pertanyaan,jawaban FROM bantuan");
					$query->execute();
					foreach($query as $data){
					?>
					<h5 class="mb-10 "><?php echo $no++.". ".$data['pertanyaan']; ?></h5>	
					<p class="ml-3"><?php echo $data['jawaban']; ?></p>
					<?php } ?>
				</div>
			</div>
		</div>
		<?php include('include/footer.php'); ?>
	</div>
</div>
