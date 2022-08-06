<?php function koneksi_db() {
		$host="localhost";
		$database="dbujicoba";
		$user="root";
		$password="";
		$link=mysql_connect($host, $user, $password);
		mysql_select_db($database, $link);
		if (!$link) { 
			die('Could not connect to MySQL: ' . mysql_error()); 
		} 
		return $link;
}
?>