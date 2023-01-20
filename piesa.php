<?php
	session_start();
	include("conectare.php");
	include("meniu.php");

	$id_piesa=$_GET['id_piesa'];
	$sql="SELECT nume_piesa, compozitor, descriere, pret FROM piese, compozitori
	WHERE id_piesa=".$id_piesa." AND piese.id_compozitor=compozitori.id_compozitor";
	$resursa = mysqli_query($conn, $sql);
	/* deoarece interogarea returneaza un singur rand, nu vom folosi while pentru a itera prin
	toate elementele array_ului ci le vom accesa direct */
	$row = mysqli_fetch_array($resursa);
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2">
<link rel="stylesheet" href="piesa.css">
</head>

<td valign="top">
<table>
<tr>
<div valign="top">
<?php
	$adrimag="Poze/".$id_piesa.".jpg";
	if (file_exists($adrimag))
	{	
		$adrimag="Poze/".$id_piesa.".jpg";
	    print '<img src="'.$adrimag.'" width=auto height="400" align=right>';
	}
	else
	{
		/*daca nu exista fis specificat afisam layerul DIV in care scrie "fara imagine"*/
		print '<div style="width:75px; height:100px; border: 1px black solid;
		background-color: #cccccc">fara imagine</div>';
	}
?>
<div class="page" style = "width:400px; padding:10px; margin-left:17%; font-size: 20px;">
	</td>
	<div td valign="top">
	<h1><?=$row['nume_piesa']?></h1>
	de: <b><?=$row['compozitor']?></b>
	<p> <?=$row['descriere']?></p>
	<p>pret: <b><?=$row['pret']?> euro </b></p>
	</td>
	</tr>
	</table >
	<form action="cos.php?actiune=adauga" method="POST">
		<input type="hidden" name="id_piesa" value="<?=$id_piesa?>">
		<input type="hidden" name="nume_piesa" value="<?=$row['nume_piesa']?>">
		<input type="hidden" name="compozitor" value="<?=$row['compozitor']?>">
		<input type="hidden" name="pret" value="<?=$row['pret']?>">
		<b><input type="submit" value="Cumpara acum!" style = "width:200px; margin-left:5%; font-size: 20px; background:green; border-radius: 12px;"></b>
	</form>
	<p style = "width:200px; margin-left:46%; font-size: 20px;"><b>Opiniile cititorilor</b></p>
<?php
	$sqlComent="SELECT * FROM comentarii WHERE id_piesa =" . $id_piesa;
	$sursaComent = mysqli_query($conn, $sqlComent);
	while ($row = mysqli_fetch_array($sursaComent))
	{
		print ' <div style = "width:600px; solid #ffffff;
		back-ground-color:#F9F1E7; margin-left:32%;">
		<u><a "mailto : ' .$row['adresa_email'] . ' input type="email""> '
		.$row['nume_utilizator'] . '</a><br></u>'
		.$row['comentariu'] . '</div> ';
	}
?>
	<br>
	<div style="width:1400px; margin-left:5%; solid #632415;
	back-ground-color:#F9F1E7;">
	<b>Adauga opinia ta</b>
	<hr size="1">
	<form action="adauga_comentariu.php" method="POST">
	<b>Nume:</b> <input type="text" name="nume_utilizator" style = "width:600px;"><br>
	<b>Email: </b><input type="email" name="adresa_email" style = "width:600px;"><br><br>
	<b>Comentariu:</b> <br>
	<textarea name="comentariu" cols="45" style = "width:800px;"></textarea>
	<br><br>
	<input type="hidden" name="id_piesa" value="<?=$id_piesa?>">
	<center>
	<input type ="submit" value="Adauga">
	</center>
	</form>
	</div>
	</td>