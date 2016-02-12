<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PRIMAGAMA</title>
</head>

<body>
<?php
include "koneksi.php";

$periodebaru=$_GET['periodebaru'];

$insert=mysql_query("INSERT INTO periode(p_content) VALUES ('$periodebaru')");

if($insert){
	header ("location:periode.php");
	}
else{
	echo mysql_error();
	}
?>
</body>
</html>