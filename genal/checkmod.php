	/*	################################################################
	Autor: Aleksandar Genal 2013/0012, tim Elites
	Projekat: LiveTag
	Verzija: 1.0
	
	################################################################# */ 

<?php 
	if(!isset($_SESSION["userType"])||$_SESSION["userType"]!="mod"){
		header("Location: ../genal/login.php");
		exit();
	}
 ?>
