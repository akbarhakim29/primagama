<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="default.css" rel="stylesheet" type="text/css" media="all" />
<title>PrimaGO</title>
</head>

<body>

<?php
include "koneksi.php";
include "session.php";


if(isset($_GET["idhal"])){
		$idhal=$_GET["idhal"];
	}
else {
		$idhal=3 ;
		}

$period=$_GET["id_periode"];

	$periode=mysql_query("Select * from periode
							where periode.id_periode=$period");

		$bacaperiode=mysql_fetch_array($periode);
		$bacadata=mysql_query("SELECT * from biodata_siswa
							JOIN kelas on biodata_siswa.id_kelas=kelas.id_kelas
							JOIN periode on periode.id_periode=biodata_siswa.id_periode
							where kelas.id_kelas=$idhal and periode.id_periode = $period
						");
		if($bacadata){
			}
		else{
			echo mysql_error();
			}

?>
<div id="header-wrapper">
		<div id="header" class="container">
			<div id="logo1"><img src="images/prim.png" /></div>
            <div id="logo">
				<h1><a>PRIMAGO</a></h1>
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
			<ul>
					<li class="active"><a href="profil.php?idhal=3&id_periode=<?php echo $bacaperiode['id_periode']?>">3 SD</a></li>
					<li><a href="profil.php?idhal=4&id_periode=<?php echo $bacaperiode['id_periode']?>">4 SD</a></li>
					<li><a href="profil.php?idhal=5&id_periode=<?php echo $bacaperiode['id_periode']?>">5 SD</a></li>
                    <li><a href="profil.php?idhal=6&id_periode=<?php echo $bacaperiode['id_periode']?>">6 SD</a></li>
					<li><a href="profil.php?idhal=7&id_periode=<?php echo $bacaperiode['id_periode']?>">1 SMP</a></li>
					<li><a href="profil.php?idhal=8&id_periode=<?php echo $bacaperiode['id_periode']?>">2 SMP</a></li>
                    <li><a href="profil.php?idhal=9&id_periode=<?php echo $bacaperiode['id_periode']?>">3 SMP</a></li>
            		<li><a href="profil.php?idhal=10&id_periode=<?php echo $bacaperiode['id_periode']?>">1 SMA</a></li>
					<li><a href="profil.php?idhal=11&id_periode=<?php echo $bacaperiode['id_periode']?>">2 SMA</a></li>
                    <li><a href="profil.php?idhal=12&id_periode=<?php echo $bacaperiode['id_periode']?>">3 SMA</a></li>
            </ul>
       	</div>
        
        <div id="menu_side">
			<h2>MENU</h2>
			<ul>
					<li class="active"><a href="keuangan.php?id_periode=<?php echo $period ?>">DATA KEUANGAN</a></li>
					<li><a href="profil.php?id_periode=<?php echo $bacaperiode['id_periode']?>">DATA SISWA</a></li>
					<li><a href="about.php?id_periode=<?php echo $bacaperiode['id_periode']?>">TENTANG KAMI</a></li>
                    <li><a href="logout.php">LOG OUT</a></li>
			</ul>
		</div>
        
        <div id="content">
        	<div id="box1">
				<h2>Kelas <?php echo $idhal; ?></h2>
         	</div>
         
         <div>
			<ul class="style1">
			<table>
            <tr>
            <td><a href="tambahsiswa.php?idhal=<?php echo $idhal?>&id_periode=<?php echo $bacaperiode["id_periode"]?>">
                        Tambah Siswa </a></td>
			</tr>
            <tr>
			<form method="post" action="ubahbiayadaftar.php?idhal=<?php echo $idhal?>&id_periode=<?php echo 
			$bacaperiode["id_periode"]?>">
			<td>Ubah Biaya Daftar</td><td><input type="text" name="biayadaftar" /></td>
			<td><input type="submit" value="submit" /></td> 
			</form>
			</tr>
            <tr>
			<form method="post" action="ubahbiayadaftar.php?idhal=<?php echo $idhal?>&id_periode=<?php echo 
			$bacaperiode["id_periode"]?>">
			<td>Ubah Biaya Bimbingan</td><td><input type="text" name="biayabimbel" /></td>
			<td><input type="submit" value="submit" /></td> 
			</form>
            </tr>
			</table>
			</ul>
		</div>
        
        	<div>
            <table border="1px">
	<tr style="font-weight:bold;text-align:center" ><td>Nama</td>
		<td>Kelas</td>
        <td>Asal Sekolah</td>
		<td>Tempat,Tanggal lahir</td>
		<td>Biaya Daftar</td>
		<td>Biaya Bimbingan</td>
		<td>Biaya Total</td>
        <td>Aksi</td></tr>
        
	
	<?php    
		while($row = mysql_fetch_array($bacadata)){
			$id = $row["id"];
			?>
		<tr style="text-align:center; font-family:Tahoma, Geneva, sans-serif">
			<td><a href="profilsiswa.php?id=<?php echo $id?>&idhal=<?php echo $idhal?>&id_periode=<?php echo $bacaperiode["id_periode"]?>"><?php echo "$row[nama]"?></a></td>
			
         	<td><?php echo "$row[k_content]"?></td>
			<td><?php echo "$row[asal_sekolah]"?></td>
            <td><?php echo "$row[tempat_lahir]".","."$row[tanggal_lahir]"?></td>
			<td><?php echo "$row[biaya_daftar]"?></td>
			<td><?php echo "$row[biaya_bimbingan]"?></td>
			<td><?php echo "$row[biaya_total]"?></td>
			<td>
            <a href="editbiodata.php?delete=1&id_user=<?php echo $id?>&id_periode=<?php echo $bacaperiode["id_periode"]?>">Hapus</a></td>
		</tr>
		<?php }?>
   </table>
            </div>
      </div>
      
</div>
<div id="footer">
			<p>Copyright (c) 2013 .Design by Us</p>
		</div>
   
</body>
</html>