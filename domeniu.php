<?php
	session_start();
	include ("conectare.php");
	include ("meniu.php");
	
	$id_domeniu=$_GET['id_domeniu'];
	$sqlNumeDomeniu="SELECT domeniu FROM domenii WHERE id_domeniu =".$id_domeniu;
	$sursaNumeDomeniu = mysqli_query($conn, $sqlNumeDomeniu);
	/* mysql_query execută interogarea dar nu afişează rezultatul ci returnează o
	valoare: TRUE dacă interogarea a fost efectuată cu succes sau FALSE. dacă aceasta a
	eşuat Pentru a afişa valori din cadrul resursei returnate putem folosi mysql_result.
	Parametrii funcţiei mysql_result sunt: interogarea ($resursaNumeDomeniu), rândul (0,
	primul rând al tabelului (numerotarea începe de la 0), 1 rândul al doilea al tabelului,
	etc...) şi numele câmpului ("domeniu");*/
	$row=mysqli_fetch_array($sursaNumeDomeniu);
	$numeDomeniu = $row['domeniu'];
?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2">
  <link rel="stylesheet" href="domeniu.css">
</head>
<div class="page">
<td valign="top">
<h3>Domeniu: <?=$numeDomeniu?></h3>
<b>Carti din domeniul:<u><i><?=$numeDomeniu?></i></u></b>
<table cellpadding="7">
<?php
	$sql="SELECT id_piesa, nume_piesa, descriere, pret, compozitor
	FROM piese, compozitori, domenii
	WHERE piese.id_domeniu=domenii.id_domeniu AND
	piese.id_compozitor=compozitori.id_compozitor AND
	domenii.id_domeniu = ".$id_domeniu;
	$sursa = mysqli_query($conn, $sql);
	/*mysql_result este greoi de folosit deoarece suntem nevoiţi să accesăm fiecare
	coloană a fiecărui rând în parte. Dar, putem accesa resursa ca un array numeric cu
	ajutorul functiei mysql_fetch_array, functie cu care putem accesa valorile din tabelul
	returnat în interogare dintr-un array*/
	while($row = mysqli_fetch_array($sursa))
	{
?>
		<tr>
		<td align = "center" style="width: 200px;">
<?php
		$adrimag="Poze/".$row['id_piesa'].".jpg";
		if (file_exists($adrimag))
		{
			$adrimag="Poze/".$row['id_piesa'].".jpg";
		    print '<img src="'.$adrimag.'" width=auto height="250" align =center><br>';
		}
		else
		{
			/*daca nu exista fis specificat afisam layerul DIV in care scrie "fara imagine"*/
			print '<div style="width:75px; border: 1px black solid;
			background-color:#cccccc">fara imagine</div>';
		}
?>
		</td>
		<td>
			<b><a href="piesa.php?id_piesa=<?=$row['id_piesa']?>">
			<?=$row['nume_piesa']?></a></b><br>
			de <?=$row['compozitor']?><br>
			pret: <?=$row['pret']?> euro
		</td>
		</tr>
<?php
	}
?>
</table>