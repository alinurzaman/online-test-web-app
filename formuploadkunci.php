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
	<title>UC ONLINE LBB BEST | FORM UPLOAD KUNCI UC</title>
	<meta name="description" content="TO LBB BEST FORM UPLOAD KUNCI UC" />
	
	<!-- Favicon -->
	<link rel="shortcut icon" href="dist/img/Best 3D.png">
	<link rel="icon" href="dist/img/Best 3D.png" type="image/x-icon">
	
	<!-- Data table CSS -->
	<link href="vendors/bower_components/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>

		<!-- Jasny-bootstrap CSS -->
		<link href="vendors/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>
		
		<!-- Custom CSS -->
		<link href="dist/css/style.css" rel="stylesheet" type="text/css">
	<script>
		function showEdit(editableObj) {
			$(editableObj).css("background","#FFF");
		} 
		
		function saveToDatabase(editableObj,column,id) {
			$(editableObj).css("background","#FFF url(loaderIcon.gif) no-repeat right");
			$.ajax({
				url: "savekunci.php",
				type: "POST",
				data:'column='+column+'&editval='+editableObj.innerHTML+'&id='+id,
				success: function(data){
					$(editableObj).css("background","#6df900");
				}        
		   });
		}
		
	</script>
	
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
					<a href="uploadkunci.php" class="active"><div class="pull-left"><i class="zmdi zmdi-key mr-20"></i><span class="right-nav-text">Upload Kunci</span></div><div class="clearfix"></div></a>
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
										<h6 class="panel-title txt-dark">Form Upload Kunci UC</h6>
									</div>
									<div class="clearfix"></div>
								</div>
								<?php if($data_materi['jawaban_materi']=='1' || $data_materi['jawaban_materi']=='0'){?>
								<div class="panel-wrapper collapse in">
									<div class="panel-body">
										<div class="form-wrap">
											<form class="form-horizontal" method="post">
												<div class="form-group">
												<div class="col-sm-5">
													<input type="text" placeholder="Poin Jawaban Benar. Cth: 4" name="benar" class="form-control">
												</div>
												</div>
												<div class="form-group">
													<div class="col-sm-5">
													<input type="text" placeholder="Poin Jawaban Salah. Cth: 1" name="salah" class="form-control">
													</div>
												</div>
												<div class="form-group mb-0"> 
													<div class="col-sm-10">
													  <button name="submit" type="submit" class="btn btn-success btn-anim"><i class="icon-rocket"></i><span class="btn-text">Submit</span></button>
													</div>
												</div>
												</form>
											</div>
									</div>
								</div>
											<?php
												if (isset($_POST['submit'])==true){
													$benar = $_POST['benar'];
													$salah = $_POST['salah'];
													$total = $data_materi['jmlsoal_materi'];
													$get_id = mysql_query("SELECT id_soal FROM soal WHERE id_materi = '$id_materi' ORDER BY id_soal ASC LIMIT 1");
													$data_id = mysql_fetch_array($get_id);
													$id_soal = $data_id['id_soal'];
													$id_soal = (int)$id_soal;
													for($i=1; $i<=$total; $i++){
														$insert = mysql_query("INSERT INTO kunci VALUES(NULL, '-', '$benar', '$salah', '$id_soal')");
														$id_soal++;
													}
													$update_kunci = mysql_query("UPDATE materi SET kunci_materi = 'SUDAH DIUPLOAD' WHERE id_materi='$id_materi'");
													$get_kunci = mysql_query("SELECT * FROM kunci WHERE id_soal IN (SELECT id_soal FROM soal WHERE id_materi = '$id_materi')");
													?>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div class="table-wrap">
										<div class="table-responsive">
											<table id="datable_1" class="table table-hover display  pb-30" >
												<thead>
													<tr>
														<th>#NO.</th>
														<th>KUNCI</th>
													</tr>
												</thead>
												<tbody>
													<?php $i = 1; while($data_kunci=mysql_fetch_array($get_kunci)){?>
													<tr>
														<td><?php echo $i; ?></td>
														<td contenteditable="true" onBlur="saveToDatabase(this,'jawaban_kunci','<?php echo $data_kunci["id_kunci"]; ?>')" onClick="showEdit(this);"><?php echo $data_kunci['jawaban_kunci'];?></td>
													</tr>
													<?php $i++; }?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
												<?php } }
								else if($data_materi['jawaban_materi']=='5'){
									$total = $data_materi['jmlsoal_materi'];
									$get_id = mysql_query("SELECT id_soal FROM soal WHERE id_materi = '$id_materi' ORDER BY id_soal ASC LIMIT 1");
									$data_id = mysql_fetch_array($get_id);
									$id_soal = $data_id['id_soal'];
									$id_soal = (int)$id_soal;
									for($i=1; $i<=$total; $i++){
										for($poin=5; $poin>=1; $poin--){
											$insert = mysql_query("INSERT INTO kunci VALUES(NULL, '-', '$poin', '0', '$id_soal')");
										}
										$id_soal++;
									}
									$update_kunci = mysql_query("UPDATE materi SET kunci_materi = 'SUDAH DIUPLOAD' WHERE id_materi='$id_materi'");
									$get_kunci = mysql_query("SELECT * FROM kunci WHERE id_soal IN (SELECT id_soal FROM soal WHERE id_materi = '$id_materi')");
								?>
								<div class="panel-wrapper collapse in">
									<div class="panel-body">
										<div class="table-wrap">
											<div class="table-responsive">
												<table id="datable_1" class="table table-hover display  pb-30" >
													<thead>
														<tr>
															<th>#NO.</th>
															<th>KUNCI</th>
															<th>POIN</th>
														</tr>
													</thead>
													<tbody>
														<?php $i = 1; $id = 0; while($data_kunci=mysql_fetch_array($get_kunci)){?>
														<tr>
															<?php if($id != $data_kunci['id_soal']){ ?>
															<td rowspan="5"><?php echo $i; ?></td>
															<?php $i++; } ?>
															<td contenteditable="true" onBlur="saveToDatabase(this,'jawaban_kunci','<?php echo $data_kunci["id_kunci"]; ?>')" onClick="showEdit(this);"><?php echo $data_kunci['jawaban_kunci'];?></td>
															<td><?php echo $data_kunci['poinbenar_kunci']; ?></td>
														</tr>
														<?php 
															$id = $data_kunci['id_soal'];
														}?>
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

	<!-- Data table JavaScript -->
	<script src="vendors/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
	<script src="dist/js/dataTables-data.js"></script>
		
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