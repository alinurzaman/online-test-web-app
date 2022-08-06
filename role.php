<?php
	session_start();
	if($_SESSION['sudahlogin']==true){
		include("db-connect.php");
		koneksi_db();
?>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<title>SIAP LBB BEST | Pilih Role</title>
		<meta name="description" content="Pilh role SIAP LBB BEST" />
		<meta name="author" content="lbb-best"/>
		
		<!-- Favicon -->
		<link rel="shortcut icon" href="dist/img/logo.png">
		<link rel="icon" href="dist/img/logo.png" type="image/x-icon">
		
		<!-- vector map CSS -->
		<link href="vendors/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>
		
		
		
		<!-- Custom CSS -->
		<link href="dist/css/style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<!--Preloader-->
		<div class="preloader-it">
			<div class="la-anim-1"></div>
		</div>
		<!--/Preloader-->
		
		<div class="wrapper pa-0">
			<header class="sp-header">
				<div class="sp-logo-wrap pull-left">
					<a href="index.html">
						<img class="brand-img mr-10" src="dist/img/logo.png" alt="brand"/>
						<span class="brand-text">SIAP LBB BEST</span>
					</a>
				</div>
				<div class="clearfix"></div>
			</header>
			
			<!-- Main Content -->
			<div class="page-wrapper pa-0 ma-0 auth-page">
				<div class="container-fluid">
					<!-- Row -->
					<div class="table-struct full-width full-height">
						<div class="table-cell vertical-align-middle auth-form-wrap">
							<div class="auth-form  ml-auto mr-auto no-float">
								<div class="row">
									<div class="col-sm-12 col-xs-12">
										<div class="mb-30">
											<h3 class="text-center txt-dark mb-10">Pilih Role SIAP</h3>
											<h6 class="text-center nonecase-font txt-grey">Silahkan pilih role yang tersedia di bawah</h6>
										</div>
										<?php
											$id_karyawan = $_SESSION['user'];
											$cek = "SELECT u.id_role, nama_role FROM user u INNER JOIN role r ON u.id_role=r.id_role WHERE id_karyawan='$id_karyawan'";
											$cek = mysql_query($cek);
											$banyakrecord=mysql_num_rows($cek); 
											if($banyakrecord>0){ 
										?>
										<div class="form-wrap">
											<form name="loginform" method="post" id="loginform" action="">
												<div class="form-group">
													<select class="form-control" id="role" name="role">
														<?php
														while($data=mysql_fetch_array($cek)){
														?>
														<option value="<?php echo $data['id_role']?>"><?php echo $data['nama_role'];?></option>
														<?php
														}
														?>
													</select>
												</div>
												<div class="form-group text-center">
													<button name="pilih" type="submit" class="btn btn-info btn-rounded">Pilih</button>
												</div>
											</form>
											<?php
												if (isset($_POST['pilih'])==true){
													$_SESSION['role']=$_POST['role'];
													header("Location: index.php");	
												}
											}
											?>
										</div>
									</div>	
								</div>
							</div>
						</div>
					</div>
					<!-- /Row -->	
				</div>
				
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
		
		<!-- Init JavaScript -->
		<script src="dist/js/init.js"></script>
	</body>
</html>
<?php
	}
	else header("Location: login.html");
?>