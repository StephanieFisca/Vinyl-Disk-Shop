<?php
 if(isset($_POST['sterge_piesa']))
 {
   print "<h1>Sterge piesa</h1>";

   /* cautam intai o carte in tabela care are titlul si id_autor specificate in 
      formular
   */

   $sqlCarte = "select * from piese where nume_piesa='".$_POST['nume_piesa']."' and 
   id_compozitor=".$_POST['id_compozitor'];
 
   $resursaCarte = mysql_query($sqlCarte);

   /* daca nu s-a gasit nici o carte care sa corespunda datelor introduse atisam 
      un mesaj de eroare 
   */

   if(mysql_num_rows($resursaCarte) == 0)
   {
	print "Aceasta piesa nu exista in tabela";
   }else{
  	/* iar daca exista atunci extragem id_ul cartii din tabela si il vom folosi 
                intr-un camp ascuns din formularul de confirmare */

   $id_carte = mysql_result($resursaCarte,0,"id_piesa");

 ?>

Esti sigur ca vrei sa stergi aceasta carte ?

<form action="prelucrare_modificare_stergere.php" method="POST">
   <INPUT type="hidden" name="id_piesa" value ="<?=$_POST['id_piesa']?>">
   <INPUT type="submit" name="sterge_piesa" value="Sterge!"> 
</form>

<?
 }
}
?>