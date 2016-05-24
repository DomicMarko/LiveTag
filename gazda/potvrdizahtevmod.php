<?php
	error_reporting(E_ALL ^ E_DEPRECATED);

	include 'connection.php';
 
	if( isset($_GET['novi']) )
	{
		$id = $_GET['novi'];
		
		$info = mysql_fetch_array(mysql_query("SELECT * FROM `zahtev` WHERE IDzahtev='$id'"));
		$name = $info['Naziv'];
		$idkor = $info['KorisnikID'];
		
		mysql_query("INSERT INTO topik (`TopikID`, `Naziv`, `DatumObjave`) 
							VALUES(NULL, '$name', CURDATE())") or die(mysql_error());
		mysql_query("UPDATE topik SET KorisnikID='$idkor' WHERE Naziv = '$name'") or die(mysql_error());
		mysql_query("DELETE FROM zahtev WHERE IDzahtev='$id'") or die(mysql_error());
		
		echo "<meta http-equiv='refresh' content='0; url=moderator.php'>";
	}
?>