<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="default.css" rel="stylesheet" type="text/css" media="all" />
<title>PRIMAGO</title>
</head>

<body>
<?php 
include "koneksi.php";
include "session.php";

?>
<div id="wrapper">

	<div id="header-wrapper">
		<div id="header" class="container">
			<div id="logo1"><img src="images/prim.png" /></div>
            <div id="logo">
				<h1><a>PrimaGO</a></h1>
              </div> 
			<div id="menu">
				<ul>
					<li class="active"><a><?php echo $_SESSION['username']."<br><br>";?></a>
                    </li>
				</ul>
			</div>
		</div>
	</div>


	<div id="page" class="container">
		
       	  <div id="periode1">
			<h2>PILIH PERIODE</h2><br /><br />
            <?php
			$periode=mysql_query("select * from periode");
			echo '<form action="profil.php">';
			echo '<select name="id_periode">';
			while($bacaperiode=mysql_fetch_array($periode)){
			?>	
	
		<option value="<?php echo $bacaperiode['id_periode']?>"><?php echo $bacaperiode['id_periode']."<-->".$bacaperiode['p_content'] ;?> </option>
   	
		<?php	}?>
			</select>
			<input type="submit" value="  MASUK  " />
			</form>
            </div>
            
            <div id="periode2">
            <h3>TAMBAH PERIODE</h3>	<br /><br />
            <form action="periodeplus.php"  method="get">
			Masukkan Tahun Ajaran:<br /><input type="text" name="periodebaru"  size="30px"/><br /> 
			ex: 2013/2014 <br /><br />
			<input type="submit" value="  TAMBAH  " />
			</form>
         </div>
         
         <div id="periode1"><br /><br />
         <a href="logout.php"><h1>Log Out</h1></a>
         </div>
           
        <div id="periode2"><h3>HAPUS PERIODE</h3>	<br /><br />
		<form action="periodedelete.php" method="get">
		Masukkan ID Tahun Ajaran:<br /><input type="text" name="periodehapus"  size="30px"/><br />
        ex: 1 atau 2 <br /><br />
		<input type="submit" value="  HAPUS  " />
		</form>
            </div>
	</div>
		
	    
		<div id="footer">
			<p>Copyright (c) 2013 .Design by uS</p>
		</div>
</div>
</body>
</html>

         

</body>
</html>