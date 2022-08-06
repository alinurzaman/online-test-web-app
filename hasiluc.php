<?php
	ob_start();
	session_start();
	if($_SESSION['sudahlogin']==true && substr($_SESSION['user'], 0, 5) == "ADMIN"){
		include("db-connect.php");
		koneksi_db();
		$id_siswa = $_SESSION['user'];
		$get_siswa = mysql_query("SELECT * FROM siswa WHERE id_siswa='$id_siswa'");
		$data_siswa = mysql_fetch_array($get_siswa);
		$id_cabang = $data_siswa['id_cabang'];
		date_default_timezone_set('Asia/Jakarta');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<title>UC ONLINE LBB BEST | HASIL UC</title>
	<meta name="description" content="TO LBB BEST HASIL UC" />
	
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
				<?php } ?>
			</ul>
		</div>
		<!-- /Left Sidebar Menu -->
		
        <!-- Main Content -->
		<div class="page-wrapper">
            <div class="container-fluid">
				
				<!-- Row -->
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default card-view">
								<div class="panel-heading">
									<div class="pull-left">
										<h6 class="panel-title txt-dark">Hasil UC</h6>
									</div>
									<div class="clearfix"></div>
								</div>
								<form method="post" action="">
									<div class="col-md-4">
										<select class="form-control select2" name="uc">
										<?php
											$cek = mysql_query("SELECT id_uc, nama_uc FROM uc");
											$banyakrecord=mysql_num_rows($cek); 
											if($banyakrecord>0){ 
												while($data=mysql_fetch_array($cek)){?>
													<option value="<?php echo $data['id_uc'];?>">
														<?php echo $data['nama_uc'];?>
													</option>
											<?php }} ?>
										</select>
									</div>
									<div class="col-md-4">
										<button name="cari" type="submit" class="btn btn-success  mr-10">Tampilkan</button>
									</div>
								</form>
								<div class="clearfix"></div>
								<br>
							<?php if(isset($_POST['cari'])==true){
												$id_uc = $_POST['uc'];
												$get_materi = mysql_query("SELECT id_materi, ujian_materi FROM materi WHERE NOT tipe_materi='PEMBAHASAN' AND id_uc='$id_uc'");
												$nmateri = mysql_num_rows($get_materi);
												$arr = array();
												$nama = array();
												while($data_materi=mysql_fetch_array($get_materi)){
													$arr[]=$data_materi['id_materi'];
													$nama[]=$data_materi['ujian_materi'];
												}
												if($nmateri==5){
													$col = "SELECT t0.id_siswa AS id, t0.nama_siswa AS nama, t1.benar_hasil AS b1, t1.salah_hasil AS s1, t1.nilai_hasil AS n1, t2.benar_hasil AS b2, t2.salah_hasil AS s2, t2.nilai_hasil AS n2, t3.benar_hasil AS b3, t3.salah_hasil AS s3, t3.nilai_hasil AS n3, t4.benar_hasil AS b4, t4.salah_hasil AS s4, t4.nilai_hasil AS n4, t5.benar_hasil AS b5, t5.salah_hasil AS s5, t5.nilai_hasil AS n5, t6.ket_hasiluc AS ket";
													$sel0 = "(SELECT * FROM siswa WHERE id_siswa NOT LIKE '%ADMIN%') t0";
													$sel1 = "(SELECT * FROM hasil WHERE id_materi='" . $arr[0]. "') t1 ON t0.id_siswa = t1.id_siswa";
													$sel2 = "(SELECT * FROM hasil WHERE id_materi='" . $arr[1]. "') t2 ON t1.id_siswa = t2.id_siswa";
													$sel3 = "(SELECT * FROM hasil WHERE id_materi='" . $arr[2]. "') t3 ON t2.id_siswa = t3.id_siswa";
													$sel4 = "(SELECT * FROM hasil WHERE id_materi='" . $arr[3]. "') t4 ON t3.id_siswa = t4.id_siswa";
													$sel5 = "(SELECT * FROM hasil WHERE id_materi='" . $arr[4]. "') t5 ON t4.id_siswa = t5.id_siswa";
													$sel6 = "(SELECT * FROM hasiluc WHERE id_uc='$id_uc') t6 ON t5.id_siswa = t6.id_siswa";
													$query = $col . " FROM " . $sel0 . " LEFT JOIN " . $sel1 . " LEFT JOIN " . $sel2 . " LEFT JOIN " . $sel3 . " LEFT JOIN " . $sel4 . " LEFT JOIN " . $sel5 . " LEFT JOIN " . $sel6 ; 
												}
												$get_hasil = mysql_query($query);
							?>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<?php if ($nmateri==5){?>
									<a target="_blank" href="eksporhasil5.php?idu=<?php echo $id_uc; ?>"><button class="btn btn-success"><span class="btn-text">Ekspor ke Excel</span></button></a>
									<?php }?>
									<div class="table-wrap">
										<div class="table-responsive">
											<table id="datable_2" class="table table-hover table-bordered display mb-30" >
												<thead>
													<tr>
														<th rowspan="2">ID SISWA</th>
														<th rowspan="2">NAMA</th>
														<?php for ($i=0; $i<$nmateri; $i++){?>
														<th colspan="3"><?php echo $nama[$i]; ?></th>
														<?php } ?>
														<th rowspan="2">TOTAL NILAI</th>
														<th rowspan="2">KET.</th>
													</tr>
													<tr>
														<?php for ($i=0; $i<$nmateri; $i++){?>
														<th>B</th>
														<th>S</th>
														<th>NILAI</th>
														<?php } ?>
													</tr>
												</thead>
												<tbody>
													<?php while($data_hasil = mysql_fetch_array($get_hasil)){?>
													<tr>
														<td><?php echo $data_hasil['id']; ?></td>
														<td><?php echo $data_hasil['nama']; ?></td>
														<td><?php echo $data_hasil['b1']; ?></td>
														<td><?php echo $data_hasil['s1']; ?></td>
														<td><?php echo $data_hasil['n1']; ?></td>
														<td><?php echo $data_hasil['b2']; ?></td>
														<td><?php echo $data_hasil['s2']; ?></td>
														<td><?php echo $data_hasil['n2']; ?></td>
														<td><?php echo $data_hasil['b3']; ?></td>
														<td><?php echo $data_hasil['s3']; ?></td>
														<td><?php echo $data_hasil['n3']; ?></td>
														<td><?php echo $data_hasil['b4']; ?></td>
														<td><?php echo $data_hasil['s4']; ?></td>
														<td><?php echo $data_hasil['n4']; ?></td>
														<td><?php echo $data_hasil['b5']; ?></td>
														<td><?php echo $data_hasil['s5']; ?></td>
														<td><?php echo $data_hasil['n5']; ?></td>
														<td><?php $total = $data_hasil['n1'] + $data_hasil['n2'] + $data_hasil['n3'] + $data_hasil['n4'] + $data_hasil['n5']; echo($total);?></td>
														<td><?php echo $data_hasil['ket']; ?></td>
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