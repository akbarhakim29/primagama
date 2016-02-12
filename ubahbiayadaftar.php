<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
include "session.php";
include "koneksi.php";

$idhal=$_GET["idhal"];
$periode = $_GET["id_periode"];


if(isset($_POST['biayadaftar'])){
$biayadaftar=$_POST['biayadaftar'];
$update=mysql_query("UPDATE biodata_siswa SET biaya_daftar='$biayadaftar' where id_kelas='$idhal' and id_periode='$periode'");

if ($update){
	
	header ("location:profil.php?idhal=$idhal&id_periode=$periode");
	}
else {
	echo mysql_error();}
}

elseif(isset($_POST["biayabimbel"])){
$biayabimbel = $_POST["biayabimbel"];
$update = mysql_query("UPDATE biodata_siswa SET biaya_bimbingan='$biayabimbel' where id_kelas='$idhal' and id_periode='$periode'");	
if ($update){
	
	header ("location:profil.php?idhal=$idhal&id_periode=$periode");
	}
else {
	echo mysql_error();}
	
	}

?>

</body>
</html>