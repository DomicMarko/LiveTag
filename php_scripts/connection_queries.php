<?php

	/*	################################################################

	Autor: Marko Domić 2013/0240, tim Elites

	Projekat: LiveTag
	Verzija: 1.0
	
	################################################################# */ 



	class ConnectionDb {
	
		private $connLine;
		private $error;
		
		public function __construct($db) {
			
			$this->connLine = $db;
		}
	
		public function queryWithoutRecords($query) {
		
			$rezultat = mysqli_query($this->connLine, $query) or die(mysqli_error());
		}
		
		public function getRecord($query) {
		
			$result = mysqli_query($this->connLine, $query);
			$num_rows = mysqli_num_rows($result);
			
			if ($num_rows == 0) {
				
				$this->error = mysqli_error($this->connLine);
				return 0;
			} else {
			
				$row = mysqli_fetch_row($result); 				
				return $row;
			}
		}
		
		public function getRecordSet($query) {
		
			$records = array();
			$result = mysqli_query($this->connLine, $query);
			$num_rows = mysqli_num_rows($result);
			
			if ($num_rows == 0) {
			
				$this->error = mysqli_error($this->connLine);
				return 0;
			}
			
			while ($row = mysql_fetch_array($result)) $records[] = $row; 
						
			return $records;
		}
		
		public function close() {
		
			if (!$this->connLine) {
				die('Could not connect: ' . mysqli_error());
			}

			mysqli_close($this->connLine);
		}
		
		public function getError() {
			
			return $this->error;
		}
	}


?>