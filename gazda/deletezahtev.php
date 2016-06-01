<?php

	session_start();

	error_reporting(E_ALL ^ E_DEPRECATED);

	include 'connection.php';
 
	if( isset($_GET['del']) )
	{
		$id = $_GET['del'];
		$sql= "DELETE FROM zahtev WHERE ZahtevID='$id'";
		$res= mysql_query($sql) or die("Failed".mysql_error());
		if($_SESSION["userType"]=="admin")
		echo "<meta http-equiv='refresh' content='0; url=adminmoderator.php'>";
		else if($_SESSION["userType"]=="mod") echo "<meta http-equiv='refresh' content='0; url=moderator.php'>";
	}
?>