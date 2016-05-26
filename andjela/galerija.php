<link rel="stylesheet" type="text/css" href="galerijacss.css">
<?php
	
	session_start();
	if($_SESSION['userName']){
		$korisnik = $_SESSION['userName'];
	}
	else {
		header("Location:profil.php");
		exit;
	}
	
	if (array_key_exists('lajk',$_POST) || array_key_exists('unlike',$_POST)) {
		$userID = $_POST['userID'];
	}
	else
		$userID = $_GET['userID'];
	
	require_once 'Konekcija.php';
	require_once 'config.php';
	$konekcija = new Konekcija(DB_HOST, DB_NAME, DB_USER, DB_PASS);
	
	function pravopis($broj) {
		if ($broj >= 11 and $broj <= 14)
			return " lajkova</div></div>";
		else {
			if ($broj % 10 == 1)
				return " lajk";
			if ($broj % 10 >= 2 and $broj % 10 <= 4)
				return " lajka";
			if ($broj % 10 >= 5 or $broj % 10 == 0)
				return " lajkova";
		}
	}
	
	function danasnja($datumSlike) {
		$danas = date("Y-m-d");
		return $datumSlike == $danas;
	}
	
	// za dohvatanje id-a ulogovanog usera
	$query = "SELECT KorisnikID FROM korisnik WHERE Username='" . $korisnik . "'";
	$user = $konekcija->getRecord($query);
	$korisnikID = $user[0];
	// za dohvatanje korisnika na cijem smo profilu
	$query = "SELECT * FROM korisnik WHERE KorisnikID='" . $userID . "'";
	$userdata = $konekcija->getRecord($query);
	
	// slike korisnika na cijem smo profilu
	$query = "SELECT * FROM slika_post WHERE KorisnikID=$userdata[0]";
	$pictures = $konekcija->getRecordSet($query);
	
	// za proveru za lajkovanje danasnje slike
	$queryDatum = "SELECT DatumObjave FROM topik WHERE TopikID=" . $pictures[0]['TopikID'];
	$datum = $konekcija->getRecord($queryDatum);
	
	$query = "SELECT * FROM glasovi WHERE KorisnikID=" . $korisnikID . " AND SlikaID=" . $pictures[0]['SlikaID'];
	$imaveclajk = $konekcija->getRecord($query); 
	
	echo "<a href='profil.php?userID=" . $userID . "'>Nazad</a>";
	
	echo "<form method='post' action='" . $_SERVER['PHP_SELF'] . "'>";
	for ($i=0; $i<count($pictures); $i+=3) {
		echo "<div class='glavnidiv'>";
		
			$query = "SELECT COUNT(*) AS Broj FROM glasovi WHERE SlikaID=" . $pictures[$i]['SlikaID'];
			$lajkovi1 = $konekcija->getRecord($query);
			
			if ((count($pictures) - $i > 3) || (count($pictures) % 3 != 1)) {
				$query = "SELECT COUNT(*) AS Broj FROM glasovi WHERE SlikaID=" . $pictures[$i+1]['SlikaID'];
				$lajkovi2 = $konekcija->getRecord($query);
			}
			if ((count($pictures) - $i > 3) || (count($pictures) % 3 == 0)) {
				$query = "SELECT COUNT(*) AS Broj FROM glasovi WHERE SlikaID=" . $pictures[$i+2]['SlikaID'];
				$lajkovi3 = $konekcija->getRecord($query);
			}
			
			echo "<div class='galerija1'><img src='" . $pictures[$i]['SlikaURL'] . "'><div class='lajkovi'>" . $lajkovi1[0];
				echo pravopis($lajkovi1[0]);
				/*
				if (danasnja($datum[0])) echo " jeste danasnja";
				if ($_SESSION['userName'] != $userdata[1]) echo " ne sam sebi";
				if ($imaveclajk == false) echo " nema vec lajk";*/
				
				if ($i==0 && danasnja($datum[0]) && $korisnik != $userdata[1] && $imaveclajk == false)
					echo "<input type='submit' name='lajk' value='Glasaj'>";
				if ($i==0 && danasnja($datum[0]) && $imaveclajk != false)
					echo "<input type='submit' name='unlike' value='Unlike'>";
				echo "</div></div>";
			
			if (count($pictures) - $i > 3) {
				echo "<div class='galerija2'><img src='" . $pictures[$i+1]['SlikaURL'] . "'><div class='lajkovi'>" . $lajkovi2[0];
					echo pravopis($lajkovi2[0]) . "</div></div>";
				echo "<div class='galerija3'><img src='" . $pictures[$i+2]['SlikaURL'] . "'><div class='lajkovi'>" . $lajkovi3[0];
					echo pravopis($lajkovi3[0]) . "</div></div>";
			}
			else {
				if (count($pictures) % 3 != 1) {
					echo "<div class='galerija2'><img src='" . $pictures[$i+1]['SlikaURL'] . "'><div class='lajkovi'>" . $lajkovi2[0];
					echo pravopis($lajkovi2[0]) . "</div></div>";
				}
				if (count($pictures) % 3 == 0) {
					echo "<div class='galerija3'><img src='" . $pictures[$i+2]['SlikaURL'] . "'><div class='lajkovi'>" . $lajkovi3[0];
					echo pravopis($lajkovi3[0]) . "</div></div>";
				}
			}
			
		echo "</div>";
	}
	echo "<input type='hidden' value='" . $userID ."' name='userID'>";
	echo "</form>";
	
	if (array_key_exists('lajk',$_POST)) {
		
		$query = "INSERT INTO glasovi VALUES (" . $korisnikID . ", " . $pictures[0]['SlikaID'] . ")";
		$konekcija->doQuery($query);
		header('Location: galerija.php?userID=' . $userID);
	}
	if (array_key_exists('unlike',$_POST)) {
		
		$query = "DELETE FROM glasovi WHERE KorisnikID=" . $korisnikID . " AND SlikaID=" . $pictures[0]['SlikaID'];
		$konekcija->doQuery($query);
		header('Location: galerija.php?userID=' . $userID);
	}
	
?>