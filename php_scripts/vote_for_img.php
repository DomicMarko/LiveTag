<?php

	/*	################################################################

	Autor: Marko Domić 2013/0240, tim Elites

	Projekat: LiveTag
	Verzija: 1.0
	
	################################################################# */ 



	/*
	 * Following code will list all the images and info about them
	 */
	
	// include db connect class
	require_once ('db_connect.php');

	// include queryExecutor class
	require_once ('connection_queries.php');
	
	// array for JSON response
	$response = array();
	
	// connecting to db
	$dbb = new DB_CONNECT();
	
	$db = $dbb->getDb();

	// making reserve query executor
	$executor = new queryExecutor($db);
	
	$userLikeID = $_POST['userLike'];
	$imgID = $_POST['imgID'];

	// ############################################################################################# 
	//
	//		All queries

	$queryNumVotes = "SELECT * " . 
		"FROM glasovi " . 
		"WHERE KorisnikID = " . $userLikeID . " " .
		"AND SlikaID = " . $imgID;

	$queryDelete = "DELETE FROM glasovi " . 
		"WHERE KorisnikID = " . $userLikeID . " " .
		"AND SlikaID = " . $imgID;		

	$queryInsert = "INSERT INTO glasovi " . 
		"VALUES (" . $userLikeID . ", " . $imgID . ")";
	
	$queryVotes = "SELECT BrojGlasova " . 
		"FROM slika_post " . 
		"WHERE SlikaID = " . $imgID;

	// ############################################################################################# 
	
		
	// get current topic
	$resultVotes = $executor->getRecord($queryNumVotes);	
	
	if ($resultVotes != 0) {		

		// Delete from `glasovi` table vote			
		$executor->queryWithoutRecords($queryDelete);	
		$response["voted"] = false;											
	} else {
		
		// Insert into `glasovi` table new vote			
		$executor->queryWithoutRecords($queryInsert);	
		$response["voted"] = true;			
	}

	// Get current number of votes for certain image
	$resultVotesNumber = $executor->getRecord($queryVotes);				
		
	if($resultVotesNumber != 0) {
					
		$numberOfVotes = $resultVotesNumber["BrojGlasova"];
			
		$response["votes"] = $numberOfVotes;

	} else {
		$response["votes"] = 0;
	}
			
	// echo response as JSON
	echo json_encode($response);
	
?>
