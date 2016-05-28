<?php
	
	/*	################################################################

	Autor: Marko Domić 2013/0240, tim Elites

	Projekat: LiveTag
	Verzija: 1.0
	
	################################################################# */ 



	/**
	 * A class file to connect to database
	 */
	class DB_CONNECT {
	
		private $con;
		private $db;
	
		// constructor
		function __construct() {
			// connecting to database
			$this->db = $this->connect();
		}
	
		// destructor
		function __destruct() {
			// closing db connection
			$this->close();
		}
	
		/**
		 * Function to connect with database
		 */
		function connect() {
			// import database connection variables
			require_once ('../db_config.php');
	
			// Connecting to mysql database
			$this->con = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD) or die(mysqli_error());
	
			// Selecing database
			$dbb = mysqli_select_db($this->con,DB_DATABASE) or die(mysqli_error()) or die(mysqli_error());
	
			$conn = $this->con;
	
			// returing connection cursor
			return $conn;
		}
	
		function getDb() {
			return $this->db;
		}
	
		/**
		 * Function to close db connection
		 */
		function close() {
			// closing db connection
			mysqli_close($this->con);
		}
	
	}

?>