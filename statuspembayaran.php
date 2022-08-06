<?php
	session_start();
	if($_SESSION['sudahlogin']==true){
		include("db-connect.php");
		koneksi_db();
		$id_cabang = $_SESSION['cabang'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<title>SIAP | STATUS PEMBAYARAN</title>
	<meta name="description" content="SIAP STATUS PEMBAYARAN" />
	
	<!-- Favicon -->
	<link rel="shortcut icon" href="dist/img/logo.png">
	<link rel="icon" href="dist/img/logo.png" type="image/x-icon">
	
	<!-- Morris Charts CSS -->
    <link href="vendors/bower_components/morris.js/morris.css" rel="stylesheet" type="text/css"/>
	
	<!-- Data table CSS -->
	<link href="vendors/bower_components/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
	
	<!-- select2 CSS -->
	<link href="vendors/bower_components/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css"/>

	<!-- Custom CSS -->
	<link href="dist/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
	<!-- Preloader -->
	<div class="preloader-it">
		<div class="la-anim-1"></div>
	</div>
	<!-- /Preloader -->
    <div class="wrapper theme-1-active pimary-color-red">
		<!-- Top Menu Items -->
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="mobile-only-brand pull-left">
				<div class="nav-header pull-left">
					<div class="logo-wrap">
						<a href="index.html">
							<img class="brand-img" src="dist/img/logo.png" alt="brand"/>
							<span class="brand-text">SIAP</span>
						</a>
					</div>
				</div>	
				<a id="toggle_nav_btn" class="toggle-left-nav-btn inline-block ml-20 pull-left" href="javascript:void(0);"><i class="zmdi zmdi-menu"></i></a>
				<a id="toggle_mobile_nav" class="mobile-only-view" href="javascript:void(0);"><i class="zmdi zmdi-more"></i></a>
			</div>
			<div id="mobile_only_nav" class="mobile-only-nav pull-right">
				<ul class="nav navbar-right top-nav pull-right">
					<li class="dropdown auth-drp">
						<a href="#" class="dropdown-toggle pr-0" data-toggle="dropdown"><img src="dist/img/Best 3D.png" width="80" alt="user_auth" class="user-auth-img img-circle"/><span class="user-online-status"></span></a>
						<ul class="dropdown-menu user-auth-dropdown" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
							<li>
								<a href="#"><i class="zmdi zmdi-account"></i><?php echo $_SESSION['user'];?></a>
							</li>
							<li class="divider"></li>
							<li>
								<a href="role.php"><i class="zmdi zmdi-swap"></i>Ganti Role</a>
							</li>
							<li class="divider"></li>
							<li>
								<a href="gantipassword.php"><i class="zmdi zmdi-key"></i>Ganti Password</a>
							</li>
							<li class="divider"></li>
							<li>
								<a href="logout.php"><i class="zmdi zmdi-power"></i><span>Log Out</span></a>
							</li>
						</ul>
					</li>
				</ul>
			</div>	
		</nav>
		<!-- /Top Menu Items -->
		
		<!-- Left Sidebar Menu -->
		<div class="fixed-sidebar-left">
			<ul class="nav navbar-nav side-nav nicescroll-bar">
				<li class="navigation-header">
					<span>Home</span> 
					<i class="zmdi zmdi-more"></i>
				</li>
				<li>
					<a href="index.php"><div class="pull-left"><i class="zmdi zmdi-inbox mr-20"></i><span class="right-nav-text">Dashboard</span></div><div class="pull-right"><span class="label label-warning">8</span></div><div class="clearfix"></div></a>
				</li>
				<?php if(($_SESSION['role']=='4')||($_SESSION['role']=='6')){?>
				<li><hr class="light-grey-hr mb-10"/></li>
				<li class="navigation-header">
					<span>Menu Siswa</span> 
					<i class="zmdi zmdi-more"></i>
				</li>
				<?php if($_SESSION['role']=='6'){?>
				<li>
					<a href="inputsiswabaru.php"><div class="pull-left"><i class="zmdi zmdi-account-add mr-20"></i><span class="right-nav-text">Input Siswa Baru</span></div><div class="clearfix"></div></a>
				</li>
				<li>
					<a href="daftarprogram.php"><div class="pull-left"><i class="zmdi zmdi-folder-person mr-20"></i><span class="right-nav-text">Daftar Program</span></div><div class="clearfix"></div></a>
				</li>
				<?php } if($_SESSION['role']=='4'){?>
				<li>
					<a href="pindahprogram.php"><div class="pull-left"><i class="zmdi zmdi-repeat mr-20"></i><span class="right-nav-text">Pindah Program</span></div><div class="clearfix"></div></a>
				</li>
				<li>
					<a href="pindahkelas.php"><div class="pull-left"><i class="zmdi zmdi-run mr-20"></i><span class="right-nav-text">Pindah Kelas</span></div><div class="clearfix"></div></a>
				</li>
				<?php } } if($_SESSION['role']=='6'){?>
				<li><hr class="light-grey-hr mb-10"/></li>
				<li class="navigation-header">
					<span>Menu Pembayaran</span> 
					<i class="zmdi zmdi-more"></i>
				</li>
				<li>
					<a href="inputcicilan.php"><div class="pull-left"><i class="zmdi zmdi-local-atm mr-20"></i><span class="right-nav-text">Input Cicilan</span></div><div class="clearfix"></div></a>
				</li>
				<li>
					<a href="statuspembayaran.php" class="active"><div class="pull-left"><i class="zmdi zmdi-assignment-check mr-20"></i><span class="right-nav-text">Status Pembayaran</span></div><div class="clearfix"></div></a>
				</li>
				<?php } ?>
			</ul>
		</div>
		<!-- /Left Sidebar Menu -->
		
        <!-- Main Content -->
			<div class="page-wrapper">
				<div class="container-fluid">
					
					<!-- Title -->
					<div class="row heading-bg">
						<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
							<h5 class="txt-dark">Status Pembayaran</h5>
						</div>
					</div>
					<!-- /Title -->

					<!-- Row -->
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default card-view">
								<div class="panel-heading">
									<div class="pull-left">
										<h6 class="panel-title txt-dark">Data Siswa</h6>
									</div>
									<div class="clearfix"></div>
								</div>
								<form method="post" action="">
									<div class="col-md-4">
										<select class="form-control select2" name="program">
										<?php
											$cek = "SELECT * FROM program WHERE status_program ='AKTIF'";
											$cek = mysql_query($cek);
											$banyakrecord=mysql_num_rows($cek); 
											?><option value="ALL">SEMUA PROGRAM</option>
											<?php if($banyakrecord>0){ 
												while($data=mysql_fetch_array($cek)){?>
													<option value="<?php echo $data['id_program'];?>" <?php if(isset($_POST['program'])==$data['id_program']) echo "selected";?>>
														<?php echo $data['nama_program'];?>
													</option>
											<?php }} ?>
										</select>
									</div>
									<div class="col-md-4">
										<select class="form-control select2" name="status">
											<option value="LUNAS" <?php if(isset($_POST['status'])=="LUNAS") echo "selected";?>>LUNAS</option>
											<option value="BELUM LUNAS" <?php if(isset($_POST['status'])=="BELUM LUNAS") echo "selected";?>>BELUM LUNAS</option>
										</select>
									</div>
									<div class="col-md-4">
										<button name="cari" type="submit" class="btn btn-success  mr-10">Tampilkan</button>
									</div>
								</form>
								<div class="clearfix"></div>
								<br>
							<?php if(isset($_POST['cari'])==true){
								$program = $_POST['program'];
								$status = $_POST['status'];
								$get_siswa = mysql_query("SELECT * FROM siswa WHERE id_siswa IN (SELECT id_siswa FROM pelanggan WHERE id_kelas IN (SELECT id_kelas FROM kelas WHERE id_cabang='SBY' AND id_program='$program'))");
							?>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div class="table-wrap">
										<div class="table-responsive">
											<table id="datable_1" class="table table-hover display  pb-30" >
												<thead>
													<tr>
														<th>ID</th>
														<th>NAMA</th>
														<th>KELAS</th>
														<th>TRX TERAKHIR</th>
														<th>SUDAH BAYAR</th>
														<th>KEKURANGAN</th>
														<th>TINDAKAN</th>
													</tr>
												</thead>
												<tbody>
													<?php while($data_siswa=mysql_fetch_array($get_siswa)){?>
													<tr>
														<td><?php echo $data_siswa['id_siswa'];?></td>
														<td><?php echo $data_siswa['nama_siswa'];?></td>
														<td>FOKUS STAN 1</td>
														<td>13-03-2018</td>
														<td>Rp 1.000.000</td>
														<td>Rp 2.750.000</td>
														<td><button>Detail</button></td>
													</tr>
													<?php }?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
							<?php } ?>
							</div>
						</div>
					</div>
					<!-- /Row -->
					
				</div>
				
				<!-- Footer -->
				<footer class="footer container-fluid pl-30 pr-30">
					<div class="row">
						<div class="col-sm-12">
							<p>&copy; Aplikasi SIAP LBB BEST. Created for LBB BEST use only.</p>
						</div>
					</div>
				</footer>
				<!-- /Footer -->
			
			</div>        
		<!-- /Main Content -->

    </div>
    <!-- /#wrapper -->
	
	<!-- JavaScript -->
    
	<!-- jQuery -->
    <script src="vendors/bower_components/jquery/dist/jquery.min.js"></script>

	<!-- Data table JavaScript -->
	<script src="vendors/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
	<script src="dist/js/dataTables-data.js"></script>
	
	<!-- Slimscroll JavaScript -->
	<script src="dist/js/jquery.slimscroll.js"></script>
	
	<!-- Owl JavaScript -->
	<script src="vendors/bower_components/owl.carousel/dist/owl.carousel.min.js"></script>
	
	<!-- Switchery JavaScript -->
	<script src="vendors/bower_components/switchery/dist/switchery.min.js"></script>
	
	<!-- Fancy Dropdown JS -->
	<script src="dist/js/dropdown-bootstrap-extended.js"></script>
	
	<!-- Init JavaScript -->
	<script src="dist/js/init.js"></script>
	
		<!-- Bootstrap Core JavaScript -->
		<script src="vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
		<script src="vendors/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js"></script>
				
		<!-- Form Advance Init JavaScript -->
		<script src="dist/js/form-advance-data.js"></script>
		
		<!-- Select2 JavaScript -->
		<script src="vendors/bower_components/select2/dist/js/select2.full.min.js"></script>

</html>

<?php
	}
	else header("Location: login.html");
?>