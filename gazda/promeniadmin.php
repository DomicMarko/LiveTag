<?php
			error_reporting(E_ALL ^ E_DEPRECATED);

			include 'connection.php';
	
			
			$name = $_POST['inputStaraAdmin'];
			$name2 = $_POST['inputNovaAdmin'];

			$info = mysql_fetch_array(mysql_query("SELECT * FROM `korisnik` WHERE `username` = 'admin'"));
			$namedb = $info['Password'];
			
			if($name == $namedb && $name != '' && $name2 != '') {
			mysql_query("UPDATE korisnik SET Password='$name2' WHERE username = 'admin'") or die(mysql_error());
			header("Location: adminpanel.php?Message7=" . urlencode('Uspesno ste promenili lozinku administratora.'));
			}
			else if($name == '' || $name2 =='' || ($name == '' && $name2 =='')){
			header("Location: adminpanel.php?Message8=" . urlencode('Niste uneli informacije.'));
			}
			else header("Location: adminpanel.php?Message9=" . urlencode('Pogresili ste staru lozinku, pokusajte ponovo.'));
?>