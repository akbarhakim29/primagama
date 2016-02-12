<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="default.css" rel="stylesheet" type="text/css" media="all" />
<title>PrimaGO</title>
</head>

<body>
<?php
include "session.php";
include "koneksi.php";
$idhal=$_GET["idhal"];
$periode = $_GET["id_periode"];

$periode1=mysql_query("Select * from periode
							where periode.id_periode=$periode");

		$bacaperiode=mysql_fetch_array($periode1);
?>
<div id="header-wrapper">
		<div id="header" class="container">
			<div id="logo1"><img src="images/prim.png" /></div>
            <div id="logo">
				<h1><a>PrimaGO</a></h1>
                <h3>PERIODE <a href="periode.php"><?php echo $bacaperiode['p_content'] ?></a></h3>
			</div> 
			<div id="menu">
				<ul>
					<li class="active"><a><?php echo $_SESSION['username']?></a>
                    </li>
				</ul>
			</div>
		</div>
	</div>
    
    <div id="page" class="container">
      
      		<div id="kelas">
				<h4>Tambah Siswa Untuk Kelas <?php echo $idhal ?></h4>
         	</div>
            
      <div id="menu_side">
			<h2>MENU</h2>
			<ul>
					<li class="active"><a href="keuangan.php?id_periode=<?php echo $periode?>">DATA KEUANGAN</a></li>
					<li><a href="profil.php?idhal=<?php echo $idhal?>&id_periode=<?php echo $periode?>">DATA SISWA</a></li>
					<li><a href="about.php?id_periode=<?php echo $bacaperiode['id_periode']?>">TENTANG KAMI</a></li>
                    <li><a href="logout.php">LOG OUT</a></li>
			</ul>
		</div>
      
 
        <div id="content">
        <table>
			<form action="tambahsiswa1.php?idhal=<?php echo $idhal?>&id_periode=<?php echo $periode?>" method="post"><br />
		<tr><td>NAMA LENGKAP</td><td></td><td><input type="text" name="namasiswa"  required="required" size="50px"/></td></tr><br />
		<tr><td>ASAL SEKOLAH</td><td></td><td><input type="text" name="sekolah" required="required" size="50px"/></td></tr><br />
        <tr><td>ALAMAT</td><td></td><td><input type="text" name="alamat" required="required" size="50px"/></td></tr><br />
		<tr><td>TANGGAL LAHIR</td><td></td><td><input type="text" name="tanggal" required="required" size="50px"/></td></tr><br />
		<tr><td>TEMPAT LAHIR</td><td></td><td><input type="text" name="tempat" required="required" size="50px"/></td></tr><br />						 		<tr><td>NO. TELEPON</td><td></td><td><input type="text" name="telp" required="required" size="50px"/></td></tr><br /><br />


			<tr><td colspan="3"><h3>BIAYA SISWA</h3></td></tr>
		<tr><td>BIAYA DAFTAR</td><td>  Rp</td><td><input type="text" name="biayadaftar"  required="required" size="50px"/></td></tr><br />
		<tr><td>BIAYA BIMBINGAN</td><td>   Rp</td><td><input type="text" name="biayabimbingan"  required="required" size="50px"/></td></tr><br />
		<tr><td colspan="2" align="center"><input type="submit" value="submit" /></td></tr>
		</form>
	</table>
        </div>
   
    </div>
</div>
<div id="footer">
			<p>Copyright (c) 2013 .Design by APS_GROUP1</p>
		</div>
</body>
</html>