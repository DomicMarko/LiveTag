<!--################################################################
	Autor: Veljko Marković 2013/0137, tim Elites
	Projekat: LiveTag
	Verzija: 1.0
	
################################################################# 
-->

<?php
		
			session_start();
			
			error_reporting(E_ALL ^ E_DEPRECATED);

			include 'connection.php';
			
			$topik1 = $_POST['top1'];
			$topik2 = $_POST['top2'];
			
			$result = mysql_query("SELECT TopikID FROM topik WHERE Naziv = '$topik1'");
			$result2 = mysql_query("SELECT TopikID FROM topik WHERE Naziv = '$topik2'");
			if(mysql_num_rows($result) == 0 || mysql_num_rows($result2) == 0) {
				 if($_SESSION["userType"]=="mod")
				 header("Location: moderator.php?Messagexyz=" . urlencode('Ne postoji takav topik u bazi.'));
				 else if($_SESSION["userType"]=="admin") header("Location: adminmoderator.php?Messagexyz=" . urlencode('Ne postoji takav topik u bazi.'));
				 exit();
			}
			
			else{
			$prvi = mysql_fetch_array(mysql_query("SELECT * FROM topik WHERE Naziv = '$topik1'"));
			$prvi1 = $prvi['DatumObjave'];
			$drugi = mysql_fetch_array(mysql_query("SELECT * FROM topik WHERE Naziv = '$topik2'"));
			$drugi1 = $drugi['DatumObjave'];
			
			mysql_query("UPDATE topik SET DatumObjave='$drugi1' WHERE Naziv = '$topik1'") or die(mysql_error());
			mysql_query("UPDATE topik SET DatumObjave='$prvi1' WHERE Naziv = '$topik2'") or die(mysql_error());
			
			if($_SESSION["userType"]=="mod")
			header("Location: moderator.php?Messagexy=" . urlencode('Uspesno ste swapovali topike.'));
			else if($_SESSION["userType"]=="admin")  header("Location: adminmoderator.php?Messagexy=" . urlencode('Uspesno ste swapovali topike.'));
			exit();
			}
?>
