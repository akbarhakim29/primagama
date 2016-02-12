
<?php
	include "session.php";
	include "koneksi.php";

	if(isset($_GET["delete"])and isset($_GET["id_user"]) ){
		$id_user = $_GET["id_user"];
		$periode = $_GET["id_periode"];
		$delete =mysql_query("DELETE FROM biodata_siswa WHERE id='$id_user'");
		
	if($delete){
		header("location:profil.php?id_periode=$periode");
		}
	
		}
	else{
	
	$id_user = $_GET["id_user"];
	$idhal=$_GET["idhal"];
	$periode = $_GET["id_periode"];
	
	$periode1=mysql_query("Select * from periode
							where periode.id_periode=$periode");

	$bacaperiode=mysql_fetch_array($periode1);
	
	$bacadata = mysql_query("SELECT * FROM biodata_siswa
								JOIN kelas ON biodata_siswa.id_kelas = kelas.id_kelas
								where biodata_siswa.id = '$id_user'");
	$profil = mysql_fetch_array($bacadata);	

	if(isset($_GET["update"])and isset($_GET["id_user"])){
	$nama = $_POST["nama"];
	$sekolah = $_POST["sekolah"];
	$tempat = $_POST["tempat"];
	$tanggal = $_POST["tanggal"];
	$telepon = $_POST["telepon"];
	$daftar = $_POST["biayadaftar"];
	$bimbingan = $_POST["biayabimbingan"];
	
	$update = mysql_query("UPDATE biodata_siswa SET nama='$nama',asal_sekolah='$sekolah',tempat_lahir='$tempat',
							tanggal_lahir='$tanggal',no_hp='$telepon',biaya_daftar='$daftar',biaya_bimbingan='$bimbingan' 
							WHERE id='$id_user'");
							
	
	
	if($update){
		header("location:profilsiswa.php?id=$id_user&id_periode=$periode&idhal=$kelas");
	}
	else{
		echo mysql_error();
	}
	}
	else 
		echo "";
	
	}
	
				
	?>	
    <html>
	<head>
<title>PRIMAGAMA</title>    
<link href="default.css" rel="stylesheet" type="text/css" media="all" />
</head>
	<body>
    
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
		<h3>Edit Biodata </h3>
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
	<form action="editbiodata.php?update=1&id_user=<?php echo $id_user?>&id_periode=<?php echo $periode?>&idhal=<?php echo $idhal?>" method="post">
    <table>
    <tr><td>nama</td>
    	<td><input type="text" value="<?php echo $profil["nama"] ?>" name="nama"></td></tr>
    <tr><td>Asal Sekolah</td>
    	<td><input type="text" value="<?php echo $profil["asal_sekolah"]?>" name="sekolah"></td></tr>
    <tr><td>tempat lahir</td>
    	<td><input type="text" value="<?php echo $profil["tempat_lahir"] ?>" name="tempat"></td></tr>
    <tr><td>tanggal lahir</td>
    	<td><input type="text" value="<?php echo $profil["tanggal_lahir"] ?>" name="tanggal"></td></tr>
    <tr><td>no.telp</td>
    	<td><input type="text" value="<?php echo $profil["no_hp"] ?>" name="telepon"></td></tr>
    <tr><td>Biaya Daftar</td>
    	<td><input type="text" value="<?php echo $profil["biaya_daftar"]?>" name="biayadaftar"></td></tr>
    <tr><td>Biaya Bimbingan</td>
    	<td><input type="text" value="<?php echo $profil["biaya_bimbingan"]?>" name="biayabimbingan"></td></tr>
    <tr><td><input type="submit" value="Edit"></td></tr>
    </table>
    
    </form>
    </div>
    </div>
    
  <div id="footer">
			<p>Copyright (c) 2013 .Design by US</p>
		</div>
   </body> 
    