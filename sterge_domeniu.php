<?php
 if(isset($_POST['sterge_domeniu']))
 {
   /* verificam daca sunt carti in tabela care apartin acestui domeniu */

   $sql = "select nume_piesa,compozitor from piese,compozitori,domenii 
		where piese.id_domeniu=domenii.id_domeniu and 
                      piese.id_compozitor=".$_POST['id_compozitor'];
   $resursa = mysql_query($sql);
   $nrCarti = mysql_num_rows($resursa);

   /* daca sunt carti apartinand acestui domeniu afisam lista lor si un mesaj de eroare */

   if($nrCarti > 0)
   {
	print "<p>Sunt $nrCarti piewse care apartin acestui domeniu</p>";
	while($row = mysql_fetch_array($resursa))
	{
  			print "<b>".$row['nume_piesa']."</b> de ".$row['compozitor']."<br>";
	}
	print "<p>Nu puteti sterge acest domeniu </p>";

	/* iar daca nu sunt carti in acest domeniu cerem confitmarea pcntru ,tergere: */
 }else{

?>

<h1>Sterge nume domeniu</h1> 
	esti sigur ca vrei sa stergi acest domeniu?
<form action="prelucrare_modificare_stergere.php" method="POST">
   <INPUT type="hidden" name="id_domeniu" value="<?=$_POST['id_domeniu']?>">
   <INPUT type="submit" name="sterge_domeniu" value="Sterge!"> 
</form>

<?
 }
}
?>