<?php

	require_once('../db_config.php');
	
	$conn = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD);
	mysql_select_db(DB_DATABASE);



?>