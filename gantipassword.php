<?php
ob_start();
	session_start();
	if($_SESSION['sudahlogin']==true){
		include("db-connect.php");
		koneksi_db();
		$id_siswa = $_SESSION['user'];
		$get_siswa = mysql_query("SELECT * FROM siswa WHERE id_siswa='$id_siswa'");
		$data_siswa = mysql_fetch_array($get_siswa);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<title>UC ONLINE LBB BEST | GANTI PASSWORD</title>
	<meta name="description" content="TO LBB BEST GANTI PASSWORD" />
	
	<!-- Favicon -->
	<link rel="shortcut icon" href="dist/img/Best 3D.png">
	<link rel="icon" href="dist/img/Best 3D.png" type="image/x-icon">
	
	<!-- Morris Charts CSS -->
    <link href="vendors/bower_components/morris.js/morris.css" rel="stylesheet" type="text/css"/>
	
	<!-- Data table CSS -->
	<link href="vendors/bower_components/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
			
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
							<img class="brand-img" src="dist/img/Best 3D.png" width="25px" alt="brand"/>
							<span class="brand-text">UC ONLINE BEST</span>
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
								<a href="#"><i class="zmdi zmdi-account"></i><?php echo $data_siswa['nama_siswa'];?></a>
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
					<a href="index.php"><div class="pull-left"><i class="zmdi zmdi-inbox mr-20"></i><span class="right-nav-text">Dashboard</span></div><div class="pull-right"></div><div class="clearfix"></div></a>
				</li>
				<?php if ($id_siswa == 'BOSADMIN'){ ?>
				<li><hr class="light-grey-hr mb-10"/></li>
				<li class="navigation-header">
					<span>Menu Special Admin</span> 
					<i class="zmdi zmdi-more"></i>
				</li>
				<li>
					<a href="createuc.php"><div class="pull-left"><i class="zmdi zmdi-file-plus mr-20"></i><span class="right-nav-text">Create UC Baru</span></div><div class="clearfix"></div></a>
				</li>

				<li>
					<a href="inputmateri.php"><div class="pull-left"><i class="zmdi zmdi-keyboard mr-20"></i><span class="right-nav-text">Input Materi Ujian</span></div><div class="clearfix"></div></a>
				</li>
				<li>
					<a href="uploadsoal.php"><div class="pull-left"><i class="zmdi zmdi-cloud-upload mr-20"></i><span class="right-nav-text">Upload Soal UC</span></div><div class="clearfix"></div></a>
				</li>
				<li>
					<a href="uploadkunci.php"><div class="pull-left"><i class="zmdi zmdi-key mr-20"></i><span class="right-nav-text">Upload Kunci</span></div><div class="clearfix"></div></a>
				</li>
				<?php } else if(substr($id_siswa, 0, 5) == "ADMIN"){ ?>
				<li><hr class="light-grey-hr mb-10"/></li>
				<li class="navigation-header">
					<span>Menu Admin</span> 
					<i class="zmdi zmdi-more"></i>
				</li>
				<li>
					<a href="inputsiswa.php"><div class="pull-left"><i class="zmdi zmdi-account-add mr-20"></i><span class="right-nav-text">Input Siswa</span></div><div class="clearfix"></div></a>
				</li>
				<li>
					<a href="daftarsiswa.php"><div class="pull-left"><i class="zmdi zmdi-accounts-list mr-20"></i><span class="right-nav-text">Daftar Siswa</span></div><div class="clearfix"></div></a>
				</li>
				<li>
					<a href="resetpassword.php"><div class="pull-left"><i class="zmdi zmdi-key mr-20"></i><span class="right-nav-text">Reset Password Siswa</span></div><div class="clearfix"></div></a>
				</li>
				<li>
					<a href="hasiluc.php" class="active"><div class="pull-left"><i class="zmdi zmdi-view-list-alt mr-20"></i><span class="right-nav-text">Hasil UC</span></div><div class="clearfix"></div></a>
				</li>
				<?php } else{ ?>
				<li><hr class="light-grey-hr mb-10"/></li>
				<li class="navigation-header">
					<span>Pilihan UC</span> 
					<i class="zmdi zmdi-more"></i>
				</li>
				<?php
				$get_uc = mysql_query("SELECT * FROM uc");
				while($data_uc = mysql_fetch_array($get_uc)){
					?>
				<li>
					<a href="mulaiuc.php?idu=<?php echo $data_uc['id_uc'];?>"><div class="pull-left"><i class="zmdi zmdi-collection-text mr-20"></i><span class="right-nav-text"><?php echo $data_uc['nama_uc'];?></span></div><div class="clearfix"></div></a>
				</li>
				<?php
				}
				 } ?>
			</ul>
		</div>
		<!-- /Left Sidebar Menu -->
		
        <!-- Main Content -->
		<div class="page-wrapper">
            <div class="container-fluid">
				
				<!-- Row -->
				<div class="row">
					<div class="col-sm-9">
							<div class="panel panel-default card-view">
								<div class="panel-heading">
									<div class="pull-left">
										<h6 class="panel-title txt-dark">Ganti Password</h6>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="panel-wrapper collapse in">
									<div class="panel-body">
										<div class="form-wrap">
											<form class="form-horizontal" method="post" action="" name="change">
												<div class="form-group">
													<label class="control-label mb-10 col-sm-3" for="pass1">Password Baru:</label>
												<div class="col-sm-8">
													<input type="password" class="form-control" name="pass1" id="pass1" placeholder="Harus huruf besar">
												</div>
												</div>
												<div class="form-group">
													<label class="control-label mb-10 col-sm-3" for="pass2">Ulangi Password Baru:</label>
												<div class="col-sm-8"> 
													<input type="password" class="form-control" name="pass2" id="pass2" placeholder="Harus huruf besar">
												</div>
												</div>
												<div class="form-group mb-0"> 
													<div class="col-sm-offset-3 col-sm-10">
													  <button name="simpan" type="submit" class="btn btn-success btn-anim"><i class="icon-rocket"></i><span class="btn-text">Simpan</span></button>
													</div>
												</div>
												</form>
													<?php
														if (isset($_POST['simpan'])==true){
															$pass1 = strtoupper($_POST['pass1']);
															$pass2 = strtoupper($_POST['pass2']);
															if($pass1 != $pass2){
																echo '<script language="javascript">alert("Password baru tidak sama");</script>';
															}
															else{
																$update = mysql_query("UPDATE siswa SET password_siswa=PASSWORD('$pass1') WHERE id_siswa='$id_siswa'");
																if($update){
																	echo '<script language="javascript">alert("Ganti password berhasil. Silahkan login kembali!"); document.location="logout.php"</script>';
																	
																}
																else{
																	echo '<script language="javascript">alert("Ganti password gagal!");</script>';
																}
															}
														}
													?>

										</div>
									</div>
								</div>
							</div>
						</div>				
				</div>
				<!-- Row -->
			</div>
			
			<!-- Footer -->
			<footer class="footer container-fluid pl-30 pr-30">
				<div class="row">
					<div class="col-sm-12">
						<p>&copy; UC ONLINE BEST. Created for LBB BEST use only.</p>
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

    <!-- Bootstrap Core JavaScript -->
    <script src="vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    
	<!-- Data table JavaScript -->
	<script src="vendors/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
	
	<!-- Slimscroll JavaScript -->
	<script src="dist/js/jquery.slimscroll.js"></script>
	
	<!-- simpleWeather JavaScript -->
	<script src="vendors/bower_components/moment/min/moment.min.js"></script>
	<script src="vendors/bower_components/simpleWeather/jquery.simpleWeather.min.js"></script>
	<script src="dist/js/simpleweather-data.js"></script>
	
	<!-- Progressbar Animation JavaScript -->
	<script src="vendors/bower_components/waypoints/lib/jquery.waypoints.min.js"></script>
	<script src="vendors/bower_components/jquery.counterup/jquery.counterup.min.js"></script>
	
	<!-- Fancy Dropdown JS -->
	<script src="dist/js/dropdown-bootstrap-extended.js"></script>
	
	<!-- Sparkline JavaScript -->
	<script src="vendors/jquery.sparkline/dist/jquery.sparkline.min.js"></script>
	
	<!-- Owl JavaScript -->
	<script src="vendors/bower_components/owl.carousel/dist/owl.carousel.min.js"></script>
	
	<!-- ChartJS JavaScript -->
	<script src="vendors/chart.js/Chart.min.js"></script>
	
	<!-- Morris Charts JavaScript -->
    <script src="vendors/bower_components/raphael/raphael.min.js"></script>
    <script src="vendors/bower_components/morris.js/morris.min.js"></script>
	
	<!-- Switchery JavaScript -->
	<script src="vendors/bower_components/switchery/dist/switchery.min.js"></script>
	
	<!-- Init JavaScript -->
	<script src="dist/js/init.js"></script>
	<script src="dist/js/dashboard-data.js"></script>
</body>

</html>

<?php
	}
	else header("Location: login.html");
ob_end_flush();
?>