<?php

	/*
	 * Following code will list all the images and info about them
	 */
	
	// include db connect class
	require_once ('db_connect.php');

	// array for JSON response
	$response = array();
	
	// get image id
	$imageID = $_POST['imageID'];
	
	// connecting to db
	$dbb = new DB_CONNECT();
	
	$db = $dbb->getDb();		
	
	$queryForVotes = "SELECT k.KorisnikID, k.Username, k.AvatarURL " .
		"FROM glasovi g, korisnik k " . 
		"WHERE g.SlikaID = " . $imageID . " " . 
		"AND g.KorisnikID = k.KorisnikID";					
	
	// get votes
	$resultVotes = mysqli_query($db, $queryForVotes) or die(mysqli_error());
	
	$response["votes"] = array();

	if (mysqli_num_rows($resultVotes) > 0) {

		$response["status"] = 1;
		
		while ($rowVote = mysqli_fetch_array($resultVotes)) {
			// temp user array
			$userVote = array();
			$productBig["userID"] = $rowVote["KorisnikID"];
			$productBig["username"] = $rowVote["Username"];
			$productBig["avatarURL"] = $rowVote["AvatarURL"];				
	
			// push single product into final response array
			array_push($response["votes"], $productBig);
		}
			
	} else {
		$response["status"] = 0;
	}
		
	// echo response as JSON
	echo json_encode($response);

?>