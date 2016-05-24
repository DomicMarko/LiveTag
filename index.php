<?php

//	session_start();
/*
	$_SESSION['userType'] = 'elite';
	$_SESSION['userID'] = 3;
	$_SESSION['userName'] = 'micdo';
*/	

	session_start();

	if(!isset($_SESSION["loggedin"])||$_SESSION["loggedin"]!=true){
		header("Location: genal/login.php");
		exit();
	}

if($_SESSION['userType'] == 'admin') {

	header('Location:gazda/adminpanel.php');
}
else if($_SESSION['userType'] == 'mod') {

	header('Location:gazda/moderator.php');

}else {

header('Location:view/index.php');
}
	/*
	else {
		
		session_unset(); 
		session_destroy();
	}*/
?>
