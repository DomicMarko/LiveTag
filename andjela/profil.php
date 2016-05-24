<link rel="stylesheet" type="text/css" href="profilcss.css">

<?php
	session_start();
	//$_SESSION['userName'] ='veljaRob';
	
	
	if (isset($_POST['action'])) {
		$userID = $_POST['userID'];
	}
	else
		$userID = $_GET['userID'];
	
	require_once 'Konekcija.php';
	require_once 'config.php';
	$konekcija = new Konekcija(DB_HOST, DB_NAME, DB_USER, DB_PASS);
	
	$query = "SELECT * FROM korisnik WHERE KorisnikID = " . $userID;
	$userdata = $konekcija->getRecord($query);	

	$query = "SELECT * FROM slika_post WHERE KorisnikID=$userdata[0]";
	$pictures = $konekcija->getRecordSet($query);
	
?>

<?php
	// Korisnik je obrisan
	if (isset($_POST['action']) && $_POST['action']=='Obrisi korisnika') {
		$query = "DELETE FROM korisnik WHERE KorisnikID=" . $userdata[0];
		$konekcija->doQuery($query);
	}
?>

<form action ="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
<table align="center" cellpadding="10" border="1">
	<?php
		if ($_SESSION['userName'] == 'admin') {
			echo "<tr><td>";
			echo "<input type='submit' name='action' value='Obrisi korisnika'>";
			echo "</td><td></td><td></td></tr>";
		}
	?>
	<tr>
		<td class="kolone">
			<?php
				// Upload nove profilne slike
				if (isset($_POST['action']) && $_POST['action']=='Promeni') {
					$errors= array();
					$userID = $_POST['userID'];
					$imeslike = $_FILES['fajl']['name']; // Untitled.png
					$target="slike/" . basename($imeslike); // slike/Untitled.png
					$file_size = $_FILES['fajl']['size'];
					$file_ext=substr($imeslike,strrpos($imeslike,'.')+1);	// png
					$file_tmp = $_FILES['fajl']['tmp_name'];
					$expensions= array("jpeg","jpg","png");
					if(in_array($file_ext,$expensions)=== false){
						$errors[]="extension not allowed, please choose a JPEG or PNG file.";
					}
					if($file_size > 2097152){
						$errors[]='File size must be excately 2 MB';
					}
					if(empty($errors)==true){
						move_uploaded_file($file_tmp,$target);
						echo "Success";
					}
					else {
						print_r($errors);
					}
					$query = "UPDATE korisnik SET AvatarURL='" . $target . "' WHERE Username='" . $userdata[1] . "'";
					$konekcija->doQuery($query);
					echo "<div class='picsize'><img src='" . $target . "'></div>";
					header('Location: profil.php?userID=' . $userID);
				}
				else if ($userdata[11] == NULL) {
					echo "<div class='picsize'><img src='slike/default_user.png'></div>";
				}
				else echo "<div class='picsize'><img src='". $userdata[11] . "'></div>";
			?>
			</br><?php echo $userdata[1]; ?> </br></br>
			<?php
				if (itsme($userdata[1])) {
					echo "Promeni profilnu sliku:</br>";
					echo "<input type='file' name='fajl'><input type='submit' name='action' value='Promeni'>";
					echo "</br></br>";
					echo "<input type='submit' name='action' value='Promeni lozinku'>";
				}
			?>
		</td>
		<td class="kolone2">
			<div class="podeli">
				<table cellpadding="5">
					<tr><td><b>Status:</b></td><td> <b><?php echo $userdata[10]; ?></b></td><td></td></tr>
					<tr><td>Sakupljen broj poena:</td><td> <?php echo $userdata[9]; ?></td><td></td></tr>
					<tr><td colspan="3"><b>Osnovni podaci:</b></td></tr>
				
					<tr><td>Ime:</td><td> <?php echo $userdata[3]; ?></td><td> <?php if (itsme($userdata[1])) echo "<input type='submit' name='action' value='Promeni ime'>"; ?> </td></tr>
					<tr><td>Prezime:</td><td> <?php echo $userdata[4]; ?></td><td> <?php if (itsme($userdata[1])) echo "<input type='submit' name='action' value='Promeni prezime'>"; ?> </td></tr>
					<tr><td>Datum rodjenja:</td><td> <?php $date=date_create($userdata[5]); echo date_format($date,"d.m.Y."); ?></td><td><?php if (itsme($userdata[1])) echo "<input type='submit' name='action' value='Promeni datum rodjenja'>"; ?></td></tr>
					<tr><td>Mesto stanovanja:</td><td> <?php echo $userdata[6]; ?></td><td><?php if (itsme($userdata[1])) echo "<input type='submit' name='action' value='Promeni mesto stanovanja'>"; ?></td></tr>
					<tr><td>Pol:</td><td> <?php if ($userdata[7] == 'Z') echo "Zenski"; else echo "Muski"; ?></td><td><?php if (itsme($userdata[1])) echo "<input type='submit' name='action' value='Promeni pol'>"; ?></td></tr>
					<tr><td>Email:</td><td> <?php echo $userdata[8]; ?></td><td><?php if (itsme($userdata[1])) echo "<input type='submit' name='action' value='Promeni email'>"; ?></td></tr>
				</table>
			</div>
		
			<div class="podeli" id="desnidiv">
				<?php
					if (isset($_POST['action']) && $_POST['action']=='Promeni ime') {
						echo "Unesite ime:</br>";
						echo "<input type='text' name='novoime' size='20'></br></br>";
						echo "<input type='submit' name='action' value='Potvrdi ime'>";
					}
					if (isset($_POST['action']) && $_POST['action']=='Promeni prezime') {
						echo "Unesite prezime:</br>";
						echo "<input type='text' name='novoprezime' size='20'></br></br>";
						echo "<input type='submit' name='action' value='Potvrdi prezime'>";
					}
					if (isset($_POST['action']) && $_POST['action']=='Promeni datum rodjenja') {
						echo "Unesite datum rodjenja:</br>";
						echo "<input type='date' name='novdatum' size='20'></br></br>";
						echo "<input type='submit' name='action' value='Potvrdi datum rodjenja'>";
					}
					if (isset($_POST['action']) && $_POST['action']=='Promeni mesto stanovanja') {
						echo "Unesite mesto stanovanja:</br>";
						echo "<input type='text' name='novomesto' size='20'></br></br>";
						echo "<input type='submit' name='action' value='Potvrdi mesto stanovanja'>";
					}
					if (isset($_POST['action']) && $_POST['action']=='Promeni pol') {
						echo "Unesite pol:</br>";
						echo "<input type='text' name='novpol' size='3'></br></br>";
						echo "<input type='submit' name='action' value='Potvrdi pol'>";
					}
					if (isset($_POST['action']) && $_POST['action']=='Promeni email') {
						echo "Unesite email:</br>";
						echo "<input type='text' name='novemail' size='25'></br></br>";
						echo "<input type='submit' name='action' value='Potvrdi email'>";
					}
				?>
			</div>
		</td>
	</tr>
	
	<?php
		if (isset($_POST['action']) && $_POST['action']=='Promeni lozinku') {
	?>
		<tr>
			<td>
				Unesite novu lozinku:</br>
				<input type="text" name="pass" size="20">
			</td>
			<td>
				Potvrdite novu lozinku:</br>
				<input type="text" name="pass2" size="20">
			</td>
			<td>
				<input type='submit' name='action' value='Potvrdi'>
			</td>
		</tr>
	<?php
		}
	?>
	
	<tr>
	<?php 
		if ($pictures == false)
			echo "<td colspan='3'>Korisnik nema nijednu objavljenu sliku.</td>";
		else {
	?>
		<td class="slike" colspan="2">
			<?php 

				for($i = 0; ($i < count($pictures)) && ($i < 3); $i++) {

					echo '<div id="slika' . ($i + 1) . '"><img src="../' . $pictures[$i]['SlikaURL'] . '"></div>';
				}

			?>
		</td>
	<?php
		}
	?>
	</tr>
	<?php
		if ($pictures != false) {
	?>
		<tr>
			<td colspan="2">
				<a href="galerija.php?userID=<?php echo $userID ?>">Kompletna galerija korisnika>></a>
			</td>
		</tr>
	<?php
		}
	?>
