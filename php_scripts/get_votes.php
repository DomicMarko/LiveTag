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
	
	// get image id
	$imageID = $_POST['imageID'];
	
	// connecting to db
	$dbb = new DB_CONNECT();
	
	$db = $dbb->getDb();

	// making new query executor
	$executor = new queryExecutor($db);		

	$response["votes"] = array();
	
	$queryForVotes = "SELECT k.KorisnikID, k.Username, k.AvatarURL " .
		"FROM glasovi g, korisnik k " . 
		"WHERE g.SlikaID = " . $imageID . " " . 
		"AND g.KorisnikID = k.KorisnikID";					
	
	// get votes
	$resultVotes = $executor->getRecordSet($queryForVotes);//mysqli_query($db, $queryForVotes) or die(mysqli_error());

	if ($resultVotes != 0) {

		$response["status"] = 1;
		
		for ($i = 0; $i < count($resultVotes); $i++) {

			// temp user array
			$userVote = array();
			$userVote["userID"] = $resultVotes[$i]["KorisnikID"];
			$userVote["username"] = $resultVotes[$i]["Username"];
			$userVote["avatarURL"] = $resultVotes[$i]["AvatarURL"];				
	
			// push single product into final response array
			array_push($response["votes"], $userVote);
		}
			
	} else {
		$response["status"] = 0;
	}
		
	// echo response as JSON
	echo json_encode($response);

?>