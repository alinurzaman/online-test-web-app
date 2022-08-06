<?php
include("db-connect.php");

if(!$_POST) exit;

koneksi_db();

$user = mysql_real_escape_string($_POST['user']);
$pass = mysql_real_escape_string($_POST['pass']);

$res=mysql_query("SELECT * FROM siswa WHERE id_siswa='$user' and password_siswa=PASSWORD('$pass')");

		if(mysql_num_rows($res)==1){

					$data=mysql_fetch_array($res);
					session_start();
					$_SESSION['user']=$data['id_siswa'];
					$_SESSION['cabang']=$data['id_cabang'];
					$_SESSION['sudahlogin']=true;
					header("Location: index.php");
		}
		else{
			header("Location: login.html");
		} 

?>