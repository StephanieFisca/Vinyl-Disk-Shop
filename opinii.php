<?php
 session_start();
 include("conectare.php");
 include("admin_top.php"); 
?>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2">
  <link rel="stylesheet" href="adaugare.css">
</head>
<div class="page">
<h1>Modificare sau stergere comentarii utilizatori</h1>
<b>Comentariile utilizatorilor de la ultima moderare</b>

<?php
 $sql = "select * from comentarii, admin, piese, compozitori where 
			id_comentariu>admin.ultimul_comentariu_moderat and 
			piese.id_piesa=comentarii.id_piesa and 
			piese.id_compozitor=compozitori.id_compozitor 
			order by id_comentariu asc"; 
 /*print $sql;*/
 $resursa = mysqli_query($conn, $sql); 

 while($row=mysqli_fetch_array($resursa))
 {

?>

  <form action="formulare_moderare_opinii.php" method="POST">

    <div style="width:500px; border:1px solid #ffffff; 
     background-color:#F9F1E7; padding:5px">     

     <b><?=$row['nume_piesa']?></b> de: <?=$row['compozitor']?>
     <hr size="1"> 
      <a href="mailto:<?=$row['adresa_email']?>"><?=$row['nume_utilizator']?>
      </a><br>
      <?=$row['comentariu']?> 
    </div>

    <INPUT type="hidden" name="id_comentariu" value="<?=$row['id_comentariu']?>">
    <INPUT type="submit" name="modifica" value="Modifica"> 
    <INPUT type="submit" name="sterge" value="Sterge">
  </form>

<?php

 $ultimul_id = $row['id_comentariu']; 

 /*Aceasta variabila preia la fiecare iterare cu while a array-ului 
   valoarea id_comentariu, ajungand ca la ultima iterare sa aiba 
   valoarea id-ului ultimului comentariu. 
   Avem nevoie de aceasta valoare astfel incat sa putem seta valoarea 
   campului ultimul_comentariu_moderat din tabelul admit folosind formularul urmator. 
 */

 } 

 /*In continuare vom scrie o structura conditionala.
   Daca sunt colnentarii in lista afisaln formularul si 
   butonul de setare a comentariilor ca fiind moderate. 
   Daca nu e nici un comentariu in lista vom afis:a doar un mesaj. 
   Astfel evitam erorile care ar putea aparea daca nu avem comentarii 
   in lista si valoarea variabilei $ultimul_comentariu ar fi nula. 
 */

 $nrComentarii=mysqli_num_rows($resursa); 

 if($nrComentarii > 0)
 { 

?>

<form action="formulare_moderare_opinii.php" method="POST">
 <INPUT type="hidden" name="ultimul_id" value="<?=$ultimul_id?>">
 <INPUT type="submit" name="seteaza_moderate" value="Seteaza aceste comentarii ca fiind moderate">
</form> 

<?php

  }
  else
  {
	print "NU exista comentarii noi!!";
  }

?>
</div>
</body> 
</html>

