<?php
			error_reporting(E_ALL ^ E_DEPRECATED);

			include 'connection.php';
	
			
			$name = $_POST['inputName'];
			
			if(trim($name) == ''){
				header("Location: moderator.php?Message1=" . urlencode('Niste uneli naziv topika, pokusajte ponovo.'));
			}
			else{
				mysql_query("INSERT INTO topik (`TopikID`, `Naziv`, `DatumObjave`) 
							VALUES(NULL, '$name', CURDATE())") or die(mysql_error());
				header("Location: moderator.php?Message1=" . urlencode('Uspesno ste uneli topik.'));
			}
?>
