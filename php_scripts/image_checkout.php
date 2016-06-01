<?php

	/*	################################################################

	Autor: Marko Domić 2013/0240, tim Elites

	Projekat: LiveTag
	Verzija: 1.0
	
	################################################################# */ 

	require_once('units_definition.php');

	class ImageCheckout {
				
		private $inputFileName;
		private $target_file;
		private $userID;
		private $topic;
		private $message;
		
		public function __construct($ifn, $tf, $user, $topik) {
		
			$this->inputFileName = $ifn;
			$this->target_file = $tf;
			$this->userID = $user;
			$this->topic = $topik;
			$this->message = '';
		}
		
		public function check() {
			
			require_once('db_connect.php');
			
			$status = 1;
			$typeOfImage = pathinfo($this->target_file, PATHINFO_EXTENSION);
	
			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
				
				$check = getimagesize($_FILES[$this->inputFileName]["tmp_name"]);
				
				if($check !== false) {
					
					$this->message = $this->message . "<br/>" . "File is an image - " . $check["mime"] . ".";
					$status = 1;					
				} else {
					
					$this->message = $this->message . "<br/>" . "File is not an image. ";
					$status = 0;					
				}
			}
			
			// Check if file already exists
			if (file_exists($this->target_file)) {
				
				$this->message = $this->message . "<br/>" . "Ovakva slika već postoji u sistemu.";
				$status = 0;
			}
			
			// Check file size
			if ($_FILES[$this->inputFileName]["size"] > 5*MB) {
				
				$this->message = $this->message . "<br/>" . "Vaša slika je prevelika (dozvoljena veličina do 5MB). ";
				$status = 0;				
			}
			
			// Allow certain file formats
			if($typeOfImage != "jpg" && $typeOfImage != "png" && $typeOfImage != "jpeg" && $typeOfImage != "gif" ) {
				
				$this->message = $this->message . "<br/>" . "Dozvoljeni su samo JPG, JPEG, PNG i GIF formati slika. ";
				$status = 0;				
			}
			
			// connecting to db
			$dbb = new DB_CONNECT();
			
			$db = $dbb->getDb();			
			
			$query = "SELECT * FROM slika_post WHERE KorisnikID=" . $this->userID . " AND TopikID=" . $this->topic;
			
			// get all products from products table
			$result = mysqli_query($db, $query) or die(mysql_error());
			
			if(mysqli_num_rows($result) > 0) {
				
				$this->message = $this->message . "<br/>" . "Slika već postoji u bazi";
				$status = 0;
			}
			
			return $status;
		}
		
		public function getMessage() {
			
			return $this->message;
		}

	}
?>