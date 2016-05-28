<?php

	/*	################################################################

	Autor: Marko Domić 2013/0240, tim Elites

	Projekat: LiveTag
	Verzija: 1.0
	
	################################################################# */ 

	
	/*
	 * Following code will list all the images and info about them
	 */


	session_start();	 
	
	// include db connect class
	require_once ('db_connect.php');
	
	// include Pronounce class
	require_once ('pronounce_winners.php');
	
	// include queryExecutor class
	require_once ('connection_queries.php');
	
	$topikID = 0;
	$topicsUserID = 0;
	$topicPublished = -1;
	
	// array for JSON response
	$response = array();
	
	// error response
	$response["errorFlag"] = 0;
	$response["errorMessage"] = "";
	
	// get loged in user id
	$logedInUserID = $_POST['logedInUserID'];

	// get loged in user type
	$logedInUserType = $_POST['logedInUserType'];
	
	// connecting to db
	$dbb = new DB_CONNECT();
	
	$db = $dbb->getDb();
	
	// making new query executor
	$executor = new queryExecutor($db);
	
	// making reserve query executor
	$executorHelp = new queryExecutor($db);
	
	// curent date and date before for fetching topic
	$currentDate = date("Y-m-d");	
	$dayBeforeTemp = strtotime("-1 day", strtotime($currentDate));
	$dayBefore = date("Y-m-d", $dayBeforeTemp);
	
	
	
	// ############################################################################################# 
	//
	//		All queries
	
	$queryMessage = "SELECT StiglaPoruka, PorukaZaElite " . 
		"FROM korisnik " . 
		"WHERE KorisnikID = " . $logedInUserID;
		
	$querySendTopic = "SELECT * " .
		"FROM topik " . 
		"WHERE KorisnikID = " . $logedInUserID . " " .
		"AND Objavljen < 2";

	$queryRequests = "SELECT * " . 
		"FROM zahtev " . 
		"WHERE KorisnikID = " . $logedInUserID;
		
	$queryTopic = "SELECT Naziv, TopikID, KorisnikID, Objavljen " .
		"FROM topik " . 
		"WHERE DatumObjave = '" . $currentDate . "'";		
		
	// ############################################################################################# 
		
	$resultMessage = $executor->getRecord($queryMessage);

	$isMessage = 0;
	$message = "";

	if($resultMessage != 0) {
	
		// get new message for user	
		$isMessage = $resultMessage["StiglaPoruka"];
		$message = $resultMessage["PorukaZaElite"];
	} else {
		
		// error getting new message
		$response["errorFlag"] = 1;
		$response["errorMessage"] .= $executor->getError() . "<br/><br/>";
	}

	// check if there is a message for user
	if($isMessage > 0) {

		$response["isMessage"] = true;
		$response["message"] = $message;
	} else {

		$response["isMessage"] = false;
		$response["message"] = null;
	}
	
	//check if user can send topic
	if($logedInUserType == 'elite') {		

		// get num of topics for loggedin user
		$resultNumTopics = $executor->getRecordSet($querySendTopic);	

		// get num of requested topics for loggedin user
		$resultRequests = $executorHelp->getRecordSet($queryRequests);	
	
		if (($resultNumTopics != 0) || ($resultRequests != 0)) {
			$response["sendTopic"] = false;			
		} else {
			$response["sendTopic"] = true;
		}
	} else {
		$response["sendTopic"] = false;
	}					
	
	// get current topic
	$resultTopic = $executor->getRecord($queryTopic);
	
	if ($resultTopic != 0) {
		
		$topicName = $resultTopic["Naziv"];
		$topikID = $resultTopic["TopikID"];
		$topicsUserID = $resultTopic["KorisnikID"];
		$topicPublished = $resultTopic["Objavljen"];

		$response["topicName"] = $topicName;
		
		
		if($topicPublished == 0) {
			
			$pronounce = new Pronounce($currentDate, $dayBefore, $db);
			$pronounce->updateService();
		}
			
		
		// ############################################################################################# 
		//
		//		New queries
			
		$queryBig = "SELECT s.SlikaID, s.SlikaURL, s.BrojGlasova, k.KorisnikID, k.Username, " .
			"(" .
			"SELECT COUNT(*) " .
			"FROM glasovi " . 
			"WHERE SlikaID = s.SlikaID " . 
			"AND KorisnikID = " . $logedInUserID . " " .
			") AS Izglasano " . 
			"FROM slika_post s, korisnik k " .
			"WHERE s.KorisnikID = k.KorisnikID " .
			"AND s.TopikID = " . $topikID . " " .
			"AND k.TipKorisnika IN ('elite', 'premium') " .
			"ORDER BY s.BrojGlasova DESC, k.BrojPoena DESC";
	
	
		$querySmall = "SELECT s.SlikaID, s.SlikaURL, s.BrojGlasova, k.KorisnikID, k.Username, " .
			"(" .
			"SELECT COUNT(*) " .
			"FROM glasovi " . 
			"WHERE SlikaID = s.SlikaID " . 
			"AND KorisnikID = " . $logedInUserID . " " .
			") AS Izglasano " . 
			"FROM slika_post s, korisnik k " .
			"WHERE s.KorisnikID = k.KorisnikID " .
			"AND s.TopikID = " . $topikID . " " .
			"AND k.TipKorisnika IN ('basic') " .
			"ORDER BY s.BrojGlasova DESC, k.BrojPoena DESC";
			
					
		$queryUploadImg = "SELECT * " . 
			"FROM slika_post " . 
			"WHERE KorisnikID = " . $logedInUserID . " " . 
			"AND TopikID = " . $topikID;
			
		// ############################################################################################# 				

		
		// get number of uploaded images from current user
		$resultUpload = $executor->getRecordSet($queryUploadImg);
		
		if (($resultUpload != 0) || ($topicsUserID == $logedInUserID)) {
			
			$response["uploadImg"] = false;
		} else {
			
			$response["uploadImg"] = true;
		}
		
		// looping through all results
		$response["big"] = array();
		$response["small"] = array();
		
		// get all big images from slika_post
		$resultBig = $executor->getRecordSet($queryBig);					
		
		// check for empty result in big images
		if ($resultBig != 0) {		
		
			// how many big images
			$response["countBig"] = count($resultBig);
					
			for ($i = 0; $i < count($resultBig); $i++) {
				
				// temp user array
				$productBig = array();
				$productBig["slikaID"] = $resultBig[$i]["SlikaID"];
				$productBig["url"] = $resultBig[$i]["SlikaURL"];
				$productBig["glasovi"] = $resultBig[$i]["BrojGlasova"];
				$productBig["userID"] = $resultBig[$i]["KorisnikID"];
				$productBig["username"] = $resultBig[$i]["Username"];
				$productBig["izglasano"] = $resultBig[$i]["Izglasano"];					
		
				// push single product into final response array
				array_push($response["big"], $productBig);
			}					
			
		} else {
			$response["countBig"] = 0;
		}
		
		// get all small images from slika_post
		$resultSmall = $executor->getRecordSet($querySmall);					
		
		// check for empty result in small images
		if ($resultSmall != 0) {		
		
			// how many small images
			$response["countSmall"] = count($resultSmall);
					
			for ($i = 0; $i < count($resultSmall); $i++) {
				
				// temp user array
				$productSmall = array();
				$productSmall["slikaID"] = $resultSmall[$i]["SlikaID"];
				$productSmall["url"] = $resultSmall[$i]["SlikaURL"];
				$productSmall["glasovi"] = $resultSmall[$i]["BrojGlasova"];
				$productSmall["userID"] = $resultSmall[$i]["KorisnikID"];
				$productSmall["username"] = $resultSmall[$i]["Username"];
				$productSmall["izglasano"] = $resultSmall[$i]["Izglasano"];					
		
				// push single product into final response array
				array_push($response["small"], $productSmall);
			}					
			
		} else {
			$response["countSmall"] = 0;
		}							
	} else {
		$response["topicName"] = "Trenutno nema topika za današnji dan. Molimo vas, pokušajte kasnije, hvala.";
	}				
	
	// echo response as JSON
	echo json_encode($response);

?>