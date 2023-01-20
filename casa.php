<?php
	session_start();
	include("conectare.php");
	include("meniu.php");
?>
<link rel="stylesheet" href="casa.css">
 <div class="page">
<td valign="top">
<h2>Casa</h2>
<b>Piesele dvs:</b><br>
<table border="1" cellspacing="0" cellpading="4">
	<tr bgcolor="#F9F1E7">
		<td align="center"><b>Nr.buc</b></td>
		<td align="center"><b>Piesa </b></td>
		<td align="center"><b>Pret </b></td>
		<td align="center"><b>Total </b></td>
	</tr>
<?php
	$totalGeneral =0;
	for($i=0;$i<count($_SESSION['id_piesa']);$i++)
	{
		if($_SESSION['nr_piese'][$i] !=0)
		{
			print '<tr>
			<td align="center">'.$_SESSION['nr_piese'][$i].'</td><td><b>'
			.$_SESSION['nume_piesa'][$i].'</b> de: '.$_SESSION['compozitor'][$i].'</td>
			<td align="right">'.$_SESSION['pret'][$i].' euro</td>
			<td align="right">'
			.($_SESSION['nr_piese'][$i]*$_SESSION['pret'][$i]).' euro </td>
			</tr>';
			$totalGeneral = $totalGeneral + ($_SESSION['nr_piese'][$i] * $_SESSION['pret'][$i]);
		}
	}
	//afisam totalul general
	print '<tr>
	<td align="right" colspan="3"><b>Total de plata</b></td>
	<td align="right"><b>'.$totalGeneral.'</b> euro</td>
	</tr>';
?>
</table>
<h3>Detalii</h3>
Introduceti numele si adresa unde doriti sa primiti piesele cumparate:
<form action="prelucrare.php" method="POST">
<table>
	<tr>
	<td><b>Numele:</b></td>
	<td><input type="text" name="nume" style = "width:600px;"></td>
	</tr>
	<tr>
	<td valign="top"><b>Adresa:</b></td>
	<td><textarea name="adresa" rows="2" style = "width:600px;"></textarea></td>
	</tr>
	<tr>
	<td></td>
	<td><input type="submit" value="Trimite" style = "width:600px; background:grey;padding:5px"></td>
	</tr>
</table>
</form>
</td>