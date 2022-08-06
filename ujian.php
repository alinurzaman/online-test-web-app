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
		$date = base64_decode(base64_decode($_GET['dt']));
		$id_materi = base64_decode(base64_decode($_GET['idm']));
		$get_materi = mysql_query("SELECT waktu_materi FROM materi WHERE id_materi='$id_materi'");
		$data_materi = mysql_fetch_array($get_materi);
		$id_uc = base64_decode(base64_decode($_GET['idu']));
		$delete = base64_decode(base64_decode($_GET['del'])); 
		$id_soal = base64_decode(base64_decode($_GET['ids']));
		$ret = base64_decode(base64_decode($_GET['ret']));
		$no = base64_decode(base64_decode($_GET['no']));
		$skor = base64_decode(base64_decode($_GET['sk']));
		$tj = base64_decode(base64_decode($_GET['tj']));
		$benar = base64_decode(base64_decode($_GET['b']));
		$salah = base64_decode(base64_decode($_GET['s']));
		
		if($delete=="T"){
			$delete_jawaban = mysql_query("DELETE FROM jawaban WHERE id_soal IN (SELECT id_soal FROM materi WHERE id_materi='$id_materi') AND id_siswa = '$id_siswa'");
			$delete = "Y";
		}
		if($date=="0"){
			$now = time();
			$waktu_ujian = $data_materi['waktu_materi'];
			$ten_minutes = $now + ($waktu_ujian * 60);
			$date = date('M d, Y H:i:s', strtotime("+". $waktu_ujian ."minutes", $now));
		}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<title>UC ONLINE LBB BEST | UJI COBA</title>
	<meta name="description" content="TO LBB BEST UJI COBA" />
	<script>
	function disp_confirm()
	{
		var r=confirm("Setelah klik selesai, Anda tidak bisa mengubah jawaban lagi dan akan diarahkan ke materi ujian berikutnya. Lanjutkan?")
		if (!r)
  		{
			return false;
  		}
		else
		{
			return true;
		}
	}
	</script>
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

	<script>
	// Set the date we're counting down to
	var countDownDate = new Date("<?php echo $date; ?>").getTime();

	// Update the count down every 1 second
	var x = setInterval(function() {

		// Get todays date and time
		var now = new Date().getTime();

		// Find the distance between now an the count down date
		var distance = countDownDate - now;

		// Time calculations for days, hours, minutes and seconds
		var days = Math.floor(distance / (1000 * 60 * 60 * 24));
		var hours = Math.floor((distance / (1000 * 60 * 60)) % 24);
		var minutes = Math.floor((distance / 1000 / 60) % 60);
		var seconds = Math.floor((distance / 1000) % 60);
		
		if (hours<10) hours = '0'+hours;
  		if (minutes<10) minutes = '0'+minutes;
  		if (seconds<10) seconds = '0'+seconds;

		// Output the result in an element with id="demo"
		document.getElementById("time").innerHTML = "Waktu tersisa: " +hours + " : "
		+ minutes + " : " + seconds;
		
		// If the count down is over, write some text 
		if (distance < 0) {
			clearInterval(x);
			document.getElementById("time").innerHTML = "EXPIRED";
			document.getElementById("finish").click();
		}

	}, 1000);
		
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
						$get_uc = mysql_query("SELECT * FROM uc WHERE id_uc='$id_uc'");
						$data_uc = mysql_fetch_array($get_uc);
						$get_materi = mysql_query("SELECT * FROM materi WHERE id_materi='$id_materi'");
						$data_materi = mysql_fetch_array($get_materi);
						$jml_soal = $data_materi['jmlsoal_materi'];
						$get_soal = mysql_query("SELECT * FROM soal WHERE id_soal='$id_soal'");
						$data_soal = mysql_fetch_array($get_soal);
						
						$date = base64_encode(base64_encode($date));
						$idm = base64_encode(base64_encode($id_materi));
						$idu = base64_encode(base64_encode($id_uc));
						$delete = base64_encode(base64_encode($delete));
						$previds = $id_soal - 1;
						$nextids = $id_soal + 1;
						$ids = base64_encode(base64_encode($id_soal));
						$previds = base64_encode(base64_encode($previds));
						$nextids = base64_encode(base64_encode($nextids));
						
						$prev = $no - 1;
						$next = $no + 1;
						$prev = base64_encode(base64_encode($prev));
						$next = base64_encode(base64_encode($next));
						$get_jawaban = mysql_query("SELECT * FROM jawaban WHERE id_soal = '$id_soal' AND id_siswa = '$id_siswa'");
						$data_jawaban = mysql_fetch_array($get_jawaban);
						$ada_jawaban = mysql_num_rows($get_jawaban);
				?>
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default card-view">
								
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div class="table-wrap">
										<div class="table-responsive">
											<table class="table table-hover table-bordered mb-0">
												<thead>
													<tr>
													<th colspan="10" style="text-align: center">
														<h4><?php echo $data_uc['nama_uc'] . " - " . $data_materi['ujian_materi'];?></h4>
														<p style="font-size: 20px" id="time"></p>
													</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td colspan="10"><strong>No. <?php echo $no; ?> dari <?php echo $data_materi['jmlsoal_materi']; ?> soal</strong></td>
													</tr>
													<tr>
														<td colspan="10">
														<img src="<?php echo $data_soal['upload_soal'];?>">
														<br>
														<div class="col-md-6">
																<form action="" class="form-horizontal" method="post">
																	<div class="form-body">
																		<div class="row">
																			<div class="col-md-4">
																				<input type="text" class="form-control" name="jawaban" placeholder="Jawaban : A/B/C/D/E" maxlength="1" size="1" style="text-transform: uppercase" value="<?php if($ada_jawaban>0){echo $data_jawaban['pilihan_jawaban'];}?>">
																			</div>

																			<div class="col-md-2">
																				<button name="simpan" type="submit" class="btn btn-danger">Simpan & Selanjutnya</button>
																			</div>
																		</div>
																	</div>
																</form>
															</div>
														</td>
													</tr>
													<tr>
														<?php
															$ret2 = base64_encode(base64_encode($ret));
															$tj2 = base64_encode(base64_encode($tj));
															$skor2 = base64_encode(base64_encode($skor));
															$benar2 = base64_encode(base64_encode($benar));
															$salah2 = base64_encode(base64_encode($salah));
														?>
														<td colspan="4">
															<?php 
															if($no!="1"){ 
																$linkprev = "ujian.php?idm=".$idm."&idu=".$idu."&del=".$delete."&ids=".$previds."&no=".$prev."&ret=".$ret2."&dt=".$date."&sk=".$skor2."&tj=".$tj2."&b=".$benar2."&s=".$salah2;
															?>
															<a href="<?php echo $linkprev;?>"><button class="btn btn-primary">Soal Sebelumnya</button></a>
															&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
															<?php } ?>
															<?php 
															if($no < $jml_soal){ 
																$linknext = "ujian.php?idm=".$idm."&idu=".$idu."&del=".$delete."&ids=".$nextids."&no=".$next."&ret=".$ret2."&dt=".$date."&sk=".$skor2."&tj=".$tj2."&b=".$benar2."&s=".$salah2;
															?>
															<a href="<?php echo $linknext;?>"><button class="btn btn-primary">Soal Selanjutnya</button></a>
															<?php } ?>
														</td>
														<td colspan="6" style="text-align: right">
															<form name="selesai" id="selesai" method="post" action="">
																<strong>Jika anda sudah selesai ujian, silahkan klik: </strong>
																<button type="submit" name="finish" id="finish" class="btn btn-warning" onclick="return disp_confirm();">Selesai</button>
															</form>
														</td>
													</tr>
													<tr>
														<td colspan="10"><strong>Keterangan</strong><br>- Belum dijawab : Warna merah<br>
															- Sudah dijawab : Warna hijau</td>
													</tr>
													<?php 
													$arrid = array();
													$get_idsoal = mysql_query("SELECT id_soal FROM soal WHERE id_materi = '$id_materi'");
													$ii=0;
													while ($data_idsoal = mysql_fetch_array($get_idsoal)){
														$arrid[$ii] = $data_idsoal['id_soal'];
														$ii++;
													}
													for($isoal = 1; $isoal<=$data_materi['jmlsoal_materi']; $isoal++){ 
														if(($isoal % 10) == 1){?>
														<tr>
														<?php }
															$idsoalloncat = $arrid[$isoal-1];
															$cek_jawaban = mysql_query("SELECT * FROM jawaban WHERE id_soal = '$idsoalloncat' AND id_siswa = '$id_siswa'");
															$ada_cek = mysql_num_rows($cek_jawaban);

															$noloncat = base64_encode(base64_encode($isoal));
															$idsoalloncat = base64_encode(base64_encode($idsoalloncat));
															$linkloncat = "ujian.php?idm=".$idm."&idu=".$idu."&del=".$delete."&ids=".$idsoalloncat."&no=".$noloncat."&ret=".$ret2."&dt=".$date."&sk=".$skor2."&tj=".$tj2."&b=".$benar2."&s=".$salah2;
															if ($ada_cek>0) {
															?>
															<td><a href="<?php echo $linkloncat;?>"><button class="btn btn-success"><?php echo $isoal;?></button></a></td>
															<?php } else {?> 
															<td><a href="<?php echo $linkloncat;?>"><button class="btn btn-info"><?php echo $isoal;?></button></a></td>
														<?php } if(($isoal % 10) == 0 || $isoal == $data_materi['jmlsoal_materi']){?>
														</tr>
													<?php } }?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
							</div>
						</div>
					</div>
				<!-- Row -->
			</div>
			<?php if(isset($_POST['simpan'])==true){
					$jawaban = strtoupper($_POST['jawaban']);
					if($ada_jawaban>0){
						$jawaban1 = $data_jawaban['pilihan_jawaban'];
						if($tj=="1"){
							$get_kunci = mysql_query("SELECT * FROM kunci WHERE id_soal = '$id_soal'");
						}
						else if($tj=="5"){
							$get_kunci = mysql_query("SELECT * FROM kunci WHERE id_soal = '$id_soal' AND jawaban_kunci = '$jawaban1'");
						}
						$data_kunci = mysql_fetch_array($get_kunci);
						if($jawaban1!=""){ //cek jawaban sebelumnya
							if($jawaban1 == $data_kunci['jawaban_kunci']){ //artinya jawaban sebelumnya benar
								$skor = $skor - $data_kunci['poinbenar_kunci'];
								$benar = $benar - 1;
							}
							else if ($jawaban1 != $data_kunci['jawaban_kunci']){ //artinya jawaban sebelumnya salah
								$skor = $skor + $data_kunci['poinsalah_kunci'];
								$salah = $salah - 1;
							}
						}
						if($jawaban!=""){ //cek jawaban saat ini
							if($jawaban == $data_kunci['jawaban_kunci']){ //artinya jawaban saat ini benar
								$skor = $skor + $data_kunci['poinbenar_kunci'];
								$benar = $benar + 1;
							}
							else if ($jawaban != $data_kunci['jawaban_kunci']){ //artinya jawaban saat ini salah
								$skor = $skor - $data_kunci['poinsalah_kunci'];
								$salah = $salah + 1;
							}
						}
						$update_jawaban = mysql_query("UPDATE jawaban SET pilihan_jawaban='$jawaban' WHERE id_siswa = '$id_siswa' AND id_soal = '$id_soal'");
					}
					else{
						if($tj=="1"){
							$get_kunci = mysql_query("SELECT * FROM kunci WHERE id_soal = '$id_soal'");
						}
						else if($tj=="5"){
							$get_kunci = mysql_query("SELECT * FROM kunci WHERE id_soal = '$id_soal' AND jawaban_kunci = '$jawaban'");
						}
						$data_kunci = mysql_fetch_array($get_kunci);
						if($jawaban!=""){ //cek jawaban saat ini
							if($jawaban == $data_kunci['jawaban_kunci']){ //artinya jawaban saat ini benar
								$skor = $skor + $data_kunci['poinbenar_kunci'];
								$benar = $benar + 1;
							}
							else if ($jawaban != $data_kunci['jawaban_kunci']){ //artinya jawaban saat ini salah
								$skor = $skor - $data_kunci['poinsalah_kunci'];
								$salah = $salah + 1;
							}
						}
						$insert_jawaban = mysql_query("INSERT INTO jawaban VALUES(NULL, '$jawaban', '$id_siswa', '$id_soal')");
					}
					
					if($ret==0){ //artinya ini ujian pertama
						$get_hasil = mysql_query("SELECT * FROM hasil WHERE id_siswa='$id_siswa' AND id_materi='$id_materi'");
						$ada_hasil = mysql_num_rows($get_hasil);
						$kosong = $data_materi['jmlsoal_materi'] - $benar - $salah;
						if($skor >= $data_materi['batasnilai_materi']){
							$ket_hasil = "LULUS";
						}
						else {
							$ket_hasil = "TIDAK LULUS";
						}
						
						if($ada_hasil>0){
							$update_hasil = mysql_query("UPDATE hasil SET benar_hasil = '$benar', salah_hasil = '$salah', kosong_hasil = '$kosong', nilai_hasil = '$skor', ket_hasil = '$ket_hasil' WHERE id_siswa = '$id_siswa' AND id_materi = '$id_materi'");
						}
						else {
							$insert_hasil = mysql_query("INSERT INTO hasil VALUES(NULL, '$benar', '$kosong', '$salah', '$skor', '$ket_hasil', '$id_siswa', '$id_materi')");
						}
					}
					$retn = base64_encode(base64_encode($ret));
					$tjn = base64_encode(base64_encode($tj));
					$skorn = base64_encode(base64_encode($skor));
					$benarn = base64_encode(base64_encode($benar));
					$salahn = base64_encode(base64_encode($salah));
					if($no < $jml_soal){
						header("Location: ujian.php?idm=".$idm."&idu=".$idu."&del=".$delete."&ids=".$nextids."&no=".$next."&ret=".$retn."&dt=".$date."&sk=".$skorn."&tj=".$tjn."&b=".$benarn."&s=".$salahn);
					}
					else{
						$no = base64_encode(base64_encode($no));
						header("Location: ujian.php?idm=".$idm."&idu=".$idu."&del=".$delete."&ids=".$ids."&no=".$no."&ret=".$retn."&dt=".$date."&sk=".$skorn."&tj=".$tjn."&b=".$benarn."&s=".$salahn);
					}
				}
			?>
			<?php
				if(isset($_POST['finish'])==true){
					$retn = base64_encode(base64_encode($ret));
					$tjn = base64_encode(base64_encode($tj));
					$skorn = base64_encode(base64_encode($skor));
					$benarn = base64_encode(base64_encode($benar));
					$salahn = base64_encode(base64_encode($salah));
					header("Location: hasilujian.php?idm=".$idm."&idu=".$idu."&ret=".$retn."&sk=".$skorn."&b=".$benarn."&s=".$salahn);
				}
			?>
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