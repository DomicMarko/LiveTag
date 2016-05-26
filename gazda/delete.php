<?php
	error_reporting(E_ALL ^ E_DEPRECATED);

	include 'connection.php';
 
	if( isset($_GET['del']) )
	{
		$id = $_GET['del'];
		$lastid = mysql_fetch_array(mysql_query("SELECT MAX(TopikID) FROM topik"));
		$lastID = $lastid[0];
		
		if($id < $lastID){
		for ($x = $id +1; $x <= $lastID; $x++) {
			$info = mysql_fetch_array(mysql_query("SELECT * FROM `topik` WHERE `TopikID` = '$x'"));
			$datums = $info['DatumObjave'];
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