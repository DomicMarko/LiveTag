<?php
	error_reporting(E_ALL ^ E_DEPRECATED);

	include 'connection.php';
 
	if( isset($_GET['del']) )
	{
		$id = $_GET['del'];
		$sql= "DELETE FROM topik WHERE TopikId='$id'";
		$res= mysql_query($sql) or die("Failed".mysql_error());
		echo "<meta http-equiv='refresh' content='0; url=moderator.php'>";
	}
?>