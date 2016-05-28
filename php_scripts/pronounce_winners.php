<?php

	/*	################################################################

	Autor: Marko Domić 2013/0240, tim Elites

	Projekat: LiveTag
	Verzija: 1.0
	
	################################################################# */ 



	class Pronounce {
	
		private $today;
		private $dayBefore;
		private $db;
		
		public function __construct($today, $dayBefore, $db) {
			
			$this->today = $today;
			$this->dayBefore = $dayBefore;
			$this->db = $db;
		}
	
		private function getTop5MostLikedUsers() {
		
			$queryTop5 = "SELECT s.SlikaID " . 
				"FROM slika_post s, korisnik k " . 
				"WHERE s.TopikID = " .
				"(SELECT TopikID " .
				"FROM topik " . 
				"WHERE DatumObjave = '" . $this->dayBefore . "') " . 
				"AND s.KorisnikID = k.KorisnikID " . 
				"ORDER BY s.BrojGlasova DESC , k.BrojPoena DESC " . 
				"LIMIT 5";
	
			// get top 5 most liked users
			$resultTop5 = mysqli_query($this->db, $queryTop5) or die(mysqli_error());	
	
			$response = array();
			
			if (mysqli_num_rows($resultTop5) > 0) {
				
				$i = 0;				
				
				while ($row = mysqli_fetch_array($resultTop5)) {					
					$response[$i++] = $row["SlikaID"];					
				}				
						
			} else {
				return 0;
			}
			
			return $response;
		}
		
		private function updateTopics($top5Users) {						

			if($top5Users != 0) {

				$setToUpdate = "";

				for($i = 0; $i < count($top5Users); $i++) {

					switch ($i) {
					    case 0:
					    	$setToUpdate = $setToUpdate . "PrvoMesto = " . $top5Users[0];
					        //$first = $top5Users[0];
					        break;
					    case 1:
					    	$setToUpdate = $setToUpdate . ", DrugoMesto = " . $top5Users[1];
					        //$second = $top5Users[1];
					        break;
					    case 2:
					    	$setToUpdate = $setToUpdate . ", TreceMesto = " . $top5Users[2];
					        //$third = $top5Users[2];
					        break;
					    case 3:
					    	$setToUpdate = $setToUpdate . ", CetvrtoMesto = " . $top5Users[3];
					        //$fourth = $top5Users[3];
					        break;
					    case 4:
					    	$setToUpdate = $setToUpdate . ", PetoMesto = " . $top5Users[4];
					        //$fifth = $top5Users[4];
					        break;
					} 
				}

				$queryDayBefore = "UPDATE topik " . 
				"SET " . $setToUpdate . " " .                                   
				"WHERE DatumObjave = '" . $this->dayBefore . "'";
				
				// update topic of the day before
				$resultUpdatedTopicDayBefore = mysqli_query($this->db, $queryDayBefore) or die(mysqli_error("Došlo je do greške pri update-ovanju topika prethodnog dana."));
			}
			
			$queryDayBeforeStatus = "UPDATE topik " . 
				"SET Objavljen = 2 " .                                   
				"WHERE DatumObjave = '" . $this->dayBefore . "'";
				
			// update topic of the day before
			$resultUpdatedTopicDayBeforeStatus = mysqli_query($this->db, $queryDayBeforeStatus) or die(mysqli_error("Došlo je do greške pri update-ovanju topika prethodnog dana."));												
			
			
			$queryToday = "UPDATE topik " . 
				"SET Objavljen = 1 " . 
				"WHERE DatumObjave = '" . $this->today . "'";
				
			// update today's topic
			$resultUpdatedTopicToday = mysqli_query($this->db, $queryToday) or die(mysqli_error("Došlo je do greške pri update-ovanju današnjeg topika."));	
							
		}
		
		private function updateUsersAfterUpdateTopic($top5Users) {
			
			if($top5Users != 0) {
				
				
				$imgIDs = "(";

				for($i = 0; $i < count($top5Users); $i++) {
					
					if($i == 0) $imgIDs = $imgIDs . $top5Users[$i];
					else $imgIDs = $imgIDs . ", " . $top5Users[$i];
				}
				
				$imgIDs = $imgIDs . ")";				
				
				
				$queryTop5Users = "SELECT s.KorisnikID, k.BrojPoena, k.StiglaPoruka, k.PorukaZaElite " .
					"FROM slika_post s, korisnik k " . 
					"WHERE s.SlikaID IN " . $imgIDs . " " .
					"AND s.KorisnikID = k.KorisnikID " . 
					"ORDER BY s.BrojGlasova DESC";			
				
				// get top 5 list users
				$resultTop5 = mysqli_query($this->db, $queryTop5Users) or die(mysqli_error());				
				
				$response = array();
				
				if (mysqli_num_rows($resultTop5) > 0) {
					
					while ($row = mysqli_fetch_array($resultTop5)) {
						
						// temp array
						$res = array();
						$res["userID"] = $row["KorisnikID"];
						$res["points"] = $row["BrojPoena"];
						$res["isMessage"] = $row["StiglaPoruka"];
						$res["message"] = $row["PorukaZaElite"];					
				
						// push single row into final response array
						array_push($response, $res);
					}
				}
				
				$points = 20;
				
				for($i = 0; $i < count($response); $i++) {
					
					$response[$i]["points"] += $points;
					$points -= 2;
					
					$userType = "";
					
					if(($response[$i]["points"] >= 0) && ($response[$i]["points"] < 100)) $userType = "basic";
					if(($response[$i]["points"] >= 100) && ($response[$i]["points"] < 200)) $userType = "premium";
					if($response[$i]["points"] >= 200) $userType = "elite";
					
					$sendMessage = "Čestitamo! Osvojili ste " . ($i + 1) . ". mesto sa vašom slikom prethodnog dana. " . 
						"Osvojili ste " . ($points + 2) . " poena, vaš ukupni broj ostvarenih poena je " . $response[$i]["points"] . 
						", vaš trenutni status je \"" . $userType . "\"."; 
					
					if($response[$i]["isMessage"] > 0) {
						
						$response[$i]["message"] = $response[$i]["message"] . "<br/><br/>" . $sendMessage;
					} else {
						
						$response[$i]["message"] = $sendMessage;
					}
					
					$queryUpdateUser = "UPDATE korisnik " . 
						"SET BrojPoena = " . $response[$i]["points"] . ", TipKorisnika = '" . $userType . "', StiglaPoruka = 1, PorukaZaElite = '" . $response[$i]["message"] . "' " . 
						"WHERE KorisnikID = " . $response[$i]["userID"];	
						
					//echo $queryUpdateUser;																					
						
					$resultUpdateUser = mysqli_query($this->db, $queryUpdateUser) or die(mysqli_error());					
					
				}
			}			
		}
		
		private function takePoints() {
			
			$currentDate = date("Y-m-d");	
			$weekAgoTemp = strtotime("-7 day", strtotime($currentDate));
			$weekAgo = date("Y-m-d", $weekAgoTemp);
			
			$queryLazyUsers = "SELECT KorisnikID, BrojPoena " . 
				"FROM korisnik " . 
				"WHERE ZadnjaObjava < '" . $weekAgo . "'";

			$resultLazyUsers = mysqli_query($this->db, $queryLazyUsers) or die(mysqli_error());
			
			$response = array();
			
			if (mysqli_num_rows($resultLazyUsers) > 0) {
					
				while ($row = mysqli_fetch_array($resultLazyUsers)) {
						
					// temp array
					$res = array();
					$res["userID"] = $row["KorisnikID"];
					$res["points"] = $row["BrojPoena"];					
				
					// push single row into final response array
					array_push($response, $res);
				}
			}
			
			for($i = 0; $i < count($response); $i++) {
				
				$response[$i]["points"] -= 2;
				
				$userType = "";
					
				if(($response[$i]["points"] >= 0) && ($response[$i]["points"] < 100)) $userType = "basic";
				if(($response[$i]["points"] >= 100) && ($response[$i]["points"] < 200)) $userType = "premium";
				if($response[$i]["points"] >= 200) $userType = "elite";
				
				$queryUpdateUser = "UPDATE korisnik " . 
					"SET BrojPoena = " . $response[$i]["points"] . ", TipKorisnika = '" . $userType . "' " .
					"WHERE KorisnikID = " . $response[$i]["userID"];																
						
				$resultUpdateUser = mysqli_query($this->db, $queryUpdateUser) or die(mysqli_error());
				
			}
			
		}
		
		public function updateService() {
			
			$top5 = $this->getTop5MostLikedUsers();
			$this->updateTopics($top5);
			$this->updateUsersAfterUpdateTopic($top5);
			$this->takePoints();
		}
		
	}


?>