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

<div class="glavni">
	<ul>
	<?php
		for ($i=0; $i<count($teme); $i++) {
			$query = "SELECT Ime, Prezime, BrojPoena FROM korisnik WHERE KorisnikID=" . $teme[$i]['PrvoMesto'];
			$user1 = $konekcija->getRecord($query); echo $user1[0] . "blabla";
			$query = "SELECT SlikaURL FROM slika_post WHERE KorisnikID=" . $teme[$i]['PrvoMesto'] . " AND TopikID=" . $teme[$i]['TopikID'];
			$slika1 = $konekcija->getRecord($query);
			
			$query = "SELECT Ime, Prezime, BrojPoena FROM korisnik WHERE KorisnikID=" . $teme[$i]['DrugoMesto'];
			$user2 = $konekcija->getRecord($query);
			$query = "SELECT SlikaURL FROM slika_post WHERE KorisnikID=" . $teme[$i]['DrugoMesto'] . " AND TopikID=" . $teme[$i]['TopikID'];
			$slika2 = $konekcija->getRecord($query);
			
			$query = "SELECT Ime, Prezime, BrojPoena FROM korisnik WHERE KorisnikID=" . $teme[$i]['TreceMesto'];
			$user3 = $konekcija->getRecord($query);
			$query = "SELECT SlikaURL FROM slika_post WHERE KorisnikID=" . $teme[$i]['TreceMesto'] . " AND TopikID=" . $teme[$i]['TopikID'];
			$slika3 = $konekcija->getRecord($query);
			
			$query = "SELECT Ime, Prezime, BrojPoena FROM korisnik WHERE KorisnikID=" . $teme[$i]['CetvrtoMesto'];
			$user4 = $konekcija->getRecord($query);
			$query = "SELECT SlikaURL FROM slika_post WHERE KorisnikID=" . $teme[$i]['CetvrtoMesto'] . " AND TopikID=" . $teme[$i]['TopikID'];
			$slika4 = $konekcija->getRecord($query);
			
			$query = "SELECT Ime, Prezime, BrojPoena FROM korisnik WHERE KorisnikID=" . $teme[$i]['PetoMesto'];
			$user5 = $konekcija->getRecord($query);
			$query = "SELECT SlikaURL FROM slika_post WHERE KorisnikID=" . $teme[$i]['PetoMesto'] . " AND TopikID=" . $teme[$i]['TopikID'];
			$slika5 = $konekcija->getRecord($query);
			echo "<li>";
			echo $teme[$i]['DatumObjave'] . " - " . $teme[$i]['Naziv'];
				
				echo "<table>";
				echo "<tr>";
					if ($user1 != 0) {
						echo "<td class='left'>1. " . $user1[0] . " " . $user1[1] . ", " . $user1[2] . " poena</td>";
						echo "<td class='right'><img src='" . $slika1[0] . "'></td>";
					}
				echo "</tr>";
				echo "<tr>";
					if ($user2 != 0) {
						echo "<td class='left'>2. " . $user2[0] . " " . $user2[1] . ", " . $user2[2] . " poena</td>";
						echo "<td class='right'><img src='" . $slika2[0] . "'></td>";
					}
				echo "</tr>";
				echo "<tr>";
					if ($user3 != 0) {
						echo "<td class='left'>3. " . $user3[0] . " " . $user3[1] . ", " . $user3[2] . " poena</td>";
						echo "<td class='right'><img src='" . $slika3[0] . "'></td>";
					}
				echo "</tr>";
				echo "<tr>";
					if ($user4 != 0) {				
						echo "<td class='left'>4. " . $user4[0] . " " . $user4[1] . ", " . $user4[2] . " poena</td>";
						echo "<td class='right'><img src='" . $slika4[0] . "'></td>";
					}
				echo "</tr>";
				echo "<tr>";
					if ($user5 != 0) {
						echo "<td class='left'>5. " . $user5[0] . " " . $user5[1] . ", " . $user5[2] . " poena</td>";
						echo "<td class='right'><img src='" . $slika5[0] . "'></td>";
					}
				echo "</tr>";
				echo "</table>";
			echo "</li>";
		}

	?>	
	</ul>
</div>