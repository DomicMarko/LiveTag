<?php 
session_start();
	if(!isset($_SESSION["userType"])||$_SESSION["userType"]!="admin"){
		header("Location: ../genal/login.php");
		exit();
	}
 ?>