</table>
</form>

<?php
	if (isset($_POST['action'])) {
		// Promena lozinke
		if ($_POST['action']=='Potvrdi') {
			$pass = $_POST['pass'];
			$pass2 = $_POST['pass2'];
			if ($pass != $pass2) {
				echo "Niste potvrdili lozinku! Pokusajte ponovo.";
			}
			else {
				$query = "UPDATE korisnik SET Password='" . $pass . "' WHERE Username='" . $userdata[1] . "'";
				$konekcija->doQuery($query);
			}
			header('Location: profil.php?userID=' . $userID);
		}

		// Izmena podataka
		if ($_POST['action']=='Potvrdi ime') {
			$ime = $_POST['novoime'];
			$query = "UPDATE korisnik SET Ime='" . $ime . "' WHERE Username='" . $userdata[1] . "'";
			$konekcija->doQuery($query);
			header('Location: profil.php?userID=' . $userID);
		}
		if ($_POST['action']=='Potvrdi prezime') {
			$prezime = $_POST['novoprezime'];
			$query = "UPDATE korisnik SET Prezime='" . $prezime . "' WHERE Username='" . $userdata[1] . "'";
			$konekcija->doQuery($query);
			header('Location: profil.php?userID=' . $userID);
		}
		if ($_POST['action']=='Potvrdi datum rodjenja') {
			$datum = date('Y-m-d', strtotime($_POST['novdatum']));
			$query = "UPDATE korisnik SET DatumRodjenja='" . $datum . "' WHERE Username='" . $userdata[1] . "'";
			$konekcija->doQuery($query);
			header('Location: profil.php?userID=' . $userID);
		}
		if ($_POST['action']=='Potvrdi mesto stanovanja') {
			$mesto = $_POST['novomesto'];
			$query = "UPDATE korisnik SET MestoStanovanja='" . $mesto . "' WHERE Username='" . $userdata[1] . "'";
			$konekcija->doQuery($query);
			header('Location: profil.php?userID=' . $userID);
		}
		if ($_POST['action']=='Potvrdi pol') {
			$pol = $_POST['novpol'];
			$query = "UPDATE korisnik SET Pol='" . $pol . "' WHERE Username='" . $userdata[1] . "'";
			$konekcija->doQuery($query);
			header('Location: profil.php?userID=' . $userID);
		}
		if ($_POST['action']=='Potvrdi email') {
			$mail = $_POST['novemail'];
			$query = "UPDATE korisnik SET Email='" . $mail . "' WHERE Username='" . $userdata[1] . "'";
			$konekcija->doQuery($query);
			header('Location: profil.php?userID=' . $userID);
		}
	}
?>

<?php
	function itsme($person) {
		if ($_SESSION['userName'] == $person) return true;
		return false;
	}
?>