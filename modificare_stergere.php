<?php
  session_start();
  include("autorizare.php");
  include("admin_top.php");
  include("conectare.php");
?>
 <html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2">
  <link rel="stylesheet" href="adaugare.css">
</head>
<div class="page">
<h2>Modificare sau stergere</h2>

<p><b>Nota:</b>Nu veti putea sterge domenii care au produse in ele.<br>Inainte de a sterge domeniul,
 modificati produsele din el astfel incat sa apartina altor domenii. <br>
 De asemenea nu veti putea sterge un fabricant daca exista produse in tabele care are acel fabricant.
 </p>

<div style="width:600px; border:3px solid #632415; 
   back-ground-color:#F9F1E7; padding:5px">

<b>Selecteaza domeniul pe care doresti sa-l modifici sau sa-l stergi:</b>
<hr size="1">

<form action="formulare_modificare_stergere.php" method="POST">
  Domeniu:
  <select name="id_domeniu">

  /* luam numele de domenii din tabela si le afisam utilizatorului intr-o lista drop-  
      down. Astfel putem obtine un id_domeniu corespunzator domeniului se!ectat pe care sa il   
      introducem in tabelul produs */

   <?php
     $sql = "select * from domenii order by domeniu asc";
     $resursa = mysqli_query($conn, $sql);
     while($row = mysqli_fetch_array($resursa))
     {
          print '<option value="'.$row['id_domeniu'].'">'.$row['domeniu'].'</option>';
     }
   ?>

  </select>

  <INPUT type="submit" name="modifica_domeniu" value="Modifica">
  <INPUT type="submit" name="sterge_domeniu" value="Sterge">
</form>
</div>

<div style="width:600px; border:3px solid #632415; 
   back-ground-color:#F9F1E7; padding:5px">

<b>Selecteaza Compozitorul pe care doresti sa-l modifici sau sa-l stergi:</b>
<hr>
<form action="formulare_modificare_stergere.php" method="POST">
  Compozitor:
  <select name="id_compozitor">

  /*afisam si lista drop-down cu autori*/

  <?php
    $sql = "select * from compozitori order by compozitor asc";
    $resursa = mysqli_query($conn, $sql); 
    while($row = mysqli_fetch_array($resursa))
    {
        print '<option value="'.$row['id_compozitor'].'">'.$row['compozitor'].'</option>';
    }
  ?> 
 </select> 

<INPUT type="submit" name ="modifica_compozitor" value="Modifica">
<INPUT type="submit" name ="sterge_compozitor" value="Sterge">

</form>
</div>

<div style="width:600px; border:3px solid #632415; 
   back-ground-color:#F9F1E7; padding:5px">

<b>Selecteaza piesa si scrie titlul piesei pe care doresti sa il modifici sau sa-l stergi:</b>
<hr>
<form action="formulare_modificare_stergere.php" method="POST">
 <table>
   <tr>
    <td>Piesa:</td>
    <td>
     <select name="id_piesa">

       <?php

		/*afisam si lista drop-down cu autori*/

		$sql = "select * from piese order by nume_piesa asc";
		$resursa = mysqli_query($conn, $sql); 
		while($row = mysqli_fetch_array($resursa))
		{
			print '<option value="'.$row['id_piesa'].'">'.$row['nume_piesa'].'</option>';
		}
       ?> 
     </select> 
   </td>
  </tr> 
  <tr><td>Titlu:</td>
      <td><INPUT type="text" name="nume_piesa"></td>
  </tr> 
 </table> 
    <INPUT type="submit" name="modifica_piesa" value="Modifica"> 
    <INPUT type="submit" name="sterge_piesa" value="Sterge">      
 </form>

</div>
  </div>
</body> 
</html>
