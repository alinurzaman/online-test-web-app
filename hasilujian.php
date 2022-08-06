<?php
	ob_start();
	session_start();
	if($_SESSION['sudahlogin']==true){
		include("db-connect.php");
		koneksi_db();
		date_default_timezone_set('Asia/Jakarta');
		$id_siswa = $_SESSION['user'];
		$get_siswa = mysql_query("SELECT * FROM siswa WHERE id_siswa='$id_siswa'");
		$data_siswa = mysql_fetch_array($get_siswa);
		$id_cabang = $data_siswa['id_cabang'];
		$id_materi = base64_decode(base64_decode($_GET['idm']));
		$id_uc = base64_decode(base64_decode($_GET['idu']));
		$ret = base64_decode(base64_decode($_GET['ret']));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<title>UC ONLINE LBB BEST | HASIL UJIAN</title>
	<meta name="description" content="TO LBB BEST HASIL UJIAN" />
	
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
				<?php
						$get_materi = mysql_query("SELECT * FROM materi WHERE id_materi='$id_materi'");
						$data_materi = mysql_fetch_array($get_materi);
						$skor = 0;
						$benar = 0;
						$salah = 0;
						$get_jawaban = mysql_query("SELECT id_soal, pilihan_jawaban FROM jawaban WHERE id_siswa='$id_siswa' AND id_soal IN (SELECT id_soal FROM soal WHERE id_materi='$id_materi')");
						while($data_jawaban=mysql_fetch_array($get_jawaban)){
							$id_soal = $data_jawaban['id_soal'];
							$pilihan_jawaban = $data_jawaban['pilihan_jawaban'];
							if($data_materi['jawaban_materi']=="1"){
								$get_kunci = mysql_query("SELECT * FROM kunci WHERE id_soal = '$id_soal'");
							}
							else if($data_materi['jawaban_materi']=="5"){
								$get_kunci = mysql_query("SELECT * FROM kunci WHERE id_soal = '$id_soal' AND jawaban_kunci = '$pilihan_jawaban'");
							}
							$data_kunci = mysql_fetch_array($get_kunci);
							if($pilihan_jawaban == $data_kunci['jawaban_kunci']){
								$benar++;
								$skor = $skor + $data_kunci['poinbenar_kunci'];
							}
							else{
								$salah++;
								$skor = $skor - $data_kunci['poinsalah_kunci'];
							}
						}
						if($skor >= $data_materi['batasnilai_materi']){
							$ket_hasil = "LULUS";
						}
						else {
							$ket_hasil = "TIDAK LULUS";
						}
						$kosong = $data_materi['jmlsoal_materi'] - $benar - $salah;
						$get_uc = mysql_query("SELECT * FROM uc WHERE id_uc='$id_uc'");
						$data_uc = mysql_fetch_array($get_uc);
						if($ret == "0"){
							$update_hasil = mysql_query("UPDATE hasil SET benar_hasil = '$benar', salah_hasil = '$salah', kosong_hasil = '$kosong', nilai_hasil = '$skor', ket_hasil = '$ket_hasil' WHERE id_siswa = '$id_siswa' AND id_materi = '$id_materi'");
							
							$get_hasil = mysql_query("SELECT * FROM hasil WHERE id_materi IN (SELECT id_materi FROM materi WHERE id_uc = '$id_uc') AND id_siswa = '$id_siswa'");
							$ket_hasiluc = "LULUS";
							while ($data_hasil = mysql_fetch_array($get_hasil)){
								if($data_hasil['ket_hasil'] == "TIDAK LULUS"){
									$ket_hasiluc = "TIDAK LULUS";
								}
							}
							$get_hasiluc = mysql_query("SELECT * FROM hasiluc WHERE id_siswa = '$id_siswa' AND id_uc = '$id_uc'");
							$ada_hasiluc = mysql_num_rows($get_hasiluc);
							if($ada_hasiluc > 0){
								$update = mysql_query("UPDATE hasiluc SET ket_hasiluc = '$ket_hasiluc' WHERE id_siswa = '$id_siswa' AND id_uc = '$id_uc'");
							}
							else {
								$insert = mysql_query("INSERT INTO hasiluc VALUES(NULL, '$ket_hasiluc', '$id_siswa', '$id_uc')");
							}
						}
						
				?>
				<?php if($ret != 0){?>
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default card-view">
								
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div class="table-wrap">
										<div class="table-responsive">
											<table class="table table-hover mb-0">
												<thead>
													<tr>
													<th colspan="2" style="text-align: center">
														<h4><?php echo "HASIL UJIAN ULANG " . $data_uc['nama_uc'] . " - " . $data_materi['ujian_materi'];?></h4>
														<br>
														<h5>Nilai Minimal: <?php echo $data_materi['batasnilai_materi']; ?></h5>
														<br>
														<strong><font color="#FF4343">*Nilai yang ditampilkan pada halaman ini, tidak akan tersimpan dalam database karena nilai ini adalah hasil dari ujian ulang.*</font></strong>
													</th>
													</tr>
												</thead>
											</table>
										</div>
									</div>
								</div>
							</div>
							</div>
						</div>
					</div>
				<!-- Row -->
				<div class="row">
					<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
						<div class="panel panel-default card-view pa-0">
							<div class="panel-wrapper collapse in">
								<div class="panel-body pa-0">
									<div class="sm-data-box bg-green">
										<div class="container-fluid">
											<div class="row">
												<div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
													<span class="txt-light block counter"><span class="counter-anim"><?php echo $benar;?></span></span>
													<span class="weight-500 uppercase-font txt-light block">Soal Benar</span>
												</div>
												<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
													<i class="zmdi zmdi-check txt-light data-right-rep-icon"></i>
												</div>
											</div>	
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
						<div class="panel panel-default card-view pa-0">
							<div class="panel-wrapper collapse in">
								<div class="panel-body pa-0">
									<div class="sm-data-box bg-red">
										<div class="container-fluid">
											<div class="row">
												<div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
													<span class="txt-light block counter"><span class="counter-anim"><?php echo $salah;?></span></span>
													<span class="weight-500 uppercase-font txt-light block">Soal Salah</span>
												</div>
												<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
													<i class="zmdi zmdi-close txt-light data-right-rep-icon"></i>
												</div>
											</div>	
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
						<div class="panel panel-default card-view pa-0">
							<div class="panel-wrapper collapse in">
								<div class="panel-body pa-0">
									<div class="sm-data-box bg-yellow">
										<div class="container-fluid">
											<div class="row">
												<div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
													<span class="txt-light block counter"><span class="counter-anim"><?php echo $skor; ?></span></span>
													<span class="weight-500 uppercase-font txt-light block">Nilai Diperoleh</span>
												</div>
												<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
													<i class="zmdi zmdi-file txt-light data-right-rep-icon"></i>
												</div>
											</div>	
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
						<div class="panel panel-default card-view pa-0">
							<div class="panel-wrapper collapse in">
								<div class="panel-body pa-0">
									<div class="sm-data-box bg-blue">
										<div class="container-fluid">
											<div class="row">
												<div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
													<span class="txt-light block counter"><span class="counter-anim"><font style="font-size: 20px"><?php echo  $ket_hasil;?></font></span></span>
													<span class="weight-500 uppercase-font txt-light block">Keterangan</span>
												</div>
												<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
													<i class="zmdi zmdi-graduation-cap txt-light data-right-rep-icon"></i>
												</div>
											</div>	
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php }?>
				
				<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default card-view">
								
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div class="table-wrap">
										<div class="table-responsive">
											<table class="table mb-0">
												<tbody>
													<tr>
														<td style="text-align: right"><a href="mulaiuc.php?idu=<?php echo $id_uc;?>"><button class="btn btn-info">Lanjut Materi Ujian Selanjutnya</button></a></td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
							</div>
						</div>
					</div>


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