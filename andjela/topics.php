<link rel="stylesheet" type="text/css" href="topics.css">

<?php
	require_once 'Konekcija.php';
	require_once 'config.php';
	$konekcija = new Konekcija(DB_HOST, DB_NAME, DB_USER, DB_PASS);
	
	$query = "SELECT * FROM topik WHERE Objavljen=2";
	$teme = $konekcija->getRecordSet($query);

	
	function sortiranje($item1, $item2) {
		if ($item1['DatumObjave'] == $item2['DatumObjave']) return 0;
		return ($item1['DatumObjave'] < $item2['DatumObjave']) ? 1 : -1;
	}
	
	if ($teme != 0)
		usort($teme, 'sortiranje');
		
?>
<a href='../view/index.php'>Nazad</a>

<div class="glavni">
	<?php
		for ($i=0; $i<count($teme); $i++) {
			$query = "SELECT SlikaURL, KorisnikID FROM slika_post WHERE SlikaID=" . $teme[$i]['PrvoMesto'];
			$slika1 = $konekcija->getRecord($query);
			$query = "SELECT Ime, Prezime, BrojPoena FROM korisnik WHERE KorisnikID=" . $slika1[1];
			$user1 = $konekcija->getRecord($query);
			
			$query = "SELECT SlikaURL, KorisnikID FROM slika_post WHERE SlikaID=" . $teme[$i]['DrugoMesto'];
			$slika2 = $konekcija->getRecord($query);
			$query = "SELECT Ime, Prezime, BrojPoena FROM korisnik WHERE KorisnikID=" . $slika2[1];
			$user2 = $konekcija->getRecord($query);
			
			$query = "SELECT SlikaURL, KorisnikID FROM slika_post WHERE SlikaID=" . $teme[$i]['TreceMesto'];
			$slika3 = $konekcija->getRecord($query);
			$query = "SELECT Ime, Prezime, BrojPoena FROM korisnik WHERE KorisnikID=" . $slika3[1];
			$user3 = $konekcija->getRecord($query);
			
			$query = "SELECT SlikaURL, KorisnikID FROM slika_post WHERE SlikaID=" . $teme[$i]['CetvrtoMesto'];
			$slika4 = $konekcija->getRecord($query);
			$query = "SELECT Ime, Prezime, BrojPoena FROM korisnik WHERE KorisnikID=" . $slika4[1];
			$user4 = $konekcija->getRecord($query);
			
			$query = "SELECT SlikaURL, KorisnikID FROM slika_post WHERE SlikaID=" . $teme[$i]['PetoMesto'];
			$slika5 = $konekcija->getRecord($query);
			$query = "SELECT Ime, Prezime, BrojPoena FROM korisnik WHERE KorisnikID=" . $slika5[1];
			$user5 = $konekcija->getRecord($query);
			
			echo "<div class='jedantopik'>";
			echo "<h3>" . $teme[$i]['DatumObjave'] . " - " . $teme[$i]['Naziv'] . "</h3>";
				
				echo "<table>";
				echo "<tr>";
					if ($user1 != 0) {
						echo "<td class='left'><font class='rednibroj'>1.</font> <font class='podaci'>" . $user1[0] . " " . $user1[1] . ", " . $user1[2] . " poena</font></td>";
						echo "<td class='right'><img src='" . $slika1[0] . "'></td>";
					}
				echo "</tr>";
				echo "<tr>";
					if ($user2 != 0) {
						echo "<td class='left'><font class='rednibroj'>2.</font> <font class='podaci'>" . $user2[0] . " " . $user2[1] . ", " . $user2[2] . " poena</font></td>";
						echo "<td class='right'><img src='" . $slika2[0] . "'></td>";
					}
				echo "</tr>";
				echo "<tr>";
					if ($user3 != 0) {
						echo "<td class='left'><font class='rednibroj'>3.</font> <font class='podaci'>" . $user3[0] . " " . $user3[1] . ", " . $user3[2] . " poena</font></td>";
						echo "<td class='right'><img src='" . $slika3[0] . "'></td>";
					}
				echo "</tr>";
				echo "<tr>";
					if ($user4 != 0) {				
						echo "<td class='left'><font class='rednibroj'>4.</font> <font class='podaci'>" . $user4[0] . " " . $user4[1] . ", " . $user4[2] . " poena</font></td>";
						echo "<td class='right'><img src='" . $slika4[0] . "'></td>";
					}
				echo "</tr>";
				echo "<tr>";
					if ($user5 != 0) {
						echo "<td class='left'><font class='rednibroj'>5.</font> <font class='podaci'>" . $user5[0] . " " . $user5[1] . ", " . $user5[2] . " poena</font></td>";
						echo "<td class='right'><img src='" . $slika5[0] . "'></td>";
					}
				echo "</tr>";
				echo "</table>";
			echo "</div>";
		}

	?>
</div>