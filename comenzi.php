<?php
 session_start();
 include("conectare.php");
 include("admin_top.php");
?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2">
  <link rel="stylesheet" href="adaugare.css">
</head>
<div class="page">
<h2>Comenzi</h2>
<b>Comenzi neonorate</b>
<?php
/* Afi   lista comenzilor neonorate (WHERE comanda_onorata=0) din
   tabelul tranzac?? 
*/

$sqlTranzactii = "select id_tranzactie, DATE_FORMAT(data_tranzactie,'%d-%m-%y')
                 as data_tranzactie, nume_utilizator, adresa_utilizator from tranzactii where comanda_onorata=0";

/*DATE_FORMAT este o func?? a MySQL cu care putem formata o dat?tocat?ntr-un
timestamp dup?um dnrim
 (?cazul de fa? zz-ll-aaaa). Func??nu modific?imic in tabela ci doar
afi  eaz?n TIMESTAMP intr-un 
 format mai u  or digerabil (04-3-2003 ?loc de 20030304) 
*/

$resursaTranzactii = mysqli_query($conn, $sqlTranzactii);
while($rowTranzactie = mysqli_fetch_array($resursaTranzactii))
{
   $totalGeneral = 0;                
?>

<form action="prelucrare_comenzi.php" method="POST">
 Data  comenzii:

 <b><?=$rowTranzactie['data_tranzactie']?></b>
 <div style="width:500px; border:lpx solid #ffffff; background-color #F9F1E7;
padding:5px">

 <b><?=$rowTranzactie['nume_utilizator']?></b><br>
    <?=$rowTranzactie['adresa_utilizator']?>

 <TABLE border="1" cellpadding="4" cellspacing="0">
  <tr>
    <td align="center"><b>Piesa</b></td>
	<td align="center"><b>Compozitor</b></td>
    <td align="center"><b>Nr.piese</b></td>
    <td align="center"><b>Pret</b></td>
    <td align="center"><b>Total</b></td>
  </tr>

<?php

  /*   i, pentru fiecare tianzactie, afi   cartile 
   comandate (titlul   i autorul), numarul si valoarea lor: 
  */

  $sqlCarti = "select nume_piesa,compozitor,pret,nr_piese from vanzari,piese,compozitori 
                        where piese.id_piesa=vanzari.id_piesa and 
                        piese.id_compozitor=compozitori.id_compozitor and 
                        id_tranzactie=".$rowTranzactie['id_tranzactie'];
 
  $resursaCarti=mysqli_query($conn, $sqlCarti); 

        

  while($rowCarte=mysqli_fetch_array($resursaCarti))
  { 
        print '<tr><td>'.$rowCarte['nume_piesa'].'</td>';
		print '<td>'.$rowCarte['compozitor'].'</td>';
        print '<td align="right">'.$rowCarte['nr_piese'].'</td>';
        print '<td align="right">'.$rowCarte['pret'].'</td>';

/* 62 Calculam totalul pentru aceast?arte (pre??nr_buc)*/

  $total=$rowCarte['pret']*$rowCarte['nr_piese'];

/* Afisam acest total   i apoi il adunam la totalul general pentru aceast?omanda. */

  print '<td align="right">'.$total.'</td></tr>';

  $totalGeneral = $totalGeneral + $total;

  }

?>

 <tr><td  colspan="4" align="right">Total comanda</td> 
     <td><?=$totalGeneral?> lei </td> 
 </tr> 
</table>

 <INPUT type="hidden" name="id_tranzactie"  value="<?=$rowTranzactie['id_tranzactie']?>"> 
 <INPUT type="submit" name="comanda_onorata" value="Comanda_onorata"> 
 <INPUT type="submit" name="anuleaza_comanda" value="Anuleaza_comanda"> 
</div> 
</form> 
</div>
<?php 

}

?>

</body>
</html>
 

