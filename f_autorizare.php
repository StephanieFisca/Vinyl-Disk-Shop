<?php
//session_start();


function autorizat()
{
  include("conectare.php");
  $sql="select * from admin where admin_nume='".$_SESSION['nume_admin']."' and 
                                admin_parola='".$_SESSION['parola_encriptata']."'";
  $sursa=mysqli_query($conn, $sql);
  if($_SESSION['key_admin'] != session_id() || mysqli_num_rows($sursa) != 1)
  {
	return false;
  }
  else
  {
  	return true;
  }
}
?>