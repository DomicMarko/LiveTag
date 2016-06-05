	/*	################################################################
	Autor: Aleksandar Genal 2013/0012, tim Elites
	Projekat: LiveTag
	Verzija: 1.0
	
	################################################################# */ 
<?php 
	session_start();
	session_destroy();
	header("Location: login.php")
 ?>
