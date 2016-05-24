<?php

	require_once('units_definition.php');
	require_once('image_checkout.php');
	require_once('connection_queries.php');
	require_once('db_connect.php');
	
	$topicID = 0;
	
	// connecting to db
	$dbb = new DB_CONNECT();
			
	$db = $dbb->getDb();

	$currentDate = date("Y-m-d");

	$queryTopic = "SELECT TopikID " .
		"FROM topik " . 
		"WHERE DatumObjave = '" . $currentDate . "'";					
	
	// get current topic
	$resultTopic = mysqli_query($db, $queryTopic) or die(mysqli_error());
	
	if (mysqli_num_rows($resultTopic) > 0) {
		
		$rowTopic = mysqli_fetch_array($resultTopic);				

		$topicID = $rowTopic["TopikID"];
			
	}

	$response = array();

	$userID = $_POST['userID'];

	$target_dir = "../slike_posts/";
	$target_file = $target_dir . $topicID . '-' . $userID . '-' . basename($_FILES["fileToUpload"]["name"]);
	
	$checkOut = new ImageCheckout('fileToUpload', $target_file, $userID, $topicID);	
	
	$status = $checkOut->check();
	$message = $checkOut->getMessage();	
	
	
	// Check if $status is set to 0 by an error
	if ($status == 0) {
		
    	$response['message'] = $message;
    	$response['success'] = 0;
		
	} else { // if everything is ok, try to upload file
	
    	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			
			// connecting to db
			$dbb = new DB_CONNECT();
			
			$db = $dbb->getDb();			
			
			// get all products from products table
			$result = mysqli_query($db, "INSERT INTO slika_post (SlikaURL, KorisnikID, TopikID, BrojGlasova) VALUES ('$target_file', '$userID', 1, 0)") or die(mysql_error());
				
			if($result) {
				
				$response['message'] = 'Uspešno ste objabili sliku!';
				$response['success'] = 1;
			} else {
				
				$response['message'] = 'Sorry, there was an error uploading your file.';	
				$response['success'] = 0;
			}

	    } else {
			
    	    $response['message'] = 'Sorry, there was an error uploading your file.';
    	    $response['success'] = 0;
    	}
	}
	
	// echoing JSON response
    echo json_encode($response);

?>


