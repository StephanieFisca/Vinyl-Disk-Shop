<?php

/* Reiniţializăm sesiunea deoarece dorim să verificăm numărul de cărţi comandate */
session_start();
/*numărul de cărţi comandate îl aflăm folosind array.sum.array_sum($array} returnează suma
valorilor dintr-un array dacă acestea sunt numerice. Astfel, dacă $a = array[‘1’,’1’,’2’],
array_sum($a)=4. A nu se confunda array_sum cu count: count($a) = 3 elemente in timp ce
array_sum($a)=4 calculează suma elementelor.*/

/* în acest moment toate datele sunt verificate, putem să ne conectăm la baza de date pentru a le
introduce: */
include('conectare.php');

/* Introducem întâi datele în tabelul tranzacţii. Deoarece câmpul data din tabel este de tip
TIMESTAMP, îl putem omite (se va seta singur, cu data curentă) */
$sqlTranzactie = "insert into tranzactii (nume_utilizator, adresa_utilizator)
values('".$_POST['nume']."', '".$_POST['adresa']."')";
$resursaTranzactie = mysqli_query($conn, $sqlTranzactie);
/* Obţinem id_ul acestei înregistrări folosind mysql_insert_id: */
$id_tranzactie = mysqli_insert_id($conn);
/* iar acum luăm fiecare carte din sesiune şi o introducem în tabelul vânzări. Introducem în tabel
doar cărţile al căror număr de bucăţi este mai mare ca 0 (regăsită în condiţia if, din cadrul
structurii for): */
for($i=0; $i<count($_SESSION['id_piesa']); $i++)
{
	if($_SESSION['nr_piese'][$i] > 0)
	{
		/* Creăm interogarea */
		$sqlVanzare = "INSERT INTO vanzari (id_tranzactie,id_piesa,nr_piese) VALUES('".$id_tranzactie."','".
		$_SESSION['id_piesa'][$i]."','".
		$_SESSION['nr_piese'][$i]."')";
		
		/* şi o rulăm */
		mysqli_query($conn, $sqlVanzare);
	}
}

/* Urmează sa trimitem un email de notificare folosind funcţia mail.
mail foloseşte în principal trei argumente: mail:
- adresa destinatarului,
- subiectul mesajului,
- textul mesajului, dar mai poate prelua unul pentru headere adiţionale;
*/
$emailDestinatar = "unemail@yahoo.com";
/* schimbaţi adresa cu cea la care doriţi să primiţi mesajele */
$subiect = "O nouă comandă!";
/* Pentru a compune mesajul ne vom folosi de operatorul ”.=” de concatenare a stringurilor. */
$mesaj = "O nouă comandă de la <b>".$_POST['nume']."</b><br>";
$mesaj .= "Adresa:".$_POST['adresa']."<br>";
$mesaj .= "Cărţile comandate: <br><br>";
$mesaj .= "<table border='1' cellspacing='0' cellpadding='4'>";
$totalGeneral =0;
for ($i=0;$i < count($_SESSION['id_piesa']) ; $i++)
{
	if($_SESSION['nr_piese'][$i] > 0) 
	{
		$mesaj .= "<tr><td>".$_SESSION['nume_piesa'][$i]." ".$_SESSION['compozitor'] [$i].
		"</td><td>".$_SESSION['nr_piese'][$i]. "buc</td></tr>";
		$totalGeneral = $totalGeneral + ($_SESSION['nr_piese'][$i] * $_SESSION['pret'][$i]);
	}
}
$mesaj .= "</table>";
$mesaj .= "Total:<b>".$totalGeneral."</b>";
/* putem pune diacritice în cadrul unui string însă pentru ca browserul să le afişeze corect va
trebui să specificăm în <head> setul de caractere folosit, la fel ca într-un document HTML.
Punem headere adiţionale pentru a trimite mesajul în format HTML şi encodingul potrivit pentru
caractere’ romaneşti: */
$headers = "MIME-Version: 1.0\r\nContent-type: text/html; charset=iso-8859-2\r\n";
/* conditiile fiind indeplinite putem trimite emailul: */
/* Curăţăm sesiunea deoarece nu mai avem nevoie de datele din ea.*/
session_unset() ;
/* eliminăm toate variabilele asociate acestei sesiuni */
session_destroy();
/* ştergem sesiunea si în final afişăm utilizatorului pagina cu mesajul de mulţumire: */
include("page_top.php");
include("meniu.php");
?>
<td valign="top">
<h1><Multumim!</h1>
Va multumim ca aţi cumpărat de la noi! Veţi primi comanda solicitata in cel mai scurt timp.
</td>