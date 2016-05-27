<?php 
	if(!isset($_SESSION["userType"])||$_SESSION["userType"]!="mod"){
		header("Location: ../genal/login.php");
		exit();
	}
 ?>