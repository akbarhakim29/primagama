<?php 
	include "koneksi.php"; 
include "session.php";

$periode = $_GET["id_periode"];
	
	$periode1=mysql_query("Select * from periode
							where periode.id_periode=$periode");
	$bacaperiode=mysql_fetch_array($periode1);
	$keuanganquery = mysql_query("SELECT periode.p_content,
					COALESCE(a.id_kelas,'-') as kelas, (select count(id) from biodata_siswa b where a.id_kelas=b.id_kelas and b.id_periode = '$periode') as jumlah_siswa,
					COALESCE((select sum(biaya_daftar) from biodata_siswa b where a.id_kelas=b.id_kelas and b.id_periode = '$periode'),0) as biaya_daftar,
					COALESCE((select sum(biaya_bimbingan) from biodata_siswa b where a.id_kelas=b.id_kelas and b.id_periode = '$periode'),0) as biaya_bimbingan, 
					COALESCE((select sum(biaya_total) from biodata_siswa b where a.id_kelas=b.id_kelas and b.id_periode = '$periode'),0) as biaya_total, 
					COALESCE((select sum(biaya_total) from biodata_siswa b where a.id_kelas=b.id_kelas and b.id_periode = '$periode')-sum(biaya),0) as piutang
					FROM angsuran_siswa a
					RIGHT JOIN periode on a.id_periode = periode.id_periode
					WHERE periode.id_periode = '$periode'
					group by a.id_kelas");
	if(!$keuanganquery)
	{
		echo mysql_error();
	}
	
	$totalquery = mysql_query("SELECT sum(biaya_total) as Total_Pendapatan, sum(piutang) as Piutang, 
								(sum(biaya_total)-sum(piutang)) as income FROM(
									SELECT COALESCE(a.id_kelas,'-') as kelas, 
									count(DISTINCT(id)) as jumlah_siswa,
									COALESCE((select sum(biaya_daftar) from biodata_siswa b where a.id_kelas=b.id_kelas and b.id_periode = '$periode'),0) as 	biaya_daftar,
									COALESCE((select sum(biaya_bimbingan) from biodata_siswa b where a.id_kelas=b.id_kelas and b.id_periode = '$periode'),0) as biaya_bimbingan, 
									COALESCE(sum(biaya),0) as biaya_total, 
									COALESCE((select sum(biaya_total) from biodata_siswa b where a.id_kelas=b.id_kelas and b.id_periode = '$periode')-sum(biaya),0) as piutang 
									FROM angsuran_siswa a RIGHT JOIN periode on a.id_periode = periode.id_periode
									WHERE periode.id_periode = '$periode'
									group by a.id_kelas) x");
								
		if(!$totalquery)
		{
			echo mysql_error();
		}
		else
		{
			
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
				<h1><a>PrimaGo</a></h1>
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
    <h2>Data Keuangan</h2>
    </div>
    
     <div id="menu_side">
			<h2>MENU</h2>
			<ul>
					<li class="active"><a href="keuangan.php?id_periode=<?php echo $periode?>">DATA KEUANGAN</a></li>
					<li><a href="profil.php?id_periode=<?php echo $periode?>">DATA SISWA</a></li>
					<li><a href="about.php?id_periode=<?php echo $bacaperiode['id_periode']?>">TENTANG KAMI</a></li>
                    <li><a href="logout.php">LOG OUT</a></li>
			</ul>
		</div>
     
    
    <div id="content">
		<table border="1px">
			<th>Kelas</th>
			<th>Jumlah</th>
			<th>Biaya Daftar</th>
			<th>Biaya Bimbingan</th>
			<th>Biaya Total</th>
			<th>Piutang</th>			
			<?php while($baca = mysql_fetch_array($keuanganquery)){?>
			<tr>
				<td><?php echo $baca["kelas"]?></td>
				<td><?php echo $baca["jumlah_siswa"]?></td>
				<td><?php echo $baca["biaya_daftar"]?></td>
				<td><?php echo $baca["biaya_bimbingan"]?></td>
				<td><?php echo $baca["biaya_total"]?></td>
				<td><?php echo $baca["piutang"]?></td>
			</tr>
			<?php }?>	
		</table>
		</br>
        <strong>Pembukuan Pada Periode <?php echo $bacaperiode['p_content'] ?></strong></h3>	
		<table>
        <?php while($row = mysql_fetch_array($totalquery)){	?>
        	<tr>
            	<td><strong>Total Pendapatan</strong></td>
                <td><?php echo $row["Total_Pendapatan"];?></td>
            </tr>
            <tr>
            	<td><strong>Piutang</strong></td>
                <td><?php echo $row["Piutang"];?></td>
            </tr>
            <tr>
            	<td><strong>Income</strong></td>
                <td><?php echo $row["income"];?></td>
            </tr>
            <?php }?>
        </table>
        </br></br>
        
        
        
		<form action="grafik.php" method="POST">
			<table>
				<tr>
					<td><strong>Lihat Grafik Berdasarkan</strong></td>
					<td><select name="kategori">
						<option value="">--Pilih Kategori--</option>
						<option value="1">Total Pendapatan</option>
						<option value="2">Piutang</option>
						<option value="3">Income (Pendapatan bersih)</option>	
						</select>
					</td>
					<td><strong>Periode</strong></td>
					<td>
						<select name="periode">	 
						<?php 
							$sql = mysql_query("SELECT * FROM periode");
							while($row = mysql_fetch_array($sql)){
								$id_periode = $row["id_periode"];?>
						<option value="<?php echo $id_periode?>"><?php echo $row["p_content"]?></option>
						<?php } ?>
						</select>
					</td>
					<td><input type="submit" value="lihat grafik"></td>
				</tr>
			</table>
		</form>
        
        
		</div></div>
        
     <div id="footer">
			<p>Copyright (c) 2013 .Design by us</p>
		</div>
	</body>
</html>