<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Strict//EN">
<html>
<head>
<title>Proba</title>

<style type="text/css">
    
	#container{
		width: 1200px;
		background: #D8ECF2;
		margin:auto;
		margin-top: 40px;
	}
	#header{
		background: #66E6ED;
		width: 100%;
		height: 50px;
	}
	#gore{
		margin: auto;
		background: #D8ECF2;
	}
	.forma{
		display: inline-block;
		text-align: center;
		width: 100%;
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
		<div style="float: right; margin-right: 20px; padding: 12px;"><a href="adminmoderator.php"><b> Udji kao moderator </b></a></div>
		<div style="float: right; margin-right: 20px; padding: 12px;"><a href="../view/index.php"><b> Pocetna/Feed </b></a></div>
	</div>
	<div id="container">
		<div id="gore">			
			<form class="forma" action="deleteuser.php" method="post">
				<h1 style="margin-top: 0; margin-left: 20px; padding-top: 20px;">Obrisite korisnika:</h1>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Korisnicko ime korisnika: <input name="inputName" type="text" style="width:30%; margin-left: 20px;"></input><br>
				<input name="submit" type="submit" value="Obrisite korisnika" style="padding: 10px; margin-top: 10px; margin-left:465px;"></input><br><br><br>
			</form>
			<form class="forma" action="promenimod.php" method="post">
				<h1 style="margin-top: 0; margin-left: 20px; padding-top: 20px;">Promenite moderatora:</h1>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Stara lozinka moderatora: <input name="inputStaraMod" type="text" style="width:30%; margin-left: 20px;"></input><br><br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nova lozinka moderatora: <input name="inputNovaMod" type="text" style="width:30%; margin-left: 20px;"></input><br>
				<input name="submit" type="submit" value="Promenite moderatora" style="padding: 10px; margin-top: 10px; margin-left:435px;"></input><br><br><br>
			</form>
			<form class="forma" action="promeniadmin.php" method="post">	
				<h1 style="margin-top: 0; margin-left: 20px; padding-top: 20px;">Promenite administratora:</h1>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Stara lozinka administratora: <input name="inputStaraAdmin" type="text" style="width:28%; margin-left: 20px;"></input><br><br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nova lozinka administratora: <input name="inputNovaAdmin" type="text" style="width:28%; margin-left: 20px;"></input><br>
				<input name="submit" type="submit" value="Promenite administratora" style="padding: 10px; margin-top: 10px; margin-left:415px;"></input><br><br><br>
			</form>
			
		</div>
		
	</div>
<?php
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
	if (isset($_GET['Message4'])) {
				$msg = $_GET['Message4'];
				echo "<script type='text/javascript'>alert('$msg');</script>";
			}
	if (isset($_GET['Message5'])) {
				$msg = $_GET['Message5'];
				echo "<script type='text/javascript'>alert('$msg');</script>";
			}
	if (isset($_GET['Message6'])) {
				$msg = $_GET['Message6'];
				echo "<script type='text/javascript'>alert('$msg');</script>";
			}
	if (isset($_GET['Message7'])) {
				$msg = $_GET['Message7'];
				echo "<script type='text/javascript'>alert('$msg');</script>";
			}
	if (isset($_GET['Message8'])) {
				$msg = $_GET['Message8'];
				echo "<script type='text/javascript'>alert('$msg');</script>";
			}
	if (isset($_GET['Message9'])) {
				$msg = $_GET['Message9'];
				echo "<script type='text/javascript'>alert('$msg');</script>";
			}
?>
</body>
</html>