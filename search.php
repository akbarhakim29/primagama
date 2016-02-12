<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PRIMAGAMA</title>
</head>

<body>
<?php
include "session.php";
include "koneksi.php";

$idhal=$_GET["idhal"];
$periode = $_GET["id_periode"];
$nama=$_POST['search'];

$sql=mysql_query("SELECT * from biodata_siswa 
					JOIN kelas on biodata_siswa.id_kelas=kelas.id_kelas
					JOIN periode on periode.id_periode=biodata_siswa.id_periode
					where kelas.id_kelas=$idhal and periode.id_periode = $periode and nama LIKE '%$nama%'");

$bacasql=mysql_fetch_array($sql);


if ($bacasql){
	
	header ("location:profil.php?idhal=$idhal&id_periode=$periode");
	}
else {
	echo mysql_error();}

?>
</body>
</html>