<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2">
  <link rel="stylesheet" href="adaugare.css">
</head>
<div class="page">
<?php
 session_start();
 include("autorizare.php"); 
 include("admin_top.php");
 include("conectare.php");
 print ("<h2>Comenzi</h2>"); 

 /* comanda a fost onorat�*/
 if(isset($_POST['comanda_onorata']))
{
	 /*set�m c�mpul comanda_onorata �n tabela tranzac�ii pentru aceast� comand� */
	$sql = "update tranzactii set comanda_onorata=1 where id_tranzactie=".$_POST['id_tranzactie'];
	mysqli_query($conn, $sql);
	/* si afisam un mesaj*/

	print "Comanda a fost onorata"; 
}

/* comanda a fost anulat� */

if(isset($_POST['anuleaza_comanda']))
{
	/* Stergem tranzactia (din tabelul tranzacti.) si c�rtile comandate (din tabelul vanzari)*/

	$sqlTranzactii = "delete from tranzactii where id_tranzactie=".$_POST['id_tranzactie']; 
	mysqli_query($conn, $sqlTranzactii); 

	$sqlCarti = "delete from vanzari where id_tranzactie=".$_POST['id_tranzactie'];
	mysqli_query($conn, $sqlCarti);

	 /* si afisam un mesaj*/

	print "Comanda a fost anulata!"; 
}
?>
</div>
</body> 
</html>
