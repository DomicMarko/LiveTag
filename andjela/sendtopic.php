<link rel="stylesheet" type="text/css" href="sendtopiccss.css">
<?php
	session_start();
	
	$korisnik = $_SESSION['userName'];
	
	require_once 'Konekcija.php';
	require_once 'config.php';
	$konekcija = new Konekcija(DB_HOST, DB_NAME, DB_USER, DB_PASS);
	
	$query = "SELECT * FROM korisnik WHERE Username='" . $korisnik . "'";
	$userdata = $konekcija->getRecord($query);
	
	$query = "SELECT * FROM zahtev WHERE KorisnikID=" . $userdata[0];
	$imazahtev = $konekcija->getRecord($query);
	
	$query = "SELECT * FROM topik WHERE KorisnikID=" . $userdata[0] .
			 " AND Objavljen=0";
	$imaneobjavljen = $konekcija->getRecord($query);
	
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<div id="glavni">
		<h4>Unesite topik koji zelite da bude objavljen (max. 70 karaktera):</h4>
		<input type="text" size="70" name="topik"></br></br>
		<input id='btn' type="submit" value="Posalji topik" name="dugme">
		
		<?php
			if(array_key_exists('dugme',$_POST)) {
				if (($imazahtev == 0) && ($imaneobjavljen == 0)) {
					$zahtev = $_POST['topik'];
					$query = "INSERT INTO zahtev (Naziv, KorisnikID) VALUES ('" . $zahtev . "', " . $userdata[0]. ")";
					$konekcija->doQuery($query);
					echo "</br><p>Vas topik ce biti prosledjen nadleznima, radi provere. Ako nije moguce objaviti
					</br>Vas topik, bicete obavesteni o tome i moci cete ponovo da posaljete Vas predlog.</p>";
				}
				else {
					if ($imazahtev != 0)
						echo "</br><p>Vec ste poslali zahtev za topik.</p>";
					if ($imaneobjavljen != 0)
						echo "</br><p>Postoji Vas topik koji jos uvek nije objavljen.</p>";
				}
			}
		?>
	</div>
</form>

