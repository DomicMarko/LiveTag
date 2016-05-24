<?php

class Konekcija {
	private $conn;
	private $error;
	
	public function __construct($host, $db, $user, $pass) {
		$this->conn = mysqli_connect($host, $user, $pass)
		or die("Ne mozete da se konektujete");
		$sel = mysqli_select_db($this->conn, $db);
	}
	
	public function doQuery($query) {
		$rezultat = mysqli_query($this->conn, $query) or die(mysqli_error());
		echo "<br />Rezultat je: $rezultat<br />";
		// ispis upita zbog provere njegove ispravnosti
	}
	
	public function getRecord($query) {
		$result = mysqli_query($this->conn, $query);
		if ($result != false) {
			$num_rows = mysqli_num_rows($result);
			if ($num_rows == 0) {
				$this->error = mysqli_error($this->conn);
				return 0;
			} else {
				$row = mysqli_fetch_row($result);
				// sada se rezultat stavlja u numericki niz
				/*foreach ($row as $value) {
					echo $value . ' ';
					echo '<br />';
				}*/
				return $row;
			}
		}
		return false;
	}
	
	public function getRecordSet($query) {
		$niz = array();
		$result = mysqli_query($this->conn, $query);
		if ($result == false) return false;
		else {
			$num_rows = mysqli_num_rows($result);
			if ($num_rows == 0) {
				$this->error = mysqli_error($this->conn);
				return 0;
			}
			while ($row = mysqli_fetch_assoc($result)) {
				$niz[] = $row;
				/*foreach ($row as $value) {
					echo $value . ' ';
					echo '<br />';
				}*/
			}
			return $niz;
		}
	}
}

?>