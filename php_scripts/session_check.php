<?php

	session_start();

	$_SESSION['userType'] = 'elite';
	$_SESSION['userID'] = 5;
	$_SESSION['userName'] = 'veljaRob';
	
	if(!($_SESSION['userType'])) {
				
		header("Location:../view/login.php");
		exit;
	}
	/*
	else {
		
		session_unset(); 
		session_destroy();
	}*/
?>
