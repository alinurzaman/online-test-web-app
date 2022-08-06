<?php
	session_start();
	if($_SESSION['sudahlogin']==true){
		include("db-connect.php");
		koneksi_db();
		date_default_timezone_set('Asia/Jakarta');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<title>SIAP | INPUT SISWA BARU</title>
	<meta name="description" content="SIAP INPUT SISWA BARU" />
	
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
		<!--Preloader-->
		<div class="preloader-it">
			<div class="la-anim-1"></div>
		</div>
		<!--/Preloader-->
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
						<a class="active" href="inputsiswabaru.php"><div class="pull-left"><i class="zmdi zmdi-account-add mr-20"></i><span class="right-nav-text">Input Siswa Baru</span></div><div class="clearfix"></div></a>
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
						<a href="statuspembayaran.php"><div class="pull-left"><i class="zmdi zmdi-assignment-check mr-20"></i><span class="right-nav-text">Status Pembayaran</span></div><div class="clearfix"></div></a>
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
							<h5 class="txt-dark">Input Siswa Baru</h5>
						</div>
					</div>
					<!-- /Title -->

					<!-- Row -->
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default card-view">
								<div class="panel-heading">
									<div class="pull-left">
										<h6 class="panel-title txt-dark">Form Pendaftaran Siswa</h6>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="panel-wrapper collapse in">
									<div class="panel-body">
										<div class="row">
											<div class="col-md-12">
												<div class="form-wrap">
													<form action="" class="form-horizontal" method="post">
														<div class="form-body">
															<h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-account mr-10"></i>Data Diri</h6>
															<hr class="light-grey-hr"/>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Nama Lengkap</label>
																		<div class="col-md-9">
																			<input name="nama" type="text" class="form-control" maxlength="50" value="<?php if(isset($_POST['nama'])) echo $_POST['nama'];?>">
																		</div>
																	</div>
																</div>
																<!--/span-->
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Tempat Lahir</label>
																		<div class="col-md-9">
																			<input name="tempatlahir" type="text" class="form-control" maxlength="20" value="<?php if(isset($_POST['tempatlahir'])) echo $_POST['tempatlahir'];?>">
																		</div>
																	</div>
																</div>
																<!--/span-->
															</div>
															<!-- /Row -->
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Gender</label>
																		<div class="col-md-9">
																			<select name="gender" class="form-control">
																				<option value="L" <?php if(isset($_POST['gender'])=="L") echo "selected";?>> Laki-laki</option>
																				<option value="P" <?php if(isset($_POST['gender'])=='P') echo "selected"; ?>>Perempuan</option>
																			</select>
																		</div>
																	</div>
																</div>
																<!--/span-->
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Tanggal Lahir</label>
																		<div class="col-md-9">
																			<input name="tanggallahir" type="text" placeholder="" data-mask="99/99/9999" class="form-control" value="<?php if(isset($_POST['tanggallahir'])) echo $_POST['tanggallahir'];?>">
																		</div>
																	</div>
																</div>
																<!--/span-->
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Alamat</label>
																		<div class="col-md-9">
																			<input name="alamat" type="text" class="form-control" value="<?php if (isset($_POST['alamat'])) echo $_POST['alamat'];?>">
																		</div>
																	</div>
																</div>
																<!--/span-->
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">No. HP</label>
																		<div class="col-md-9">
																			<input name="hp" type="text" class="form-control" maxlength="13" value="<?php if (isset($_POST['hp'])) echo $_POST['hp'];?>">
																		</div>
																	</div>
																</div>
																<!--/span-->
															</div>

															<!-- /Row -->
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Asal Sekolah</label>
																		<div class="col-md-9">
																			<input name="sekolah" type="text" class="form-control" value="<?php if (isset($_POST['sekolah'])) echo $_POST['sekolah'];?>">
																		</div>
																	</div>
																</div>
															</div>
															
															<div class="seprator-block"></div>
															
															<h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-accounts mr-10"></i>Data Orang Tua</h6>
															<hr class="light-grey-hr"/>
															<!-- /Row -->
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Nama Ortu</label>
																		<div class="col-md-9">
																			<input name="ortu" type="text" class="form-control" maxlength="50" value="<?php if (isset($_POST['ortu'])) echo $_POST['ortu'];?>">
																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">No. HP Ortu</label>
																		<div class="col-md-9">
																			<input name="hportu" type="text" class="form-control" maxlength="13" value="<?php if (isset($_POST['hportu'])) echo $_POST['hportu'];?>">
																		</div>
																	</div>
																</div>
															</div>
															<div class="seprator-block"></div>
															
															<h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-book mr-10"></i>Program Bimbel</h6>
															<hr class="light-grey-hr"/>
															<!-- /Row -->
															
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Pilih Kelas</label>
																		<div class="col-md-9">
																			<select class="form-control select2" name="kelas">
																				<?php
																					$id_karyawan = $_SESSION['user'];
																					$id_cabang = $_SESSION['cabang'];
																					$cek = "SELECT * FROM program WHERE status_program ='AKTIF'";
																					$cek = mysql_query($cek);
																					$banyakrecord=mysql_num_rows($cek); 
																					if($banyakrecord>0){ 
																						while($data=mysql_fetch_array($cek)){?>
																							<optgroup label="<?php echo $data['nama_program'];?> - <?php echo number_format($data['biaya_program'],0,",",".");?>">
																								<?php
																								$id_program = $data['id_program'];
																								$cekkelas = "SELECT * FROM kelas WHERE sisa_kelas > 0 AND id_cabang='$id_cabang' AND id_program='$id_program'";
																								$cekkelas = mysql_query($cekkelas);
																								while($datakelas=mysql_fetch_array($cekkelas)){
																								?>
																								<option value="<?php echo $datakelas['id_kelas']; ?>"><?php echo $datakelas['nama_kelas'] . " (". $datakelas['masuk_kelas'] . "-" . $datakelas['keluar_kelas'] . " | Sisa: " . $datakelas['sisa_kelas'] . " siswa)"?></option>
																								<?php } ?>
																							</optgroup>
																				<?php }} ?>
																			</select>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="form-actions mt-10">
															<div class="row">
																<div class="col-md-6">
																	<div class="row">
																		<div class="col-md-offset-3 col-md-9">
																			<button name="simpan" type="submit" class="btn btn-success  mr-10">Submit</button>
																		</div>
																	</div>
																</div>
																<div class="col-md-6"> </div>
															</div>
														</div>
													</form>
													<?php
														if (isset($_POST['simpan'])==true){
															$nama = $_POST['nama'];
															$gender = $_POST['gender'];
															$alamat = $_POST['alamat'];
															$tempatlahir = $_POST['tempatlahir'];
															$tanggallahir = $_POST['tanggallahir'];
															$hp = $_POST['hp'];
															$sekolah = $_POST['sekolah'];
															$ortu = $_POST['ortu'];
															$hportu = $_POST['hportu'];
															$kelas = $_POST['kelas'];
															if($nama!="" && $gender!="" && $alamat!="" && $tempatlahir!="" && $tanggallahir!="" && $hp!="" && $sekolah!="" && $ortu!="" && $hportu!="")
															{
																$today = new DateTime();
																$id_siswa = $today->format("ym");
																$cekidsiswa = mysql_query("SElECT id_siswa FROM siswa WHERE id_siswa LIKE '$id_siswa%'");
    															$banyakid = mysql_num_rows($cekidsiswa);
																$id_siswa = $id_siswa . "0000";
																$id_siswa = (int)$id_siswa;
																$id_siswa = $id_siswa + $banyakid + 1;
																$tgl_lahir = strtotime($tanggallahir);
																$newtgl_lahir = date('Y-d-m',$tgl_lahir);
																
																//echo $id_siswa . "/" . $nama . "/" .$gender . "/" . $tempatlahir . "/" . $newtgl_lahir . "/" . $hp . "/" . $alamat . "/" . $sekolah . "/" . $ortu . "/" . $hportu . "/" . $id_karyawan;
																$masuk=mysql_query("INSERT INTO siswa VALUES('$id_siswa', '$nama','$gender', '$tempatlahir', '$newtgl_lahir', '$hp', '$alamat', '$sekolah', '$ortu', '$hportu', '$id_karyawan')");
																if($masuk){ 
																		$masukkelas = mysql_query("INSERT INTO pelanggan VALUES('$id_siswa', '$kelas')");
																		if($masukkelas){
																			$updatekelas = mysql_query("UPDATE kelas SET sisa_kelas = sisa_kelas-1 WHERE id_kelas='$kelas'");
																			$get_biaya = mysql_query("SELECT biaya_program FROM program WHERE id_program = (SELECT id_program FROM kelas WHERE id_kelas = '$kelas')");
																			$data_biaya = mysql_fetch_array($get_biaya);
																			$biaya_awal = $data_biaya['biaya_program'];
																			$insertbayar = mysql_query("INSERT INTO pembayaran VALUES(NULL, 'BELUM LUNAS', '$biaya_awal', '0', '$biaya_awal', '0', '$id_siswa', '$kelas')");
																			
																			$get_idbayar = mysql_query("SELECT id_pembayaran FROM pembayaran WHERE id_siswa='$id_siswa' AND id_kelas='$kelas'");
																			
																			$data_idbayar = mysql_fetch_array($get_idbayar);
																			$idbayar = $data_idbayar['id_pembayaran'];
																			if($updatekelas){
																				header("Location: cicilanbaru.php?id=$id_siswa&kls=$kelas&idb=$idbayar");
																			}
																			else{echo '<script language="javascript">alert("Gagal update kelas, silahkan coba lagi!");</script>';}
																		}
																		else{echo '<script language="javascript">alert("Siswa gagal masuk kelas, silahkan coba lagi!");</script>';}
																} 
																else {
																		echo '<script language="javascript">alert("Terjadi kesalahan, silahkan coba lagi!");</script>';
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
	else header("Location: login.html");
?>