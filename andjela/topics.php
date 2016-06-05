<!--################################################################
	Autor: Andjela Spasić 2013/0055, tim Elites
	Projekat: LiveTag
	Verzija: 1.0
	
################################################################# 
-->

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

<?php

    require_once('../genal/checklogin.php');
	
?>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">    

    <title>LiveTag - Home</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/modal.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<div class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container">
	<div class="navbar-header">
	  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	  </button>
	  <a class="navbar-brand" href="../view/index.php">LiveTag</a>
	</div>
	<div class="navbar-collapse collapse navbar-right">
	  <ul class="nav navbar-nav">
		<li id="newMessage"></li>                              
		<?php
			if(($_SESSION['userType'] != 'guest') && ($_SESSION['userType'] != 'admin')) {
				echo "<li><a href=\"profil.php?userID=" . $_SESSION['userID'] . "\">" . $_SESSION['userName'] . "</a></li>"
					. "<li><a href=\"../genal/logout.php\">Logout</a></li>";
			} 
			if($_SESSION['userType'] == 'guest') {
				echo "<li><a href=\"../genal/logout.php\">Ulogujte se</a></li>";
			}
			if($_SESSION['userType'] == 'admin') {
				echo "<li><a href=\"../gazda/adminpanel.php\">Admin panel</a></li>" . 
					"<li><a href=\"../gazda/moderator.php\">Moderator panel</a></li>" . 
					"<li><a href=\"../genal/logout.php\">Logout</a></li>";
				}
		?>                    
	  </ul>
	</div><!--/.nav-collapse -->
  </div>
</div>


<a id='nazad' href='../view/index.php'>Nazad</a>

<div class="glavni">
	<?php
		for ($i=0; $i<(count($teme)>10 ? 10 : count($teme)); $i++) {
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
			$date=date_create($teme[$i]['DatumObjave']);
			echo "<h3>" . date_format($date,"d.m.Y.") . " - " . $teme[$i]['Naziv'] . "</h3>";
				
				echo "<table>";
				echo "<tr>";
					if ($user1 != 0) {
						echo "<td class='left'><font class='rednibroj'>1.</font> <font class='podaci'><a href='profil.php?userID=" . $slika1[1] . "'>" . $user1[0] . " " . $user1[1] . "</a>, " . $user1[2] . " poena</font></td>";
						echo "<td class='right'><img src='" . $slika1[0] . "'></td>";
					}
				echo "</tr>";
				echo "<tr>";
					if ($user2 != 0) {
						echo "<td class='left'><font class='rednibroj'>2.</font> <font class='podaci'><a href='profil.php?userID=" . $slika2[1] . "'>" . $user2[0] . " " . $user2[1] . "</a>, " . $user2[2] . " poena</font></td>";
						echo "<td class='right'><img src='" . $slika2[0] . "'></td>";
					}
				echo "</tr>";
				echo "<tr>";
					if ($user3 != 0) {
						echo "<td class='left'><font class='rednibroj'>3.</font> <font class='podaci'><a href='profil.php?userID=" . $slika3[1] . "'>" . $user3[0] . " " . $user3[1] . "</a>, " . $user3[2] . " poena</font></td>";
						echo "<td class='right'><img src='" . $slika3[0] . "'></td>";
					}
				echo "</tr>";
				echo "<tr>";
					if ($user4 != 0) {				
						echo "<td class='left'><font class='rednibroj'>4.</font> <font class='podaci'><a href='profil.php?userID=" . $slika4[1] . "'>" . $user4[0] . " " . $user4[1] . "</a>, " . $user4[2] . " poena</font></td>";
						echo "<td class='right'><img src='" . $slika4[0] . "'></td>";
					}
				echo "</tr>";
				echo "<tr>";
					if ($user5 != 0) {
						echo "<td class='left'><font class='rednibroj'>5.</font> <font class='podaci'><a href='profil.php?userID=" . $slika5[1] . "'>" . $user5[0] . " " . $user5[1] . "</a>, " . $user5[2] . " poena</font></td>";
						echo "<td class='right'><img src='" . $slika5[0] . "'></td>";
					}
				echo "</tr>";
				echo "</table>";
			echo "</div>";
		}

	?>
</div>