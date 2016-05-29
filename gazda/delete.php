<?php
	error_reporting(E_ALL ^ E_DEPRECATED);

	include 'connection.php';
 
	if( isset($_GET['del']) )
	{
		$id = $_GET['del'];
		$info1 = mysql_fetch_array(mysql_query("SELECT * FROM `topik` WHERE `TopikID` = '$id'"));
		$info2 = $info1['DatumObjave'];
		$lastid = mysql_fetch_array(mysql_query("SELECT MAX(TopikID) FROM topik"));
		$lastID = $lastid[0];
		
		
		for ($x = 1; $x <= $lastID; $x++) {
			
			$info = mysql_fetch_array(mysql_query("SELECT * FROM `topik` WHERE `TopikID` = '$x'"));
			$datums = $info['DatumObjave'];
			if($datums > $info2 ){
			$date = strtotime("-1 day", strtotime("$datums"));
			$date1 = date("Y-m-d", $date);
			mysql_query("UPDATE topik SET DatumObjave='$date1' WHERE TopikID = '$x'") or die(mysql_error());
			}
		}
		
		$sql= "DELETE FROM topik WHERE TopikId='$id'";
		$res= mysql_query($sql) or die("Failed".mysql_error());
		echo "<meta http-equiv='refresh' content='0; url=moderator.php'>";
	}
?>