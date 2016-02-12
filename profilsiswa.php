<?php
	include "session.php";
	include "koneksi.php";
	
	//Query Piutang;
	//SELECT biodata_siswa.id, biodata_siswa.nama, biodata_siswa.biaya_total, sum(angsuran_siswa.biaya) as yang_dibayar, biodata_siswa.biaya_total - sum(angsuran_siswa.biaya) as sisa FROM biodata_siswa JOIN angsuran_siswaWHERE biodata_siswa.id = angsuran_siswa.id AND biodata_siswa.id_kelas = angsuran_siswa.id_kelasAND biodata_siswa.id_periode = angsuran_siswa.id_periodeGROUP BY biodata_siswa.id
	
	
	$id_user = $_GET["id"];
	$idhal=$_GET["idhal"];
	$periode = $_GET["id_periode"];
	
	$periode1=mysql_query("Select * from periode
							where periode.id_periode=$periode");

	$bacaperiode=mysql_fetch_array($periode1);

	
	$bacadata = mysql_query("SELECT *,
		biodata_siswa.biaya_total - (SELECT COALESCE(sum(angsuran_siswa.biaya),0) from angsuran_siswa where angsuran_siswa.id = '$id_user') as piutang FROM biodata_siswa
								JOIN kelas ON biodata_siswa.id_kelas = kelas.id_kelas
								LEFT JOIN angsuran_siswa ON biodata_siswa.id=angsuran_siswa.id
									AND biodata_siswa.id_kelas = angsuran_siswa.id_kelas
									AND biodata_siswa.id_periode = angsuran_siswa.id_periode
								WHERE biodata_siswa.id = '$id_user' AND angsuran_siswa.id_periode = '$periode'
								GROUP BY biodata_siswa.id");
	$profil = mysql_fetch_array($bacadata);	

	$bacaangsuran = mysql_query("SELECT * FROM angsuran_siswa WHERE id = '$id_user'");
		if($bacaangsuran){}
		else{
			echo mysql_error();
		}

	$bacastatus = mysql_query("SELECT sum(biaya) as jumlah from (SELECT * FROM angsuran_siswa WHERE id = '$id_user')x");
		if($bacastatus){
			$jumlah = mysql_fetch_array($bacastatus);
		}
		else{
			echo mysql_error();
		}
			
?>

<html>
	<head>
   <link href="default.css" rel="stylesheet" type="text/css" media="all" />
<title>PRIMAGAMA</title> 
</head>
	<body>
    
    <div id="header-wrapper">
		<div id="header" class="container">
			<div id="logo1"><img src="images/prim.png" /></div>
            <div id="logo">
				<h1><a>PrimaGO</a></h1><br />
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
				<h3><?php echo $profil["nama"]?></h3>
		<h4>Status : <?php 
				if($jumlah["jumlah"] == $profil["biaya_total"])
					echo "Lunas";
				else 
					echo "Belum lunas";?></h4>
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
        <h4><a href="editbiodata.php?id_user=<?php echo $id_user?>&id_periode=<?php echo $periode?>&idhal=<?php echo $idhal?>">Edit Biodata</a></h4>
		<table border="1px" align="center">
			<tr><td>Kelas</td>
				<td>Asal Sekolah</td> 
               			 <td>Alamat</td> 
                			<td>Tempat,Tanggal Lahir</td>
                            	<td>No Telepon</td>  
									<td>Biaya Daftar</td> 
										<td>Biaya Bimbingan</td>
											<td>Total Biaya</td>
                                            	<td>Piutang</td></tr> 
		
        <tr><td><?php echo $profil["k_content"]?></td>
        		<td><?php echo $profil["asal_sekolah"]?></td>
                	<td><?php echo $profil["alamat"]?></td>
                		<td><?php echo $profil["tempat_lahir"].",".$profil["tanggal_lahir"]?></td>
               				 <td><?php echo $profil["no_hp"]?></td>
					<td><?php echo $profil["biaya_daftar"]?></td>
        				<td><?php echo $profil["biaya_bimbingan"]?></td>
        					<td><?php echo $profil["biaya_total"]?></td>
                           		 <td><?php echo $profil["piutang"]?></td></tr>
        </table><br>
		<strong><h3 align="center">Angsuran <?php echo $profil["nama"]?></h3></strong><br>
       
       
       <table>
        <form action="angsuran.php?id=<?php echo $id_user?>&idhal=<?php echo $idhal?>&id_periode=<?php echo $periode?>" method="post">
       <tr><td> angsuran-ke </td><td>:</td>
        <td><select name="angsuran">
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
	</select></td></tr>
        <tr><td>jumlah pembayaran </td><td>:</td><td><input type="biaya" name="biaya"></td>
        <td><input type="submit" value="submit"></td></tr>
        
        </form>
        </table><br><br>
        
		<table border="1px">
			<th>Tanggal Angsuran</th>
			<th>Angsuran Ke</th>
			<th>jumlah pembayaran</th>
		<?php 
		while($row = mysql_fetch_array($bacaangsuran)){ ?>
			<tr>
				<td><?php echo $row["tanggal"]?></td>
				<td><?php echo $row["angsuran_ke"]?></td>
				<td><?php echo $row["biaya"]?></td>
			</tr>
		<?php }
		?>


		</table>
        </div>
   </div>
   
   
	<div id="footer">
			<p>Copyright (c) 2013 .Design by APS_GROUP1</p>
		</div>
	</body>
</html>