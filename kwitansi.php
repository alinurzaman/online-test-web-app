<?php
	session_start();
	if($_SESSION['sudahlogin']==true){
		include("db-connect.php");
		koneksi_db();
		date_default_timezone_set('Asia/Jakarta');
		$id_karyawan = $_SESSION['user'];
		$id_siswa = $_GET['id'];
		$id_transaksi = $_GET['trx'];
		$id_pembayaran = $_GET['idb'];
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>SIAP | CETAK KUITANSI</title>
</head>

<body>
	<?php
		$get_siswa = mysql_query("SELECT * FROM siswa WHERE id_siswa = '$id_siswa'");
		$data_siswa = mysql_fetch_array($get_siswa);
		$get_karyawan = mysql_query("SELECT * FROM karyawan WHERE id_karyawan = '$id_karyawan'");
		$data_karyawan = mysql_fetch_array($get_karyawan);
		$id_cabang = $data_karyawan['id_cabang'];
		$get_cabang = mysql_query("SELECT * FROM cabang WHERE id_cabang = '$id_cabang'");
		$data_cabang = mysql_fetch_array($get_cabang);
		$get_trx = mysql_query("SELECT * FROM transaksi WHERE id_transaksi = '$id_transaksi'");
		$data_trx = mysql_fetch_array($get_trx);
		$get_bayar = mysql_query("SELECT * FROM pembayaran WHERE id_pembayaran = '$id_pembayaran'");
		$data_bayar = mysql_fetch_array($get_bayar);
		$tanggal = $data_trx['tgl_transaksi'];
		$tanggal = date("d-m-Y", strtotime($tanggal));
	?>
	<table style="width: 100%; font-family: 'Courier New';">
		<tr>
			<td colspan="4" align="right"><font size="-1"><i>(Lembar untuk siswa)</i></font></td>
		</tr>
		<tr>
			<td rowspan="3" align="center"><img src="dist/img/Best 3D.png" width="70"></td>
			<td colspan="3"><font size="+2"><strong><?php echo $data_cabang['nama_cabang'];?></strong></font></td>
		</tr>
		<tr>
			<td colspan="3"><font size="-1">ALAMAT: <?php echo $data_cabang['alamat_cabang']; ?></font></td>
		</tr>
		<tr>
			<td colspan="3"><font size="-1">TELP.: <?php echo $data_cabang['telp_cabang']; ?></font></td>
		</tr>
		<tr>
			<td colspan="4"><hr style="border-top: 3px double"></td>
		</tr>
		<tr>
			<td colspan="4" align="right">Kuitansi No.: <strong><u><?php echo $id_transaksi; ?></u></strong></td>
		</tr>
		<tr>
			<td style="padding-top: 30px" width="25%">Telah terima dari</td>
			<td style="padding-top: 30px" width="1%">:</td>
			<td style="padding-top: 30px" colspan="2"><?php echo $data_siswa['nama_siswa'] . " (ID: " . $data_siswa['id_siswa'] . ")";?></td>
		</tr>
		<tr>
			<td>Uang sejumlah</td>
			<td>:</td>
			<td colspan="2"><?php echo "Rp " . number_format($data_trx['nominal_transaksi'],0,",",".");?></td>
		</tr>
		<tr>
			<td valign="top">Untuk pembayaran</td>
			<td valign="top">:</td>
			<td colspan="2"><?php echo $data_trx['ket_transaksi'] . ". STATUS: " . $data_bayar['status_pembayaran'] . ".";?></td>
		</tr>
		<tr>
			<td style="padding-top: 30px" colspan="3"></td>
			<td style="padding-top: 30px" width="35%" align="center"><?php echo $data_cabang['kota_cabang'] . ", " . $tanggal;?></td>
		</tr>
		<tr>
			<td style="padding-top: 50px" colspan="3"></td>
			<td align="center" style="padding-top: 60px"><u><strong><?php echo $data_karyawan['nama_karyawan'];?></strong></u></td>
		</tr>
		<tr>
			<td colspan="3"></td>
			<td align="center">(Customer Service)</td>
		</tr>
		<tr>
			<td colspan="4" style="padding-top: 20px; padding-bottom: 20px"><hr style="border-top: dashed; position: relative"></td>
		</tr>
		<tr>
			<td colspan="4" align="right"><font size="-1"><i>(Lembar untuk LBB BEST)</i></font></td>
		</tr>
		<tr>
			<td rowspan="3" align="center"><img src="dist/img/Best 3D.png" width="70"></td>
			<td colspan="3"><font size="+2"><strong><?php echo $data_cabang['nama_cabang'];?></strong></font></td>
		</tr>
		<tr>
			<td colspan="3"><font size="-1">ALAMAT: <?php echo $data_cabang['alamat_cabang']; ?></font></td>
		</tr>
		<tr>
			<td colspan="3"><font size="-1">TELP.: <?php echo $data_cabang['telp_cabang']; ?></font></td>
		</tr>	
		<tr>
			<td colspan="4"><hr style="border-top: 3px double"></td>
		</tr>
		<tr>
			<td colspan="4" align="right">Kuitansi No.: <strong><u><?php echo $id_transaksi; ?></u></strong></td>
		</tr>
		<tr>
			<td style="padding-top: 30px" width="25%">Telah terima dari</td>
			<td style="padding-top: 30px" width="1%">:</td>
			<td style="padding-top: 30px" colspan="2"><?php echo $data_siswa['nama_siswa'] . " (ID: " . $data_siswa['id_siswa'] . ")";?> </td>
		</tr>
		<tr>
			<td>Uang sejumlah</td>
			<td>:</td>
			<td colspan="2"><?php echo "Rp " . number_format($data_trx['nominal_transaksi'],0,",",".");?></td>
		</tr>
		<tr>
			<td valign="top">Untuk pembayaran</td>
			<td valign="top">:</td>
			<td colspan="2"><?php echo $data_trx['ket_transaksi'] . ". STATUS: " . $data_bayar['status_pembayaran'] . ".";?></td>
		</tr>
		<tr>
			<td style="padding-top: 30px" colspan="3"></td>
			<td style="padding-top: 30px" width="35%" align="center"><?php echo $data_cabang['kota_cabang'] . ", " . $tanggal;?></td>
		</tr>
		<tr>
			<td style="padding-top: 50px" colspan="3"></td>
			<td align="center" style="padding-top: 60px"><u><strong><?php echo $data_karyawan['nama_karyawan'];?></strong></u></td>
		</tr>
		<tr>
			<td colspan="3"></td>
			<td align="center">(Customer Service)</td>
		</tr>
		<tr>
			<td colspan="4" align="center"><a href="statuspembayaran.php">Tutup</a></td>
		</tr>
	</table>
</body>
</html>
<?php
	}
	else header("Location: index.php");
?>