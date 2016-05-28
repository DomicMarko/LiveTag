<?php

	/*	################################################################

	Autor: Marko Domić 2013/0240, tim Elites

	Projekat: LiveTag
	Verzija: 1.0
	
	################################################################# */ 



	/*
	 * Following code will delete a product from table
	 * A product is identified by product id (pid)
	 */
	
	// include db connect class
	require_once ('db_connect.php');
	
	// array for JSON response
	$response = array();
	
	// check for required fields
	if (isset($_POST['userDeleteID']) && isset($_POST['imageDeleteID']) && isset($_POST['url'])) {
		
		$userDeleteID = $_POST['userDeleteID'];
		$imageDeleteID = $_POST['imageDeleteID'];	
		$imageURL = $_POST['url'];						
	
		// connecting to db
		$dbb = new DB_CONNECT();
	
		$db = $dbb->getDb();
	
		// query for deleting votes for current image
		$queryVotes = "DELETE FROM glasovi " .
			"WHERE SlikaID = " . $imageDeleteID;
	
	
		// query for delete image from database
		$querySlika = "DELETE FROM slika_post " .
			"WHERE SlikaID = " . $imageDeleteID;
			
			
		// execute $queryVotes
		$resultFromGlasovi = mysqli_query($db, $queryVotes) or die(mysqli_error());				
		
		// execute $querySlika
		$resultFromSlika = mysqli_query($db, $querySlika) or die(mysqli_error());
		
		// check if row deleted or not
		if (mysqli_affected_rows($db) > 0) {
			// successfully updated
			$response["success"] = 1;
			$response["message"] = "Uspešno ste obrisali sliku!";
	
			// delete image from server
			unlink($imageURL);
			
			// echoing JSON response
			echo json_encode($response);
		} else {
			// no product found
			$response["success"] = 0;
			$response["message"] = "Ne postoji odabrana slika!";
	
			// echo no users JSON
			echo json_encode($response);
		}
	} else {
		// required field is missing
		$response["success"] = 0;
		$response["message"] = "Došlo je do greške pri prenošenju parametara";
	
		// echoing JSON response
		echo json_encode($response);
	}

?>