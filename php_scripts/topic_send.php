<?php

	/*	################################################################

	Autor: Marko Domić 2013/0240, tim Elites

	Projekat: LiveTag
	Verzija: 1.0
	
	################################################################# */ 



	require_once('units_definition.php');
	require_once('image_checkout.php');
	require_once('connection_queries.php');
	require_once('db_connect.php');
	
	$topicID = 0;
	
	// connecting to db
	$dbb = new DB_CONNECT();
			
	$db = $dbb->getDb();

	$currentDate = date("Y-m-d");

	$response = array();

	$topicMessage = $_POST['inputTopic'];
	$topicUserID = $_POST['userID'];

	
	// get all products from products table
	$result = mysqli_query($db, "INSERT INTO zahtev (Naziv, KorisnikID) VALUES ('$topicMessage', '$topicUserID')") or die(mysql_error());
				
	if($result) {
				
		$response['message'] = 'Uspešno ste poslali topik!';
		$response['success'] = 1;
	} else {
				
		$response['message'] = 'Sorry, there was an error uploading your file.';	
		$response['success'] = 0;
	}	    
	
	// echoing JSON response
    echo json_encode($response);

?>


