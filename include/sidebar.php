
<div class="left-side-bar">
		<div class="brand-logo">
			<a href="index.php">
				<img src="vendors/images/silogter-logo.png" alt="">
			</a>
		</div>
		<div class="menu-block customscroll">
			<div class="sidebar-menu">
				<ul id="accordion-menu">
					<li>
						<a href="index.php" class="dropdown-toggle no-arrow">
							<span class="fa fa-home"></span><span class="mtext">Dashboard</span>
						</a>
					</li>
					<?php
					if(isset($_SESSION['user_level'])){
						if($_SESSION['user_level']=="Admin"){
					?>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="fa fa-archive"></span><span class="mtext">Data Master</span>
						</a>
						<ul class="submenu">
							<li><a href="?pages=pegawai">Pegawai</a></li>
							<li><a href="?pages=supplier">Supplier</a></li>
							<li><a href="?pages=instansi_penerima">Instansi Penerima</a></li>
							<li><a href="?pages=anggaran">Asal Anggaran</a></li>
							<li><a href="?pages=kategori_logistik">Kategori Logistik</a></li>
							<li><a href="?pages=logistik">Logistik</a></li>
							<li><a href="?pages=master_bantuan">FAQ/Bantuan</a></li>
						</ul>
					</li>
					<?php
				 	}
				 	if ($_SESSION['user_level']=="Operator" || $_SESSION['user_level']=="Pimpinan" || $_SESSION['user_level']=="Admin") {
				 	?>
                    <li>
                        <a href="?pages=logistik_masuk" class="dropdown-toggle no-arrow">
                            <span class="fa fa-edit"></span><span class="mtext">Logistik Masuk</span>
                        </a>
                    </li>
                    <li>
                        <a href="?pages=logistik_keluar" class="dropdown-toggle no-arrow">
                            <span class="fa fa-edit"></span><span class="mtext">Logistik Keluar</span>
                        </a>
                    </li>
                    <?php
                	}
                	if ($_SESSION['user_level']=="Pimpinan" || $_SESSION['user_level']=="Admin") {
                	?>
                    <li>
                    	<a href="?pages=laporan" class="dropdown-toggle no-arrow">
                    		<span class="fa fa-book"></span><span class="mtext">Laporan Stok</span>
                    	</a>
                    </li>
                    <?php 
                	}
                	} 
                	?>
                    <li>
                        <a href="?pages=bantuan" class="dropdown-toggle no-arrow">
                            <span class="fa fa-question"></span><span class="mtext">Bantuan</span>
                        </a>
                    </li>
				</ul>
			</div>
		</div>
	</div>