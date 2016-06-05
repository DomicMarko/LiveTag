<!--################################################################
	Autor: Andjela Spasić 2013/0055, tim Elites
	Projekat: LiveTag
	Verzija: 1.0
	
################################################################# 
-->

<link rel="stylesheet" type="text/css" href="sendtopiccss.css">
<?php
	require_once('../genal/checklogin.php');
	
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
	
echo "<a id='nazad' href='../view/index.php'>Nazad</a>";
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
					echo "</br><p class='tekst'>Vas topik ce biti prosledjen nadleznima, radi provere. Ako nije moguce objaviti
					</br>Vas topik, bicete obavesteni o tome i moci cete ponovo da posaljete Vas predlog.</p>";
				}
				else {
					if ($imazahtev != 0)
						echo "</br><p class='tekst'>Vec ste poslali zahtev za topik.</p>";
					if ($imaneobjavljen != 0)
						echo "</br><p class='tekst'>Postoji Vas topik koji jos uvek nije objavljen.</p>";
				}
			}
		?>
	</div>
</form>

