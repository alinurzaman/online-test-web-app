<?php
	ob_start();
	session_start();
	if($_SESSION['sudahlogin']==true && $_SESSION['user']=='BOSADMIN'){
		include("db-connect.php");
		koneksi_db();
		$id_siswa = $_SESSION['user'];
		$id_uc = $_GET['idu'];
		$id_materi = $_GET['idm'];
		$get_uc = mysql_query("SELECT * FROM uc WHERE id_uc='$id_uc'");
		$data_uc = mysql_fetch_array($get_uc);
		$get_materi = mysql_query("SELECT * FROM materi WHERE id_materi='$id_materi'");
		$data_materi = mysql_fetch_array($get_materi);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<title>UC ONLINE LBB BEST | FORM UPLOAD SOAL UC</title>
	<meta name="description" content="TO LBB BEST FORM UPLOAD SOAL UC" />
	
	<!-- Favicon -->
	<link rel="shortcut icon" href="dist/img/Best 3D.png">
	<link rel="icon" href="dist/img/Best 3D.png" type="image/x-icon">
	
		<!-- Jasny-bootstrap CSS -->
		<link href="vendors/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>
		
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
					<a href="uploadsoal.php" class="active"><div class="pull-left"><i class="zmdi zmdi-cloud-upload mr-20"></i><span class="right-nav-text">Upload Soal UC</span></div><div class="clearfix"></div></a>
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
										<h6 class="panel-title txt-dark">Form Upload Soal UC</h6>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="panel-wrapper collapse in">
									<div class="panel-body">
										<div class="form-wrap">
											<form class="form-horizontal" method="post" enctype="multipart/form-data">
												<div class="form-group">
												<div class="col-sm-9">
													<input type="text" class="form-control" name="nama" value="<?php echo $data_uc["nama_uc"] . ' | ' . $data_materi["ujian_materi"] . ' : ' . $data_materi["jmlsoal_materi"]; ?>" disabled>
												</div>
												</div>
												<?php if ($data_materi['jmlsoal_materi'] != '1'){?>
												<div class="form-group">
													<div class="col-sm-9">
													<div class="fileinput fileinput-new input-group" data-provides="fileinput">
														<div class="form-control" data-trigger="fileinput"> <i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
														<span class="input-group-addon fileupload btn btn-info btn-anim btn-file"><i class="fa fa-upload"></i> <span class="fileinput-new btn-text">Pilih Folder</span> <span class="fileinput-exists btn-text">Ganti</span>
														<input type="file" name="files[]" id="files" multiple="" directory="" webkitdirectory="" mozdirectory="">
														</span> <a href="#" class="input-group-addon btn btn-danger btn-anim fileinput-exists" data-dismiss="fileinput"><i class="fa fa-trash"></i><span class="btn-text"> Hapus</span></a> 
													</div>
													</div>
												</div>
												<?php } else { ?>
												<div class="form-group">
												<div class="col-sm-9">
													<input type="text" class="form-control" name="video">
												</div>
												</div>
												<?php } ?>
												<div class="form-group mb-0"> 
													<div class="col-sm-10">
													  <button name="submit" type="submit" class="btn btn-success btn-anim"><i class="icon-rocket"></i><span class="btn-text">Submit</span></button>
													</div>
												</div>
												</form>
											<?php
												
												$count = 0;
												if ($_SERVER['REQUEST_METHOD'] == 'POST'){
													if($data_materi['jmlsoal_materi']!='1'){
														$address = 'upload/' . $data_uc['nama_uc'] . '/' . $data_materi['ujian_materi'] . '/';
														if (!file_exists($address)) {
															mkdir($address, 0777, true);
														}
														$total = count($_FILES['files']['name']);
														for($i=0; $i<$total; $i++) {
														  //Get the temp file path
														  $tmpFilePath = $_FILES['files']['tmp_name'][$i];

														  //Make sure we have a filepath
														  if ($tmpFilePath != ""){
															//Setup our new file path
															$newFilePath = $address . $_FILES['files']['name'][$i];

															//Upload the file into the temp dir
															if(move_uploaded_file($tmpFilePath, $newFilePath)) {

															  //Handle other code here
																$count++;
															}
														  }
														}

														for($i=1; $i<=$data_materi['jmlsoal_materi']; $i++){
															$src_soal = $address . $i . '.PNG';
															$insert = mysql_query("INSERT INTO soal VALUES(NULL, '$src_soal', '$id_materi')");
														}
													} else {
														$src_soal = $_POST['video'];
														$insert = mysql_query("INSERT INTO soal VALUES(NULL, '$src_soal', '$id_materi')");
													}
													$update = mysql_query("UPDATE materi SET status_materi='SUDAH DIUPLOAD' WHERE id_materi = '$id_materi'");
													header('Location: materisoal.php?idu='.$id_uc);
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