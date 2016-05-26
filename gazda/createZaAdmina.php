<?php
			error_reporting(E_ALL ^ E_DEPRECATED);

			include 'connection.php';
	
			
			$name = $_POST['inputName'];
			
			$result = mysql_query("SELECT TopikID FROM topik WHERE Naziv = '$name'");
			if(mysql_num_rows($result) != 0) {
				 header("Location: moderator.php?Messagex=" . urlencode('Taj topik vec postoji, probajte sa drugim.'));
				 exit();
			}
			
			if(trim($name) == ''){
				header("Location: adminmoderator.php?Message1=" . urlencode('Niste uneli naziv topika, pokusajte ponovo.'));
			}
			else{
				$maxd = mysql_fetch_array(mysql_query("SELECT MAX(DatumObjave) FROM `topik` "));
				$maxdate = $maxd[0];
				$date = strtotime("+1 day", strtotime("$maxdate"));
				$konacan = date("Y-m-d", $date);
			
				mysql_query("INSERT INTO topik (`TopikID`, `Naziv`, `DatumObjave`) 
							VALUES(NULL, '$name', '$konacan')") or die(mysql_error());
				header("Location: adminmoderator.php?Message1=" . urlencode('Uspesno ste uneli topik.'));
			}
?>
