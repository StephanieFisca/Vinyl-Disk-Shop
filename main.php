<?php
 /*verifica doar autorizarea*/

 if(!autorizat())
 {
	print "Acces neautorizat";
	exit;
 }
?>