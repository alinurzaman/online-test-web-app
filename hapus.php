<?php
ob_start();
	include("db-connect.php");
	koneksi_db();
	$index=$_GET['id'];
	$hapus=mysql_query("DELETE FROM uc WHERE id_uc='$index'");
	if($hapus) header("Location: inputmateri.php");
ob_end_flush();
?>