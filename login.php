<?php
session_start();

/* verificam daca au fost completate amandoua campurile */

if($_POST['nume'] == "" || $_POST['parola'] == "")
{
	print 'trebuie sa completati amandoua randurile! <br>
	<a href="index.php">Back</a>';
	exit;
}

/* Daca au fost completate, ne conectam la baza de date perntru a putea confrunta datele. Folosim fisierul conectare.php din document root:*/ 

include("conectare.php");

/* mysql_connect("localhost", "root", "");
mysql_select_db("librarie"); */ 

/* Criptam parola trimisa prin formular tot cu md5, pentru a o avea in formatul in care ea exista in baza de date: */ 

 $parolaEncriptata=$_POST['parola'];

/*
 pentru ca login.php sa poata confrunta datele din formular cu cele din baza de date 
 trebuie sa construim o tabela admin in baza de date adica . 
 CREATE TABLE admin (admin_nume text NOT NULL, admin_parola text NOT NULL);
 parola in acest tabel se va tasta criptata pentru a nu fi la indemana oricui astfel:
 INSERT INTO admin VALUES ("administrator", md5("pArOlA"));
*/

/* si scriem interogarea de verificare: */

$sql = "select * from admin where admin_nume='".$_POST['nume']."' and 
				admin_parola='".$parolaEncriptata."'";

/*print "<br>".$sql."<br>";*/

$resursa = mysqli_query($conn, $sql);
/*print_r($resursa."<br>");*/

/* Aceasta interogare, daca este executata cu succes (numele si parola din formular 
sunt valide si corespund celor din baza de date) ar trebui sa returneze un singur rand 
din tabelul admin, care corespunde numelui si parolei. Pentru multi programatori, 
verificarea returnarii unui rezultat este de ajuns pentnu a acorda accesul mai departe. 
Noi vom extinde protectia si vom acorda accesul doar daca rezultatul returnat are 
un singur rand (in caz contrar, vom afisa un mesaj de eroare si vom opri executia 
scriptului daca numarul de randuri nu este 1): 
*/

if(mysqli_num_rows($resursa) != 1)
{
	print 'Nume sau parola eronata<br>
		<a href="index.php">Back</a>';
	exit;
	/*pentru a putea vedea ce se ascunde in variabilele $sql, $resursa, ect�le  
            putem chiar afisa folosind print astfel:

	print_r(mysql_num_rows($resursa));
	*/
}

/* Pana acum s-au facut toate verificarile, numele si parola sunt corecte, 
sa trecem la autentificarea propriu-zisa. 
Vom folosi variabile de sesiune pentru a pastra in memorie cateva informatii 
despre autentificare, pentru a le reverifica mai tarziu, 
atunci cand accesam alte pagini din cadrul sectiunii de administrare. 
Pornim intai sesiunea dupa care trecem la salvarea informatiilor in ea: 
*/

 $_SESSION['nume_admin'] = $_POST['nume']; 
 $_SESSION['parola_encriptata'] = $parolaEncriptata;
 $_SESSION['key_admin'] = session_id(); 

/*header("location: admin.php");*/
include("admin.php");
?>
