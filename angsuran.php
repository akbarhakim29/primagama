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
	
	$id_user = $_GET["id"];
	$idhal=$_GET["idhal"];
	$periode = $_GET["id_periode"];
	$angsuran=$_POST["angsuran"];
	$biaya=$_POST["biaya"];

if($_POST['angsuran'] && $_POST['biaya']){
		$query=mysql_query("insert into angsuran_siswa(id,id_kelas,id_periode,tanggal,angsuran_ke,biaya) VALUES ('$id_user','$idhal','$periode',NOW(),'$angsuran','$biaya')");
}
if($query){
	header ("location:profilsiswa.php?id=$id_user&idhal=$idhal&id_periode=$periode");
	}
else{
	mysql_error();
	}
?>		
</body>
</html>