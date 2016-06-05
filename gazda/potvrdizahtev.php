<!--################################################################
	Autor: Veljko Marković 2013/0137, tim Elites
	Projekat: LiveTag
	Verzija: 1.0
	
################################################################# 
-->

<?php
	
	session_start();
	
	error_reporting(E_ALL ^ E_DEPRECATED);

	include 'connection.php';
 
	if( isset($_GET['novi']) )
	{
		$id = $_GET['novi'];
		
		$info = mysql_fetch_array(mysql_query("SELECT * FROM `zahtev` WHERE ZahtevID='$id'"));
		$name = $info['Naziv'];
		$idkor = $info['KorisnikID'];
		
		$maxd = mysql_fetch_array(mysql_query("SELECT MAX(DatumObjave) FROM `topik` "));
		$maxdate = $maxd[0];
		$date = strtotime("+1 day", strtotime("$maxdate"));
		$konacan = date("Y-m-d", $date);
		
		mysql_query("INSERT INTO topik (`TopikID`, `Naziv`, `DatumObjave`) 
							VALUES(NULL, '$name', '$konacan')") or die(mysql_error());
		mysql_query("UPDATE topik SET KorisnikID='$idkor' WHERE Naziv = '$name'") or die(mysql_error());
		mysql_query("DELETE FROM zahtev WHERE ZahtevID='$id'") or die(mysql_error());
		
		
		if($_SESSION["userType"]=="mod")
		echo "<meta http-equiv='refresh' content='0; url=moderator.php'>";
		else if($_SESSION["userType"]=="admin") echo "<meta http-equiv='refresh' content='0; url=adminmoderator.php'>";
	}
?>