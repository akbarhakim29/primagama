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


$nama=$_POST['namasiswa'];
$sekolah=$_POST['sekolah'];
$alamat=$_POST['alamat'];
$tanggallahir=$_POST['tanggal'];
$tempatlahir=$_POST['tempat'];
$telp=$_POST['telp'];
$biayadaftar=$_POST['biayadaftar'];
$biayabimbingan=$_POST['biayabimbingan'];
$biayatotal=$biayadaftar+$biayabimbingan;


$insertbio=mysql_query("INSERT into biodata_siswa(id_kelas,id_periode,nama,asal_sekolah,alamat,tanggal_lahir,tempat_lahir,no_hp,biaya_daftar,biaya_bimbingan,biaya_total) VALUES('$idhal','$periode','$nama','$sekolah','$alamat','$tanggallahir','$tempatlahir',
'$telp','$biayadaftar','$biayabimbingan','$biayatotal')");
						
						
if ($insertbio){
	
	header ("location:profil.php?idhal=$idhal&id_periode=$periode");
	}
else {
	echo mysql_error();}

?>

</body>
</html>