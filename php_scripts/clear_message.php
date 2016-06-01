<?php 

	/*	################################################################

	Autor: Marko Domić 2013/0240, tim Elites

	Projekat: LiveTag
	Verzija: 1.0
	
	################################################################# */ 



	// include db connect class
	require_once ('db_connect.php');

	// include queryExecutor class
	require_once ('connection_queries.php');

	// get loged in user id
	$logedInUserID = $_POST['userID'];

	// connecting to db
	$dbb = new DB_CONNECT();
	
	$db = $dbb->getDb();

	// making new query executor
	$executor = new queryExecutor($db);

	$queryDeleteMessage = "UPDATE korisnik " . 
			"SET StiglaPoruka = 0, PorukaZaElite = null " . 
			"WHERE KorisnikID = " . $logedInUserID;

	$resultDeleteMessage = $executor->queryWithoutRecords($queryDeleteMessage);//mysqli_query($db, $queryDeleteMessage) or die(mysqli_error());
?>