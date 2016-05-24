<?php
			error_reporting(E_ALL ^ E_DEPRECATED);

			include 'connection.php';
	
			
			$name = $_POST['inputName'];
			
			$info = mysql_fetch_array(mysql_query("SELECT * FROM `korisnik` WHERE `username` = '$name'"));
			$provera = $info['Username'];
			
			if($provera == $name && $name != ''){
				mysql_query("DELETE FROM korisnik WHERE Username='$name' ") or die(mysql_error());			
				header("Location: adminpanel.php?Message1=" . urlencode('Uspesno ste obrisali korisnika.'));	
			}
			else if($name == '') header("Location: adminpanel.php?Message2=" . urlencode('Niste uneli username korisnika.'));
			else header("Location: adminpanel.php?Message3=" . urlencode('Ne postoji korisnik sa tim username-om.'));
			
?>