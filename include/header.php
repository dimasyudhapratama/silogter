<!--	<div class="pre-loader"></div>-->
	<div class="header clearfix">
		<div class="header-right">
			<div class="brand-logo">
				<a href="index.php">
					<img src="vendors/images/silogter-logo-mobile.png" alt="" class="mobile-logo">
				</a>
			</div>
			<div class="menu-icon">
				<span></span>
				<span></span>
				<span></span>
				<span></span>
			</div>
			<div class="user-info-dropdown">
				<div class="dropdown">
					<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
						<span class="user-icon"><i class="fa fa-user-o"></i></span>
						<span class="user-name"><?php if(isset($_SESSION['user_username'])){echo $_SESSION['user_username'].'('.$_SESSION['user_level'].')';} ?></span>
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						<a class="dropdown-item" href="?pages=change_password"><i class="fa fa-pencil" aria-hidden="true"></i> Ubah Password</a>
						<a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Log Out</a>
					</div>
				</div>
			</div>
		</div>
	</div>