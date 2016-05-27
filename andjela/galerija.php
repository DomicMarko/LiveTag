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
	$query = "SELECT s.SlikaID, s.SlikaURL, s.KorisnikID, s.TopikID, s.BrojGlasova FROM slika_post s, topik t WHERE s.KorisnikID=$userdata[0] AND s.TopikID = t.TopikID ORDER BY t.DatumObjave DESC";
	$pictures = $konekcija->getRecordSet($query);
	
	// za proveru za lajkovanje danasnje slike
	$queryDatum = "SELECT DatumObjave FROM topik WHERE TopikID=" . $pictures[0]['TopikID'];
	$datum = $konekcija->getRecord($queryDatum);
	
	$query = "SELECT * FROM glasovi WHERE KorisnikID=" . $korisnikID . " AND SlikaID=" . $pictures[0]['SlikaID'];
	$imaveclajk = $konekcija->getRecord($query); 
	
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
	
<?php	
	echo "<a id='nazad' href='profil.php?userID=" . $userID . "'>Nazad</a>";
	
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