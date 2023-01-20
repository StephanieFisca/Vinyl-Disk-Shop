<?php
  session_start();
  include("autorizare.php");
  include("admin_top.php");
  include("conectare.php")
?>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2">
  <link rel="stylesheet" href="adaugare.css">
</head>
<div class="page">
<h2>Adaugare</h2>

 <b>Adauga Domeniu</b>
  <form action="prelucrare_adaugare.php" method="POST">
   Domeniu nou : <INPUT type="text" name="domeniu_nou">
	         <INPUT type="submit" name="adauga_domeniu" value="Adauga">
  </form>
 
 	<!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
	<br>
 <b>Adauga Compozitor</b>
  <form action="prelucrare_adaugare.php" method="POST">
     Compozitor nou : <INPUT type="text" name="compozitor_nou">
	         <INPUT type="submit" name="adauga_compozitor" value="Adauga">
  </form>

 	<!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
	<br>
 <b>Adauga Piesa</b>
  <form action="prelucrare_adaugare.php" method="POST">
   <table>
    <tr>
     <td>Domeniu</td>
     <td>
     <select name="id_domeniu">
	/*luam numele de domenii din tabela si le afisam utilizatorului intr_o 
	lista drop_down. Putem astfel obtine un id_domeniu corespunzator 
	domeniului selectat pe care sa-l introducem in tabelul cartii
	*/
      <?php
        $sql="select * from domenii order by domeniu asc";
        $sursa=mysqli_query($conn, $sql);
        while($row=mysqli_fetch_array($sursa))
		{
			print '<option value="'.$row['id_domeniu'].'">'.$row['domeniu'].'</option>';
        }
      ?>
     </select>
    </td>
   </tr>

   <tr>
     <td>compozitor:</td>
     <td>
     <select name="id_compozitor">
	/*afisam lista drop_down cu compozitor*/
      <?php
        $sql="select * from compozitori order by compozitor asc";
        $sursa=mysqli_query($conn, $sql);
        while($row=mysqli_fetch_array($sursa))
        {
			print '<option value="'.$row['id_compozitor'].'">'.$row['compozitor'].'</option>';
        }
      ?>
     </select>
    </td>
   </tr>

   <tr>
     <td>nume_piesa:</td>
     <td><input type="text" name="nume_piesa"></td>
    </tr>
 
    <tr>
     <td align="top">Descriere: </td>
     <td><textarea name="descriere" rows="8">
         </textarea>
     </td>
    </tr>
    
	<tr>
     <td>Data:</td>
     <td><input type="date" name="datai"></td>
    </tr>
	
    <tr>
     <td>Pret: </td>
     <td><input type="text" name="pret"></td>
    </tr>
    <tr>
     <td></td>
     <td><INPUT type="submit" name="adauga_piesa" value="Adauga"></td>
    </tr>
	
   </table>
  </form>
      </div>
 </body>
</html>