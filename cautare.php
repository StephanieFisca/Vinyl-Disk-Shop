<?php
	session_start();
	include("conectare.php");
	include("meniu.php");
	$cuvant = $_GET['cuvant'];
?>
<link rel="stylesheet" href="cautare.css">
<div class="page">
<td valign="top">
<h1>Rezultatele cautarii</h1>
<p>Textul cautat: <b><?=$cuvant?></b></p>
<h1>Compozitori</h1> 
<blockquote>
<?php
$sql = "SELECT id_compozitor, compozitor FROM compozitori WHERE compozitor LIKE '%".$cuvant."%'";
$resursa = mysqli_query($conn, $sql);
if(mysqli_num_rows($resursa) ==0) 
{
	print "<i>Nici un rezultat</i>";
}
while($row = mysqli_fetch_array($resursa)) 
{
	$nume_compozitor = str_replace ($cuvant,"<b>$cuvant</b>", $row['compozitor']);
	print '<a href="compozitor.php?id_compozitor='.$row['id_compozitor'].'">'.$nume_compozitor.'</a><br>';
}
?>
</blockquote>
<b>Piese</b> 
<blockquote>
<?php
$sql = "SELECT id_piesa, nume_piesa FROM piese WHERE nume_piesa LIKE '%".$cuvant."%'";
$resursa = mysqli_query($conn, $sql);
if(mysqli_num_rows($resursa) == 0)
{
	print "<i>Nici un rezultat</i>";
}
while($row = mysqli_fetch_array($resursa)) 
{
	$piesa = str_replace ($cuvant,"<b>$cuvant</b>",$row['nume_piesa']);
	print '<a href="piesa.php?id_piesa'.$row['id_piesa'].'">'.$piesa.'</a><br>';
}
?>
</blockquote>
<b>Descrieri</b>
<blockquote>
<?php
$sql = "SELECT id_piesa,nume_piesa, descriere FROM piese WHERE descriere LIKE '%".$cuvant."%'";
$resursa = mysqli_query($conn, $sql);
if(mysqli_num_rows($resursa) == 0) 
{
	print "<i>Nici un rezultat</i>";
}
while($row = mysqli_fetch_array($resursa)) 
{
$descriere = str_replace ($cuvant,"<b>$cuvant</b>", $row['descriere']);
print '<a href="piesa.php?id_piesa='.$row['id_piesa'].'">'.$row['nume_piesa'].
'</a><br>'.$descriere.'<br><br>';
}
?>
</blockquote>
</td>
