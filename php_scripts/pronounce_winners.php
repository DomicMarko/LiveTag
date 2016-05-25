<?php

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
		
		public function updateTopics() {
			
			$top5Users = $this->getTop5MostLikedUsers();
			
			if($top5Users != 0) {
				
				$queryDayBefore = "UPDATE topik " . 
				"SET PrvoMesto = " . $top5Users[0] . ", DrugoMesto = " . $top5Users[1] . ", TreceMesto = " . $top5Users[2] . ", CetvrtoMesto = " . $top5Users[3] . ", PetoMesto = " . $top5Users[4] . " " .                                   
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
			
			return $top5Users;				
		}				
		
	}


?>