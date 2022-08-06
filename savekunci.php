<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
$result = $db_handle->executeUpdate("UPDATE kunci SET " . $_POST["column"] . " = '".$_POST["editval"]."' WHERE  id_kunci=".$_POST["id"]);
?>