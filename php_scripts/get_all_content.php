<?php

	session_start();

	/*
	 * Following code will list all the images and info about them
	 */
	
	// include db connect class
	require_once ('db_connect.php');
	
	// include Pronounce class
	require_once ('pronounce_winners.php');
	
	$topikID = 0;
	$topicsUserID = 0;
	$topicPublished = -1;
	
	// array for JSON response
	$response = array();
	
	// get loged in user id
	$logedInUserID = '14';//$_POST['logedInUserID'];

	// get loged in user type
	$logedInUserType = 'elite';//$_POST['logedInUserType'];
	
	// connecting to db
	$dbb = new DB_CONNECT();
	
	$db = $dbb->getDb();
	
	$currentDate = date("Y-m-d");	
	$dayBeforeTemp = strtotime("-1 day", strtotime($currentDate));
	$dayBefore = date("Y-m-d", $dayBeforeTemp);
	
	//check if user can send topic
	if($logedInUserType == 'elite') {

		$querySendTopic = "SELECT * " .
			"FROM topik " . 
			"WHERE KorisnikID = " . $logedInUserID . " " .
			"AND Objavljen < 2";

		$queryRequests = "SELECT * " . 
			"FROM zahtev " . 
			"WHERE KorisnikID = " . $logedInUserID;

		// get num of topics for loggedin user
		$resultNumTopics = mysqli_query($db, $querySendTopic) or die(mysqli_error());	

		// get num of requested topics for loggedin user
		$resultRequests = mysqli_query($db, $queryRequests) or die(mysqli_error());	
	
		if ((mysqli_num_rows($resultNumTopics) > 0) || (mysqli_num_rows($resultRequests) > 0)) {
			$response["sendTopic"] = false;			
		} else {
			$response["sendTopic"] = true;
		}
	} else {
		$response["sendTopic"] = false;
	}

	$queryTopic = "SELECT Naziv, TopikID, KorisnikID, Objavljen " .
		"FROM topik " . 
		"WHERE DatumObjave = '" . $currentDate . "'";					
	
	// get current topic
	$resultTopic = mysqli_query($db, $queryTopic) or die(mysqli_error());
	
	$numTopics = mysqli_num_rows($resultTopic);
	
	if ($numTopics > 0) {
		
		$rowTopic = mysqli_fetch_array($resultTopic);
		$topicName = $rowTopic["Naziv"];
		$topikID = $rowTopic["TopikID"];
		$topicsUserID = $rowTopic["KorisnikID"];
		$topicPublished = $rowTopic["Objavljen"];

		$response["topicName"] = $topicName;
		
		
		if($topicPublished == 0) {
			
			$pronounce = new Pronounce($currentDate, $dayBefore, $db);
			$pronounce->updateService();
		}
			
			
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
			"ORDER BY s.BrojGlasova DESC";
	
	
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
			"ORDER BY s.BrojGlasova DESC";
			
					
		$queryUploadImg = "SELECT * " . 
			"FROM slika_post " . 
			"WHERE KorisnikID = " . $logedInUserID . " " . 
			"AND TopikID = " . $topikID;
		
		
		// get all big images from slika_post
		$resultBig = mysqli_query($db, $queryBig) or die(mysqli_error());	
		
		// get all small images from slika_post
		$resultSmall = mysqli_query($db, $querySmall) or die(mysqli_error());
		
		// get number of uploaded images from current user
		$resultUpload = mysqli_query($db, $queryUploadImg) or die(mysqli_error());
		
		if ((mysqli_num_rows($resultUpload) > 0) || ($topicsUserID == $logedInUserID)) {
			
			$response["uploadImg"] = false;
		} else {
			
			$response["uploadImg"] = true;
		}
		
		// looping through all results
		// products node
		$response["big"] = array();
		$response["small"] = array();			
		
		// number of big and small images from result
		$numBig = mysqli_num_rows($resultBig);
		$numSmall = mysqli_num_rows($resultSmall);	
		
		$response["countBig"] = $numBig;
		$response["countSmall"] = $numSmall;
		
		
		
		// check for empty result in big images
		if ($numBig > 0) {		
					
			while ($rowBig = mysqli_fetch_array($resultBig)) {
				// temp user array
				$productBig = array();
				$productBig["slikaID"] = $rowBig["SlikaID"];
				$productBig["url"] = $rowBig["SlikaURL"];
				$productBig["glasovi"] = $rowBig["BrojGlasova"];
				$productBig["userID"] = $rowBig["KorisnikID"];
				$productBig["username"] = $rowBig["Username"];
				$productBig["izglasano"] = $rowBig["Izglasano"];					
		
				// push single product into final response array
				array_push($response["big"], $productBig);
			}
		}
		
		// check for empty result in small images
		if ($numSmall > 0) {		
					
			while ($rowSmall = mysqli_fetch_array($resultSmall)) {
				// temp user array
				$productSmall = array();
				$productSmall["slikaID"] = $rowSmall["SlikaID"];
				$productSmall["url"] = $rowSmall["SlikaURL"];
				$productSmall["glasovi"] = $rowSmall["BrojGlasova"];
				$productSmall["userID"] = $rowSmall["KorisnikID"];
				$productSmall["username"] = $rowSmall["Username"];
				$productSmall["izglasano"] = $rowSmall["Izglasano"];					
		
				// push single product into final response array
				array_push($response["small"], $productSmall);
			}
		}
	}
	
	
	
	
	
	// echo response as JSON
	echo json_encode($response);

?>