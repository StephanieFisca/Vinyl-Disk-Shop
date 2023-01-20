<?php
//session_start();

include("f_autorizare.php");

if(!autorizat())
{
	print 'Acces neautorizat';
	exit;
}

//include("meniu.php");
//include("main.php");

?>
