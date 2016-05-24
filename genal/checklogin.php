<?php 
session_start();
	if(!isset($_SESSION["loggedin"])||$_SESSION["loggedin"]!=true){
		header("Location: ../genal/login.php");
		exit();
	}
 ?>