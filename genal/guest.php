<?php
if (isset($_POST['submit2'])){
	session_start();
	$_SESSION["loggedin"]=true;
	$_SESSION["userID"]=0;
	$_SESSION["Username"]="gost";
	$_SESSION["userType"]="guest";
	header("Location: ../index.php");
}
?>