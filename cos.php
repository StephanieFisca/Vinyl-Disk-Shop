<?php
	session_start();
	include("conectare.php");
	include("meniu.php");
	/* Dacă este setată variabila $_GET[‘actiune’] şi valoarea acesteia este "adaugă", se
	execută următorul cod: */
	if(isset($_GET['actiune']) && $_GET['actiune'] == "adauga")
	{
		$_SESSION['id_piesa'][] = $_POST['id_piesa'];
		$_SESSION['nr_piese'][] = 1;
		$_SESSION['pret'][] = $_POST['pret'];
		$_SESSION['nume_piesa'][] = $_POST['nume_piesa'];
		$_SESSION['compozitor'][] = $_POST['compozitor'];
	}
	/* Dacă este setată variabila $_GET[‘actiune’] şi valoarea acesteia este „Modifica", se execută
	următorul cod: */
	if(isset ($_GET['actiune']) && $_GET['actiune'] == "modifica")
	{
		for($i=0; $i<count($_SESSION['nr_piese']); $i++)
		{
			$_SESSION['nr_piese'][$i] = $_POST['nr_piese'][$i];
		}
	}
?>
  
  <link rel="stylesheet" href="cos.css">
<div class="page">

<td valign="top">
	<h2>Cosul de cumparaturi</h2>
	<form action="cos.php?actiune=modifica" method="POST">
		<table border="1" cellspacing="0" cellpading="4">
		<tr bgcolor="#F9F1E7">
			<td align="center"><b>Nr_piese</b></td>
			<td align="center"><b>Piesa </b></td>
			<td align="center"><b>Pret </b></td>
			<td align="center"><b>Total </b></td>
		</tr>
	<?php
	$totalGeneral=0;
	if ($_SESSION['nr_piese']!=0){
	for($i=0; $i<count($_SESSION['id_piesa']); $i++)
	{
		if($_SESSION['nr_piese'][$i] !=0)
		{
			/*doar daca numarul de bucati nu este 0, afiseaza randul*/
			print '<tr>
			<td><input type="text" name="nr_piese['.$i.']" size="1"
			value="'.$_SESSION['nr_piese'][$i].'"></td>
			<td><b>'.$_SESSION['nume_piesa'][$i].'</b> de:
			'.$_SESSION['compozitor'][$i].'</td>
			<td align="right">'.$_SESSION['pret'][$i].' euro</td>
			<td align="right">'.($_SESSION['nr_piese'][$i]*$_SESSION['pret'][$i]).' euro </td>
			</tr>';
			$totalGeneral= $totalGeneral + ($_SESSION['nr_piese'][$i]*$_SESSION['pret'][$i]);
		}
	}}
	//de aici in jos trebuie pus in cos.php
	//afisam totalul general
	print '<tr>
	<td align="right" colspan="3"><b>Total in cos</b></td>
	<td align="right"><b>'.$totalGeneral.'</b> euro</td>
	</tr>';
	?>
	</table>
	<input type="submit" value="Modifica" style = "width:200px; padding:0px; margin-left:70%; font-size: 20px; background:grey; border-radius: 12px;">
	<br><br>
		Introduceti <b>0</b> pentru piesele pe care doriti sa le scoateti din cos!
	<h2>Continuati</h2>
	<table>
		<tr>
		<td width="200" align="center"><i class="fa-regular fa-bag-shopping"></i>
			<a href="index.php"> Continua cumparaturile</a></td>
			<td width="200" align="center"><i class="fa-regular fa-credit-card"></i>
			<a href="casa.php">Mergi la casa</a></td>
		</tr>
	</table>
</td>
<div>