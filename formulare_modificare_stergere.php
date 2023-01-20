<?php
 session_start();
 include("autorizare.php"); 
 include("admin_top.php");
 include("conectare.php");

 /* Modifica/sterge domeniu 

  modificare nume domeniu */

 if(isset($_POST['modifica_domeniu']))
 {
   /* luam numele de domeniu din tabela deoarece ne-a fost trimis din formular doar  
      id_ul domeniului: 
   */

   $sql= "select domeniu from domenii where id_domeniu='".$_POST['id_domeniu']."'";
   $resursa = mysqli_query($conn, $sql);
   $row = mysqli_fetch_assoc($resursa);
   $domeniu=$row['domeniu'];

   /* si afisam numele vechi de domeniu intr-un textbox pentru a fi modificat*/

?>

<h1>Modifica nume domeniu</h1>

<form action="prelucrare_modificare_stergere.php" method="POST">
    <INPUT type="text" name="domeniu" value="<?=$domeniu?>">
    <INPUT type="hidden" name="id_domeniu" value="<?=$_POST['id_domeniu']?>">
    <INPUT type="submit" name="modifica_domeniu" value="Modifica"> 
</form>

<?php

}

/*   Sterge domeniu */

/*include("sterge_domeniu.php");*/

 if(isset($_POST['sterge_domeniu']))
 {
   /* verificam daca sunt carti in tabela care apartin acestui domeniu */

   $sql = "select nume_piesa, compozitor from piese,compozitori,domenii 
		where piese.id_domeniu=domenii.id_domeniu and 
                      piese.id_compozitor=compozitori.id_compozitor and 
		      domenii.id_domeniu=".$_POST['id_domeniu'];
      
   $resursa = mysqli_query($conn, $sql);   
   $nrCarti = mysqli_num_rows($resursa);

   /* daca sunt carti apartinand acestui domeniu afisam lista lor si un mesaj de eroare */

   if($nrCarti > 0)
   {
	print "<p>Sunt $nrCarti carti care apartin acestui domeniu</p>";
	while($row = mysqli_fetch_array($resursa))
	{
  			print "<b>".$row['nume_piesa']."</b> de ".$row['compozitor']."<br>";
	}
      print "<p>Nu puteti sterge acest domeniu </p>";
   }
      /* iar daca nu sunt carti in acest domeniu cerem confirmarea pcntru stergere: */
    else{

?>

<h1>Sterge nume domeniu</h1> 

	Esti sigur ca vrei sa stergi acest domeniu?

<form action="prelucrare_modificare_stergere.php" method="POST">
   <INPUT type="hidden" name="id_domeniu" value="<?=$_POST['id_domeniu']?>">
   <INPUT type="submit" name="sterge_domeniu" value="Sterge!"> 
</form>

<?php
 }
}


 /*modifica/sterge autor

  modificare nume autor */ 

 if(isset($_POST['modifica_compozitor']))
 {
   /* luam numele autorului din tabela deoarece ne-a fost trimis 
     din formular doar id_autor: 
   */

  $sql = "select compozitor from compozitori where id_compozitor='".$_POST['id_compozitor']."'";
  $resursa = mysqli_query($conn, $sql); 
  $row = mysqli_fetch_assoc($resursa);
  $compozitor=$row['compozitor'];

  /* si afisam numele autorului intr-un textbox pentru a fi modificat */

?>

<h1>Modifica nume compozitor</hl> 

<form action="prelucrare_modificare_stergere.php" method="POST">
   <INPUT type="text" name="compozitor" value="<?=$compozitor?>">
   <INPUT type="hidden" name="id_compozitor" value="<?=$_POST['id_compozitor']?>">
   <INPUT type="submit" name="modifica_compozitor" value="Modifica"> 
</form>

<?php
 }

 /* Sterge autor */

  if(isset($_POST['sterge_compozitor']))
  {
      /*verificam daca sunt carti in tabela care apartin acestui autor: */
     
     $sql = "select nume_piesa from piese, compozitori where piese.id_compozitor=compozitori.id_compozitor and
				 piese.id_compozitor=".$_POST['id_compozitor']; 
     $resursa = mysqli_query($conn, $sql);
     $nrCarti = mysqli_num_rows($resursa);

     /* daca sunt carti apartinand acestui autor, afisam lista lor si un mesaj de eroare: */

    if($nrCarti > 0)
    {
	print "<p>Sunt $nrCarti piese de acest compozitor in tabela!</p>"; 
	while($row = mysqli_fetch_array($resursa))
	{
   		print $row['nume_piesa']."<br>"; 
	}

	print "<p>Nu puteti sterge acest compozitor!</p>";

    } 
    /* iar daca nu sunt carti scrise de acest autor cerem confirmarea pentru stergere */

    else
	{

?> 

<h1>Sterge compozitorul</h1>

	Esti sigur ca vrei sa stergi acest compozitor?

<form action="prelucrare_modificare_stergere.php" method="POST">
   <INPUT type="hidden" name= "id_compozitor" value="<?=$_POST['id_compozitor']?>">
   <INPUT type="submit" name="sterge_compozitor" value="Sterge!">
</form>

<?php
 }
}

  /*modifica/sterge carte
  modificare nume carte */ 

 if(isset($_POST['modifica_piesa']))
 {
      print "<h1>Modificare piesa</h1>";

      /* cautam intai o carte care are titlul si id_autor specificate in formular*/
      /* cautam intai o carte care are titlul si id_autor specificate in formular*/

      $sqlProdus= "select * from piese where nume_piesa='".$_POST['nume_piesa']."' and 
					 id_compozitor=".$_POST['id_compozitor'];
      $resursaProdus=mysqli_query($conn, $sqlProdus);

      /*daca nu s-a gasit nici o carte care sa corepunda datelor introduse, 
	afisam un mesaj de eroare*/

      if(mysqli_num_rows($resursaCarte) == 0)
      {
		print "Aceasta piesa nu exista in tabela";   
      }
	  else
	  {

        /* daca exista, atunci extragem informatiile din resursa, le punem intr-un array 
	  (nu folosim while deoarece este returnat un singur rand!) si le afisam in 
	  formular pentru a fi modificate*/

        $rowCarte = mysqli_fetch_array($resursaCarte);
	/*print_r($rowCarte);*/
?> 
	<form action="prelucrare_modificare_stergere.php" method="POST">
	<table>
  	<tr>
      	  <td>Domeniu:</td>
      	  <td><SELECT name="id_domeniu">
          <?php
           /* Luam numele de domenii din tabela si Ie afisam utilizatorului intr-o lista drop-   
              down. Observati folosirea lui if pentru a afisa ca selectat domeniul de care apartine  
              cartea
           */

           $sql="select * from domenii order by domeniu asc";
		   $resursa = mysqli_query($conn, $sql);
           while($row=mysqli_fetch_array($resursa))
           {
				if($row['id_domeniu'] == $rowCarte['id_domeniu'])
				{
					print '<option SELECTED value="'.$row['id_domeniu'].'">'.$row['domeniu'].'</option>';
				}
				else
				{
					print '<option value="'.$row['id_domeniu'].'">'.$row['domeniu'].'</option>';
				}
           }

          ?>

    	 </select>
       </td> 
      </tr> 
      <tr> 
       <td>compozitor:</td>
       <td>
        <select name="id_compozitor"> 
          
        <?php

        /* Afisam si lista dropdown cu autori */

        $sql = "select * from compozitori order by compozitor asc"; 
        $resursa = mysqli_query($conn, $sql); 
        while($row = mysqli_fetch_array($resursa))
        {
		   if($row['id_compozitor'] == $rowCarte['id_compozitor'])
		   {
				print '<option SELECTED value="'.$row['id_compozitor'].'">'.$row['compozitor'].'</option>';
		   }
		   else
		   {
				print '<option value="'.$row['id_compozitor'].'">'.$row['compozitor'].'</option>';
		   }
        }

        ?> 

        </select>
      </td> 
     </tr> 
     <tr> 
      <td>Titlu:</td>
      <td> 
         <INPUT type="text" name="nume_piesa" value="<?=$rowCarte['nume_piesa']?>">
      </td>
     </tr> 
     <tr> 
      <td valign = "top"> Descriere: </td>
      <td><textarea name = "descriere" rows="8"><?=$rowCarte['descriere']?>
          </textarea>
      </td>
     </tr> 
     <tr> 
      <td>Pret:</td>
      <td>
	<INPUT type="text" name="pret" value="<?=$rowCarte['pret']?>">
      </td>
     </tr>
   </table> 
    <INPUT type="hidden" name="id_piesa" value="<?=$rowCarte['id_piesa']?>">
    <INPUT type="submit" name="modifica_piesa" value="Modifica"> 
 </form>

 <?php
 }
}
 /* si in final stergere carte */

 if(isset($_POST['sterge_piesa']))
 {
   print "<h1>Sterge piesa</h1>";

   /* cautam intai o carte in tabela care are titlul si id_autor specificate in 
      formular
   */

   $sqlCarte = "select * from piese where piesa='".$_POST['piesa']."' and 
   				    id_compozitor=".$_POST['id_compozitor'];
 
   $resursaCarte = mysqli_query($conn, $sqlCarte);

   /* daca nu s-a gasit nici o carte care sa corespunda datelor introduse afisam 
      un mesaj de eroare 
   */

   if(mysqli_num_rows($resursaCarte) == 0)
   {
		print "Aceasta piesa nu exista in tabela";
   }
   else
   {
        /* iar daca exista atunci extragem id_ul cartii din tabela si il vom folosi 
        intr-un camp ascuns din formularul de confirmare */

		$row = mysqli_fetch_assoc($resursaCarte);
		$id_carte=$row['id_piesa'];
   ?>

  Esti sigur ca vrei sa stergi aceasta piesa ?

  <form action="prelucrare_modificare_stergere.php" method="POST">
    <INPUT type="hidden" name="id_piesa" value="<?=$id_carte?>">
    <INPUT type="submit" name="sterge_piesa" value="Sterge!"> 
  </form>

<?php
 }
}
?>

</body>
</html>
