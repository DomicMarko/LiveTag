<?php

		// include db connect class
	require_once ('db_connect.php');
	
	// include Pronounce class
	require_once ('pronounce_winners.php');

	// connecting to db
	$dbb = new DB_CONNECT();
	
	$db = $dbb->getDb();

	$currentDate = date("Y-m-d");	
	$dayBeforeTemp = strtotime("-1 day", strtotime($currentDate));
	$dayBefore = date("Y-m-d", $dayBeforeTemp);


	$pronounce = new Pronounce($currentDate, $dayBefore, $db);
	$a = $pronounce->updateService();

	echo $currentDate . "<br><br>" . $dayBefore . "<br><br>"; 

	//echo $a[0] . " - " . $a[1] . " - " . $a[2] . " - " . $a[3] . " - " . $a[4];

	//echo $a;
/*
	$a  = array();

	$a[0] = 1;
	$a[1] = 2;
	$a[2] = 3;
	$a[3] = null;
	$a[4] = null;

	echo $a[0] . " - " . $a[1] . " - " . $a[2] . " - " . $a[3] . " - " . $a[4];*/
?>