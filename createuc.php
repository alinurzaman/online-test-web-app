<?php
ob_start();
	session_start();
	if($_SESSION['sudahlogin']==true && $_SESSION['user']=='BOSADMIN'){
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
	<title>UC ONLINE LBB BEST | CREATE UC</title>
	<meta name="description" content="TO LBB BEST CREATE UC" />
	
	<!-- Favicon -->
	<link rel="shortcut icon" href="dist/img/Best 3D.png">
	<link rel="icon" href="dist/img/Best 3D.png" type="image/x-icon">
	
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
					<a href="createuc.php" class="active"><div class="pull-left"><i class="zmdi zmdi-file-plus mr-20"></i><span class="right-nav-text">Create UC Baru</span></div><div class="clearfix"></div></a>
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
					<a href="inputsiswa.php"><div class="pull-left"><i class="zmdi zmdi-local-atm mr-20"></i><span class="right-nav-text">Input Siswa</span></div><div class="clearfix"></div></a>
				</li>
				<li>
					<a href="resetpassword.php"><div class="pull-left"><i class="zmdi zmdi-assignment-check mr-20"></i><span class="right-nav-text">Reset Password Siswa</span></div><div class="clearfix"></div></a>
				</li>
				<li>
					<a href="hasiluc.php"><div class="pull-left"><i class="zmdi zmdi-assignment-check mr-20"></i><span class="right-nav-text">Hasil UC</span></div><div class="clearfix"></div></a>
				</li>
				<?php } ?>
			</ul>
		</div>
		<!-- /Left Sidebar Menu -->
		
        <!-- Main Content -->
		<div class="page-wrapper">
            <div class="container-fluid">
				
				<!-- Row -->
				<div class="row">
					<div class="col-sm-6">
							<div class="panel panel-default card-view">
								<div class="panel-heading">
									<div class="pull-left">
										<h6 class="panel-title txt-dark">Form Create UC Baru</h6>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="panel-wrapper collapse in">
									<div class="panel-body">
										<div class="form-wrap">
											<form class="form-horizontal" method="post" action="" name="create">
												<div class="form-group">
													<label class="control-label mb-10 col-sm-3" for="nama">Create UC Baru:</label>
												<div class="col-sm-6">
													<input type="text" class="form-control" name="nama" placeholder="Contoh: UC-1 INTENSIF PKN STAN 2018" style="text-transform: uppercase">
												</div>
												</div>
												<div class="form-group">
													<label class="control-label mb-10 col-sm-3" for="pin">PIN UC:</label>
												<div class="col-sm-6">
													<input type="text" class="form-control" name="pin" placeholder="Harus 6 digit angka. Contoh: 123456" maxlength="6">
												</div>
												</div>
												<div class="form-group">
													<label class="control-label mb-10 col-sm-3" for="paket">Paket Ujian:</label>
												<div class="col-sm-6">
													<select class="form-control select2" name="paket">
														<option value="1">TPA, TBI</option>
														<option value="2">TPA, TBI, SKD</option>
														<option value="3">SKD</option>
														<option value="4">SKD, TPA, TBI</option>
														<option value="5">TRYOUT BAHAS (SKD, TPA, TBI)</option>
													</select>
												</div>
												</div>
												<div class="form-group mb-0"> 
													<div class="col-sm-offset-3 col-sm-10">
													  <button name="submit" type="submit" class="btn btn-success btn-anim"><i class="icon-rocket"></i><span class="btn-text">Submit</span></button>
													</div>
												</div>
												</form>
													<?php
														if (isset($_POST['submit'])==true){
															$nama = strtoupper($_POST['nama']);
															$pin = $_POST['pin'];
															$paket = $_POST['paket'];
															if($nama != "" && $pin!= ""){
																$insert = mysql_query("INSERT INTO uc VALUES(NULL, '$nama', '$pin')");
																if($insert){
																	$get_last = mysql_query("SELECT id_uc FROM uc ORDER BY id_uc DESC LIMIT 1");
																	$data_lastid = mysql_fetch_array($get_last);
																	$id_uc = $data_lastid['id_uc'];
																	if($paket=='1'){
																		$insert = mysql_query("INSERT INTO materi VALUES (NULL, 'TPA', 'TPA', '1', '0', '0', '0', '0', 'BELUM DIUPLOAD', 'BELUM DIUPLOAD', '$id_uc')");
																		$insert = mysql_query("INSERT INTO materi VALUES (NULL, 'TBI', 'TBI', '1', '0', '0', '0', '0', 'BELUM DIUPLOAD', 'BELUM DIUPLOAD', '$id_uc')");
																		if ($insert){
																			echo '<script language="javascript">alert("Create UC baru berhasil. Silahkan input materi ujian!"); document.location="inputmateri.php"</script>';
																		}
																	}
																	else if($paket=='2'){
																		$insert = mysql_query("INSERT INTO materi VALUES (NULL, 'TPA', 'TPA', '1', '0', '0', '0', '0', 'BELUM DIUPLOAD', 'BELUM DIUPLOAD', '$id_uc')");
																		$insert = mysql_query("INSERT INTO materi VALUES (NULL, 'TBI', 'TBI', '1', '0', '0', '0', '0', 'BELUM DIUPLOAD', 'BELUM DIUPLOAD', '$id_uc')");
																		$insert = mysql_query("INSERT INTO materi VALUES (NULL, 'SKD', 'TWK', '1', '0', '0', '0', '0', 'BELUM DIUPLOAD', 'BELUM DIUPLOAD', '$id_uc')");
																		$insert = mysql_query("INSERT INTO materi VALUES (NULL, 'SKD', 'TIU', '1', '0', '0', '0', '0', 'BELUM DIUPLOAD', 'BELUM DIUPLOAD', '$id_uc')");
																		$insert = mysql_query("INSERT INTO materi VALUES (NULL, 'SKD', 'TKP', '5', '0', '0', '0', '0', 'BELUM DIUPLOAD', 'BELUM DIUPLOAD', '$id_uc')");
																		if ($insert){
																			echo '<script language="javascript">alert("Create UC baru berhasil. Silahkan input materi ujian!"); document.location="inputmateri.php"</script>';
																		}
																	}
																	else if($paket=='3'){
																		$insert = mysql_query("INSERT INTO materi VALUES (NULL, 'SKD', 'TKP', '5', '0', '0', '0', '0', 'BELUM DIUPLOAD', 'BELUM DIUPLOAD', '$id_uc')");
																		$insert = mysql_query("INSERT INTO materi VALUES (NULL, 'SKD', 'TIU', '1', '0', '0', '0', '0', 'BELUM DIUPLOAD', 'BELUM DIUPLOAD', '$id_uc')");
																		$insert = mysql_query("INSERT INTO materi VALUES (NULL, 'SKD', 'TWK', '1', '0', '0', '0', '0', 'BELUM DIUPLOAD', 'BELUM DIUPLOAD', '$id_uc')");
																		if ($insert){
																			echo '<script language="javascript">alert("Create UC baru berhasil. Silahkan input materi ujian!"); document.location="inputmateri.php"</script>';
																		}
																	}
																	else if($paket=='4'){
																		$insert = mysql_query("INSERT INTO materi VALUES (NULL, 'SKD', 'TWK', '1', '0', '0', '0', '0', 'BELUM DIUPLOAD', 'BELUM DIUPLOAD', '$id_uc')");
																		$insert = mysql_query("INSERT INTO materi VALUES (NULL, 'SKD', 'TIU', '1', '0', '0', '0', '0', 'BELUM DIUPLOAD', 'BELUM DIUPLOAD', '$id_uc')");
																		$insert = mysql_query("INSERT INTO materi VALUES (NULL, 'SKD', 'TKP', '5', '0', '0', '0', '0', 'BELUM DIUPLOAD', 'BELUM DIUPLOAD', '$id_uc')");
																		$insert = mysql_query("INSERT INTO materi VALUES (NULL, 'TPA', 'TPA', '1', '0', '0', '0', '0', 'BELUM DIUPLOAD', 'BELUM DIUPLOAD', '$id_uc')");
																		$insert = mysql_query("INSERT INTO materi VALUES (NULL, 'TBI', 'TBI', '1', '0', '0', '0', '0', 'BELUM DIUPLOAD', 'BELUM DIUPLOAD', '$id_uc')");
																		
																		if ($insert){
																			echo '<script language="javascript">alert("Create UC baru berhasil. Silahkan input materi ujian!"); document.location="inputmateri.php"</script>';
																		}
																	}
																	else if($paket=='5'){
																		$insert = mysql_query("INSERT INTO materi VALUES (NULL, 'SKD', 'TWK', '1', '0', '0', '0', '0', 'BELUM DIUPLOAD', 'BELUM DIUPLOAD', '$id_uc')");
																		$insert = mysql_query("INSERT INTO materi VALUES (NULL, 'SKD', 'TIU', '1', '0', '0', '0', '0', 'BELUM DIUPLOAD', 'BELUM DIUPLOAD', '$id_uc')");
																		$insert = mysql_query("INSERT INTO materi VALUES (NULL, 'SKD', 'TKP', '5', '0', '0', '0', '0', 'BELUM DIUPLOAD', 'BELUM DIUPLOAD', '$id_uc')");
																		$insert = mysql_query("INSERT INTO materi VALUES (NULL, 'TPA', 'TPA', '1', '0', '0', '0', '0', 'BELUM DIUPLOAD', 'BELUM DIUPLOAD', '$id_uc')");
																		$insert = mysql_query("INSERT INTO materi VALUES (NULL, 'PEMBAHASAN', 'PEMBAHASAN', '0', '0', '0', '0', '0', 'BELUM DIUPLOAD', 'BELUM DIUPLOAD', '$id_uc')");
																		$insert = mysql_query("INSERT INTO materi VALUES (NULL, 'TBI', 'TBI', '1', '0', '0', '0', '0', 'BELUM DIUPLOAD', 'BELUM DIUPLOAD', '$id_uc')");
																		
																		if ($insert){
																			echo '<script language="javascript">alert("Create UC baru berhasil. Silahkan input materi ujian!"); document.location="inputmateri.php"</script>';
																		}
																	}
																}
																else{
																	echo '<script language="javascript">alert("Create UC baru gagal!");</script>';
																}
															}
															else{
																echo '<script language="javascript">alert("Nama UC belum diisi!");</script>';
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
		<script src="vendors/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js"></script>
		
		<!-- Slimscroll JavaScript -->
		<script src="dist/js/jquery.slimscroll.js"></script>
	
		<!-- Fancy Dropdown JS -->
		<script src="dist/js/dropdown-bootstrap-extended.js"></script>
		
		<!-- Owl JavaScript -->
		<script src="vendors/bower_components/owl.carousel/dist/owl.carousel.min.js"></script>
	
		<!-- Switchery JavaScript -->
		<script src="vendors/bower_components/switchery/dist/switchery.min.js"></script>
	
		<!-- Init JavaScript -->
		<script src="dist/js/init.js"></script>
		
		<!-- Form Advance Init JavaScript -->
		<script src="dist/js/form-advance-data.js"></script>

		<!-- Select2 JavaScript -->
		<script src="vendors/bower_components/select2/dist/js/select2.full.min.js"></script>
</body>

</html>

<?php
	}
	else header("Location: index.php");
ob_end_flush();
?>