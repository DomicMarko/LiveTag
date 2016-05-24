<?php
	/*
	 * Following code will list all the images and info about them
	 */
	
	// include db connect class
	require_once ('db_connect.php');
	
	// array for JSON response
	$response = array();
	
	// connecting to db
	$dbb = new DB_CONNECT();
	
	$db = $dbb->getDb();
	
	$userLikeID = $_POST['userLike'];
	$imgID = $_POST['imgID'];
	
	$queryNumVotes = "SELECT * " . 
		"FROM glasovi " . 
		"WHERE KorisnikID = " . $userLikeID . " " .
		"AND SlikaID = " . $imgID;
		
	// get current topic
	$resultVotes = mysqli_query($db, $queryNumVotes) or die(mysqli_error());	
	
	if (mysqli_num_rows($resultVotes) > 0) {
		
		$queryInsertDelete = "DELETE FROM glasovi " . 
			"WHERE KorisnikID = " . $userLikeID . " " .
			"AND SlikaID = " . $imgID;
		
		$queryDecrementVote = "UPDATE slika_post " . 
			"SET BrojGlasova = BrojGlasova - 1 " . 
			"WHERE SlikaID = " . $imgID;
			
		$queryVotes = "SELECT BrojGlasova " . 
			"FROM slika_post " . 
			"WHERE SlikaID = " . $imgID;
			
		$resultDelete = mysqli_query($db, $queryInsertDelete) or die(mysqli_error());		
		$resultVotesUpdate = mysqli_query($db, $queryDecrementVote) or die(mysqli_error());
		
		$resultVotesNumber = mysqli_query($db, $queryVotes) or die(mysqli_error());
		
		if(mysqli_num_rows($resultVotesNumber) > 0) {
			
			$rowPost = mysqli_fetch_array($resultVotesNumber);
			$numberOfVotes = $rowPost[0];
			
			$response["votes"] = $numberOfVotes;
			$response["voted"] = false;
		}
								
	} else {
		
		$queryInsertDelete = "INSERT INTO glasovi " . 
			"VALUES (" . $userLikeID . ", " . $imgID . ")";
		
		$queryDecrementVote = "UPDATE slika_post " . 
			"SET BrojGlasova = BrojGlasova + 1 " . 
			"WHERE SlikaID = " . $imgID;
			
		$queryVotes = "SELECT BrojGlasova " . 
			"FROM slika_post " . 
			"WHERE SlikaID = " . $imgID;
			
		$resultInsert = mysqli_query($db, $queryInsertDelete) or die(mysqli_error());		
		$resultVotesUpdate = mysqli_query($db, $queryDecrementVote) or die(mysqli_error());
		
		$resultVotesNumber = mysqli_query($db, $queryVotes) or die(mysqli_error());
		
		if(mysqli_num_rows($resultVotesNumber) > 0) {
			
			$rowPost = mysqli_fetch_array($resultVotesNumber);
			$numberOfVotes = $rowPost[0];
			
			$response["votes"] = $numberOfVotes;
			$response["voted"] = true;
		}
	}
			
	// echo response as JSON
	echo json_encode($response);
	
?>
