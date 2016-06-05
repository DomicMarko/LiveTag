

<?php 
	/*	################################################################
	Autor: Aleksandar Genal 2013/0012, tim Elites
	Projekat: LiveTag
	Verzija: 1.0
	
	################################################################# */ 
session_start();
	if(!isset($_SESSION["loggedin"])||$_SESSION["loggedin"]!=true){
		header("Location: ../genal/login.php");
		exit();
	}
 ?>
