<?php			
			error_reporting(E_ALL ^ E_DEPRECATED);

			include 'connection.php';
	
			$name = $_POST['inputUser'];
			$poruka = $_POST['inputPoruka'];
			$br = 1;
			
			$info = mysql_fetch_array(mysql_query("SELECT * FROM `korisnik` WHERE `username` = '$name'"));
			$provera = $info['Username'];
			
			if($provera == $name && $name != '' && $poruka != ''){
				mysql_query("UPDATE korisnik SET PorukaZaElite='$poruka' WHERE username = '$name'") or die(mysql_error());
				mysql_query("UPDATE korisnik SET StiglaPoruka='$br' WHERE username = '$name'") or die(mysql_error());
				header("Location: moderator.php?Message=" . urlencode('Uspesno ste poslali poruku korisniku.'));	
			}
			else if($name == '' || $poruka == '') header("Location: moderator.php?Message2=" . urlencode('Niste popunili formu.'));
			else{
				header("Location: moderator.php?Message3=" . urlencode('Nije pronadjen korisnik sa unetim username-om.'));
			}			
?>