<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
$result = $db_handle->executeUpdate("UPDATE materi set " . $_POST["column"] . " = '".$_POST["editval"]."' WHERE  id_materi=".$_POST["id"]);
?>