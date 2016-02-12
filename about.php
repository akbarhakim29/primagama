<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PRIMAGO</title>
<link href="default.css" rel="stylesheet" type="text/css" media="all" />
</head>

<body>
<?php
include "session.php";
include "koneksi.php";
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
				<h2>About</h2>
         	</div>
            
      <div id="menu_side">
			<h2>MENU</h2>
			<ul>
					<li class="active"><a href="keuangan.php?id_periode=<?php echo $periode?>">DATA KEUANGAN</a></li>
					<li><a href="profil.php?id_periode=<?php echo $periode?>">DATA SISWA</a></li>
					<li><a href="about.php">TENTANG KAMI</a></li>
                    <li><a href="logout.php">LOG OUT</a></li>
			</ul>
		</div>
        
        <div id="content">
        		PRIMAGAMA HARAPAN BARU adalah sebuah bimbingan Belajar yang merupakan anak cabang dari PRIMAGAMA PUSAT.Tujuan Kami adalah mencerdaskan kehidupan anak bangsa.Lokasi Kami di Jl.Pisang Ambon no.IV,Harapan I ,Kota Baru,Bekasi.
                 
        </div>
   </div>
   
		<div id="footer">
			<p>Copyright (c) 2013 .Design by US</p>
		</div>   
</body>
</html>