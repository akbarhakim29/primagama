<?php

	$periode = $_GET["periode"];

	$koneksi=mysql_connect('localhost','root','') or die ;
	mysql_select_db('aps-prmgma') or die;

	$query = mysql_query("SELECT MONTH(a.tanggal) as bulan,
	COALESCE((select sum(biaya_bimbingan) from biodata_siswa b where a.id_kelas=b.id_kelas),0) as biaya_bimbingan
	FROM angsuran_siswa a
	RIGHT JOIN periode on a.id_periode = periode.id_periode
	WHERE periode.id_periode = '$periode'
	GROUP BY bulan");

	$x=array();
	$y=array();

	while($row = mysql_fetch_array($query)){
		$x[] = $row["bulan"];
		$y[] = $row["biaya_bimbingan"];
	}


	include "chart/src/jpgraph.php";
	include "chart/src/jpgraph_line.php";

	$grafik = new Graph(1366,720);
	$grafik->SetScale("textlin");
	$grafik->img->SetMargin(100,50,100,100);

	$grafik->title->Set("GRAFIK TOTAL PENDAPATAN");

	$grafik->yaxis->HideZeroLabel();
	$grafik->yaxis->HideLine(false);

	$grafik->xgrid->show();
	$grafik->xgrid->SetLineStyle("solid");
	$grafik->xaxis->SetTickLabels($x);
	$grafik->xgrid->SetColor("#E3E3E3");

	$garis = new LinePlot($y);
	$grafik->Add($garis);
	$garis->SetColor("#6495ED");
	$garis->SetLegend("Berdasarkan bulan");
	$grafik->Stroke();
	
?>