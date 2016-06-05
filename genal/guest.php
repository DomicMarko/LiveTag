
<?php
	/*	################################################################
	Autor: Aleksandar Genal 2013/0012, tim Elites
	Projekat: LiveTag
	Verzija: 1.0
	
	################################################################# */ 
if (isset($_POST['submit2'])){
	session_start();
	$_SESSION["loggedin"]=true;
	$_SESSION["userID"]=0;
	$_SESSION["Username"]="gost";
	$_SESSION["userType"]="guest";
	header("Location: ../index.php");
}
?>
