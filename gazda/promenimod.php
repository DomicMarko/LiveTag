<?php
			error_reporting(E_ALL ^ E_DEPRECATED);

			include 'connection.php';
	
			
			$name = $_POST['inputStaraMod'];
			$name2 = $_POST['inputNovaMod'];

			$info = mysql_fetch_array(mysql_query("SELECT * FROM `korisnik` WHERE `username` = 'mod'"));
			$namedb = $info['Password'];
			
			if(password_verify($name,$namedb) && $name != '' && $name2 != '') {
 				$hash=password_hash($name2,PASSWORD_DEFAULT);
 
 			mysql_query("UPDATE korisnik SET Password='$hash' WHERE username = 'admin'") or die(mysql_error());
			header("Location: adminpanel.php?Message4=" . urlencode('Uspesno ste promenili lozinku moderatora.'));
			}
			else if($name == '' || $name2 =='' || ($name == '' && $name2 =='')){
			header("Location: adminpanel.php?Message5=" . urlencode('Niste uneli informacije.'));
			}
			else header("Location: adminpanel.php?Message6=" . urlencode('Pogresili ste staru lozinku, pokusajte ponovo.'));
?>