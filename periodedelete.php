<?php
include "koneksi.php";
$periodehapus=$_GET['periodehapus'];
$delete=mysql_query("DELETE FROM  periode WHERE periode.id_periode=$periodehapus");


if($delete){
	header ("location:periode.php");
	}
else{
	echo mysql_error();
	}
?>