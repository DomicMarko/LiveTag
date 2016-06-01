<?php

	/*	################################################################

	Autor: Marko Domić 2013/0240, tim Elites

	Projekat: LiveTag
	Verzija: 1.0
	
	################################################################# */ 



	require_once('image_checkout.php');
	require_once('connection_queries.php');
	require_once('db_connect.php');
	
	$topicID = 0;
	
	// connecting to db
	$dbb = new DB_CONNECT();
			
	$db = $dbb->getDb();

	// making new query executor
	$executor = new queryExecutor($db);

	$currentDate = date("Y-m-d");

	$response = array();

	$userID = $_POST['userID'];

	$target_dir = "../slike_posts/";
	$target_file = $target_dir . $topicID . '-' . $userID . '-' . basename($_FILES["fileToUpload"]["name"]);					



	// ############################################################################################# 
	//
	//		All queries

	$queryTopic = "SELECT TopikID " .
		"FROM topik " . 
		"WHERE DatumObjave = '" . $currentDate . "'";

	// ############################################################################################# 


	// get current topic
	$resultTopic = $executor->getRecord($queryTopic);
	
	if ($resultTopic != 0) {			

		$topicID = $resultTopic["TopikID"];
			
	}

	// ############################################################################################# 
	//
	//		New queries


	$queryInsertNew = "INSERT INTO slika_post (SlikaURL, KorisnikID, TopikID, BrojGlasova) " . 
		"VALUES ('" . $target_file . "', '" . $userID . "', '" . $topicID . "', 0)";

	// ############################################################################################# 
	
	$checkOut = new ImageCheckout('fileToUpload', $target_file, $userID, $topicID);	
	
	$status = $checkOut->check();
	$message = $checkOut->getMessage();	
	
	
	// Check if $status is set to 0 by an error
	if ($status == 0) {
		
    	$response['message'] = $message;
    	$response['success'] = 0;
		
	} else { // if everything is ok, try to upload file
	
    	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
					
			
			// insert into slika_post table
			$result = $executor->queryWithoutRecords($queryInsertNew);
				
			if($result) {
				
				$response['message'] = 'Uspešno ste objabili sliku!';
				$response['success'] = 1;
			} else {
				
				$response['message'] = 'Izvinjavamo se, došlo je do greške pri objvaljivanju slike.';	
				$response['success'] = 0;
			}

	    } else {
			
    	    $response['message'] = 'Izvinjavamo se, došlo je do greške pri objvaljivanju slike.';
    	    $response['success'] = 0;
    	}
	}
	
	// echoing JSON response
    echo json_encode($response);

?>


