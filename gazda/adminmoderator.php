<?php
include '../genal/checklogin.php';
include '../genal/checkadmin.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Strict//EN">
<html>
<head>
<title>Proba</title>

<style type="text/css">
    
	#container{
		width: 1200px;
		background: #D8ECF2;
		margin:auto;
	}
	#header{
		background: #66E6ED;
		width: 100%;
		height: 50px;
	}
	.topiklist{
		width: 35%;
		height: 300px;
		display: block;
		float: left;
		margin-top: 50px;
		margin-left: 95px;
		overflow-y: scroll;
		overflow-x: hidden;
		padding-left: 30px;
		background: white;
	}
	#obrisiTopik{
		width: 40%;
		height: 300px;
		display: block;
		float: left;
		margin-top: 50px;
		margin-left: 25px;
		padding-left: 30px;
	}
	#okolo{
		width: 100%;
		display: block;
		float: left;
		margin-bottom: 25px;
	}
	.klasica{
		float: right;
		padding-right: 10px;
	}
	#gore{
		background: #D8ECF2;
	}
	#poruka{
		margin-top: 70px;
	}
	body{
	margin: 0;
	background: #D8ECF2;
	}
</style>

</head>

<body>
	<div id="header">
		<div style="float: right; margin-right: 20px; padding: 12px;"><a href="../genal/logout.php"><b> Odjavi se </b></a></div>
		<div style="float: right; margin-right: 20px; padding: 12px;"><a href="adminpanel.php"><b> Admin panel </b></a></div>
		<div style="float: right; margin-right: 20px; padding: 12px;"><a href="../view/index.php"><b> Pocetna/Feed </b></a></div>
	</div>
	<div id="container">
		<div id="gore">
			<form action="create.php" method="post">
				<center><h2 style="margin-top: 0; margin-left: 20px; padding-top: 20px;">Unesite topik koji zelite da bude objavljen (max 30 karaktera):</h2></center>
				<center><input name="inputName" type="text" style="width:80%; margin-left: 20px;"></input><br></center>									
				<center><input name="submit" type="submit" value="Dodajte topik" style="padding: 10px; margin-top: 10px; margin-left:73%;"></input></center>
			</form>
		</div>
		<div id="okolo">
			<div class="topiklist">
			<?php
				error_reporting(E_ALL ^ E_DEPRECATED);

				include 'connection.php';
				
				$query = "SELECT * FROM topik ORDER BY DatumObjave";
				$result = mysql_query($query);
				
				while($topiks = mysql_fetch_array($result)){
					if($topiks['Objavljen'] == 0){
					echo "<h3>" . $topiks['TopikID'] . ". ", $topiks['Naziv'] . " - " . "$topiks[DatumObjave]" . " " . "<a class=" . "klasica" . " href='delete.php?del=$topiks[TopikID]'>delete</a>" . "</h3>";
				   }
				}
			?>
			</div>
			<div class="topiklist">
				<?php
				error_reporting(E_ALL ^ E_DEPRECATED);

				//include 'connection.php';
				
				$query = "SELECT * FROM zahtev";
				$result = mysql_query($query);
				
				while($topiks = mysql_fetch_array($result)){
					$id1 = $topiks['KorisnikID'];
					$info = mysql_fetch_array(mysql_query("SELECT * FROM `korisnik` WHERE `KorisnikID` = '$id1'"));
					$username = $info['Username'];
					echo "<h3>" . $topiks['Naziv'] . " - ", $username .  "<a class=" . "klasica" . " href='deletezahtev.php?del=$topiks[ZahtevID]'>Odbij</a>" . "<a class=" . "klasica" . " href='potvrdizahtev.php?novi=$topiks[ZahtevID]'>Potvrdi</a>" . "</h3>";
				}
			?>
			</div>
		</div>  <br><br><br>
			<div class="poruka">
				<form align="center" action="swaptopik.php" method="post">
					<h1 style="margin-top: 0px; text-align: center; padding-top: 20px; margin-bottom: 0px;">Swapujte 2 topika:</h1><br>
					<div style="text-align:center; margin: auto; width: 100%;">
					<div style="width:100%; ">Naziv prvog topika: <input name="top1" type="text" style="width:33%; margin-left: 20px;"></input></div><br>
					<div style="width: 100%;">
					<div>
					<div style="width:100%; ">Naziv drugog topika: <input name="top2" type="text" style="width:33%; margin-left: 10px;"></input></div>
					</div><br>				
					<div style="width:46%; margin:auto; text-align:right;">
					<input name="submit" type="submit" value="Swapujte" style="padding: 10px;"></input>
					</div>
					</div>
					</div>
				</form>
			</div>
		
			<div id="poruka">
				<form align="center" action="posaljiporuku.php" method="post">
					<h1 style="margin-top: 0px; text-align: center; padding-top: 20px; margin-bottom: 0px;">Posaljite poruku korisniku:</h1><br>
					<div style="text-align:center; margin: auto; width: 100%;">
					<div style="width:100%; ">Korisnicko ime korisnika: <input name="inputUser" type="text" style="width:30%; margin-left: 20px;"></input></div><br>
					<div style="width: 100%;">
					<div>
					<div style="width:35%; float: left; text-align: right; margin-left:5%; margin-right: 3%;">Vasa poruka:</div>
					<div style="width:55%; float:left; text-align: left;"><textarea  name="inputPoruka" rows="4"  style="width: 54%;"></textarea></div>
					</div><br>				
					<div style="width:46%; margin:auto; text-align:right;">
					<input name="submit" type="submit" value="Posaljite poruku" style="padding: 10px;"></input>
					</div>
					</div>
					</div>
				</form>
			</div>
	</div>
<?php
	if (isset($_GET['Messagexyz'])) {
				$msg = $_GET['Messagexyz'];
				echo "<script type='text/javascript'>alert('$msg');</script>";
			}
	if (isset($_GET['Messagexy'])) {
				$msg = $_GET['Messagexy'];
				echo "<script type='text/javascript'>alert('$msg');</script>";
			}
	if (isset($_GET['Messagex'])) {
				$msg = $_GET['Messagex'];
				echo "<script type='text/javascript'>alert('$msg');</script>";
			}
	if (isset($_GET['Message'])) {
				$msg = $_GET['Message'];
				echo "<script type='text/javascript'>alert('$msg');</script>";
			}
	if (isset($_GET['Message1'])) {
				$msg = $_GET['Message1'];
				echo "<script type='text/javascript'>alert('$msg');</script>";
			}
	if (isset($_GET['Message2'])) {
				$msg = $_GET['Message2'];
				echo "<script type='text/javascript'>alert('$msg');</script>";
			}
	if (isset($_GET['Message3'])) {
				$msg = $_GET['Message3'];
				echo "<script type='text/javascript'>alert('$msg');</script>";
			}
?>
</body>
</html>