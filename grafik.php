<?php
	if(isset($_POST["kategori"])){
	$kategori = $_POST["kategori"];
	$periode = $_POST["periode"];

	if($kategori == 1){
		header("location:totalpendapatangrafik.php?periode=$periode");
	}
	elseif($kategori == 2){
		header("location:piutanggrafik.php?periode=$periode");
	}
	else{
		header("location:incomegrafik.php?periode=$periode");
	}
}
?>