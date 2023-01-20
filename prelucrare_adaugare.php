<?php
  session_start();
  include("autorizare.php");
  include("admin_top.php");
  include("conectare.php");
  
if(isset($_POST['adauga_domeniu']))
{
  /*
  inainte de a introduce noul nume de domeniu verificam doua lucruri:
	-campul sa nu fie gol,
	-sa nu existe deja in tabela
  */
  if($_POST['domeniu_nou'] == "")
  {
	print 'Terbuie sa completati numele de domeniu! <br>
        <a href="adaugare.php">Back</a>';
        exit;
  }
  /*verificam daca nu exista deja in tabela*/

  $sql="select * from domenii where domeniu='".$_POST['domeniu_nou']."'";
  $sursa=mysqli_query($conn, $sql);

  /*interogarea returneaza 0 randuri daca domeniul nu exista in tabela. 
    Daca nu returneaza 0 inseamna ca domeniul exista deja in tabela, 
    nu-l vom mai introduce inca o data, vom atentiona utilizatorul de eroare 
    si vom intrerupe executia scriptului 
  */
  if(mysqli_num_rows($sursa) != 0)
  {
	print 'Domeniul <b>'.$_POST['domeniu_nou'].'</b> exista deja in baza de date!<br>
               <a href="adaugare.php">Back</a>';
        exit;
  }

  /*adaugam noul nume de domeniu in tabela*/

  $sql="insert into domenii(domeniu) values('".$_POST['domeniu_nou']."')";
  mysqli_query($conn, $sql);

  /*afisam utilizatorului un mesaj de confirmare*/   
	print 'Domeniul <b>'.$_POST['domeniu_nou'].'</b> a fost adaugat in tabela!<br>
               <a href="adaugare.php">Back</a>';
        exit;
}

  /*acelasi script cu mici diferente il vom folosi pentru a adauga un autor nou*/

  if(isset($_POST['adauga_compozitor']))
  {
	    /*verificam campul sa nu fie gol*/
    if($_POST['compozitor_nou'] == "")
    {
	print 'Trbuie sa completati numele autorului! <br>
               <a href="adaugare.php">Back</a>';
        exit;
    }
  /*verificam daca nu exista deja in tabela*/

  $sql="select * from compozitori where compozitor='".$_POST['compozitor_nou']."'";
  $sursa=mysqli_query($conn, $sql);
  if(mysqli_num_rows($sursa) != 0)
  {
	print 'compozitor <b>'.$_POST['compozitor_nou'].'</b> exista deja in tabela!<br>
               <a href="adaugare.php">Back</a>';
        exit;
  }

  /*am verificat sa nu fie erori si putem sa adaugam in tabela*/

  $sql="insert into compozitori(compozitor) values('".$_POST['compozitor_nou']."')";
  mysqli_query($conn, $sql);

  /*afisam utilizatorului un mesaj de confirmare*/   

	print 'compozitor <b>'.$_POST['compozitor_nou'].'</b> a fost adaugat in tabela!<br>
               <a href="adaugare.php">Back</a>';
        exit;
}

/*
  scriptul pentru adaugarea cartii va fi un pic mai complicat deoarece trebuie sa facem 
  mai multe verificari la nivel de variabile  
*/

if(isset($_POST['adauga_piesa']))
{
   	/*verificam daca titlul, descrierea sau pretul nu sunt goale*/

       if($_POST['nume_piesa'] == "" || $_POST['descriere'] == "" || $_POST['pret'] == "")
       {
	  print 'Trebuie sa completati toate campurile: titlu, descriere, pret! <br><a href="adaugare.php">Back</a>';
          exit;
       }

       /*verificam daca valoarea introdusa in campul pret este de tip numeric*/

       if(!is_numeric($_POST['pret']))
       {
	  print 'campul pret trebuie sa fie de tip numeric!<br>
	         <a href="adaugare.php">Back</a>';
          exit;
       }
	  /*verificam daca aceasta carte nu exista deja in tabela*/

       $sql="select * from piese where id_compozitor='".$_POST['id_compozitor']."' and nume_piesa='".$_POST['nume_piesa']."'";
       $sursa=mysqli_query($conn, $sql);
       if(mysqli_num_rows($sursa) != 0)
       {
		print 'Aceasta carte exista deja in baza de date! <br>
		<a href="adaugare.php">Back</a>';
  		exit;
       }

	  /*am verificat sa nu existe erori, deci putem adauga carti in baza de date*/		

	  $sql="insert into piese(id_compozitor,nume_piesa,descriere,pret,datai,id_domeniu) VALUES(
						     '".$_POST['id_compozitor']."',
						     '".$_POST['nume_piesa']."',
						     '".$_POST['descriere']."',
						     '".$_POST['pret']."',
						     '".$_POST['datai']."',
						     '".$_POST['id_domeniu']."')";
	  mysqli_query($conn, $sql);

	  /*afisam utilizatorului un mesaj de confirmare*/

	  print 'Piesa a fost adaugata in tabela!<br>
	  	 <a href="adaugare.php">Back</a>';
	  exit;
	}
?>
</body>
</html>