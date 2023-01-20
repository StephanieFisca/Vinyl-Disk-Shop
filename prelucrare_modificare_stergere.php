<?php
  session_start();
  include("autorizare.php");
  include("admin_top.php");
  include("conectare.php");

/* modificare nume domeniu */ 

if(isset($_POST['modifica_domeniu']))
{
  /* Verificam daca noul nume de domeniu a fost introdus. */ 
  if($_POST['domeniu']=="")
  {
 	print "Nu ati introdus numele domeniului ! ";
  }
  else
  {
    $sql = "update domenii set domeniu='".$_POST['domeniu']."' 
				where id_domeniu=".$_POST['id_domeniu'];
	mysqli_query($conn, $sql);
 	/*print '<br>'.$sql.'<br>';*/
 	print "numele domeniului a fost modificat!";
  }

  /* De ce nu am folosi exit in structura if(conditie) {codul de executat; exit}; ? Pentru 
  ca, daca nu se executa codul din if (conditie) {} , se executa codul din else {} si atunci 
  exit ar fi superfluu. */
}

/* stergere domeniu */

if(isset($_POST['sterge_domeniu']))
{
   $sql="delete from domenii where id_domeniu=".$_POST['id_domeniu'];
   mysqli_query($conn, $sql);
   print "Domeniul a fost sters!";
}

/* modificare nume domeniu */ 

if(isset($_POST['modifica_compozitor']))
{
  /* Verificam daca noul nume de domeniu a fost introdus. */ 
  if($_POST['compozitor']=="")
  {
 	print "Nu ati introdus numele compozitorului ! ";
  }
  else
  {
    $sql = "update compozitori set compozitor='".$_POST['compozitor']."' 
				where id_compozitor=".$_POST['id_compozitor'];
	mysqli_query($conn, $sql);
 	/*print '<br>'.$sql.'<br>';*/
 	print "numele compozitorului a fost modificat!";
  }

  /* De ce nu am folosi exit in structura if(conditie) {codul de executat; exit}; ? Pentru 
  ca, daca nu se executa codul din if (conditie) {} , se executa codul din else {} si atunci 
  exit ar fi superfluu. */
}

/* Stergere autor */ 

if(isset($_POST['sterge_compozitor']))
{
	$sql = "delete from compozitori where id_compozitor=".$_POST['id_compozitor'];
	mysqli_query($conn, $sql);
	print "compozitorul a fost sters!";
}

/* Modificare informatii carte */ 

if(isset($_POST['modifica_piesa']))
{
	/* Verificam daca toate datele au fost introduse corect. N-am vrea sa 
	introducem date eronate in tabela doar pentru ca a sarit pisica pe 
	tastatura si a apasat ENTER in timp ce introduceam datele. Daca, credeti  
	nu vi se poate intampla ... ei bine, din proprie experienta va spun ca se 
	ca poate. Vom folosi o structura  if  ... else if ... else: */

	if($_POST['nume_piesa'] == "")
	{
   		print "Nu ati introdus numele piesei !";
	}
    else if($_POST['descriere'] == "")
	{
    	print "Nu ati introdus descrierea !";
	}
    else if($_POST['pret'] == "")
	{
    	print "Nu ati introdus pretul !";
	}
    else if(!is_numeric($_POST['pret']))
	{
		print "Pretul trebuie sa fie numeric! Scrieti <b>1000</b>, nu <b>1000 lei</b>!";
	}
	else
	{
		$sql="update piese set 
			id_piesa=".$_POST['id_piesa'].",
			id_compozitor=".$_POST['id_compozitor'].",
			nume_piesa='".$_POST['nume_piesa']."',
			descriere='".$_POST['descriere']."',
			pret=".$_POST['pret']."
			where id_piesa=".$_POST['id_piesa']; 
		 /*print '<br>'.$sql.'<br>';*/
		mysqli_query($conn, $sql); 
		print "Informaliiile au fost modificate!";
  }
}

/* Stergere piesa */

if(isset($_POST['sterge_piesa']))
{
	$sqlCarte="delete from piese where id_piesa=".$_POST['id_piesa']; 
	mysqli_query($conn, $sqlCarte); 
    $sqlComentarii="delete from comentarii where id_piesa=".$_POST['id_piesa']; 
	mysqli_query($conn, $sqlComentarii);
    print "piesa a fost stearsa din tabela!";
}

?> 

</body>
</html>
