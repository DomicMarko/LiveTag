<!--################################################################
	Autor: Andjela Spasić 2013/0055, tim Elites
	Projekat: LiveTag
	Verzija: 1.0
	
################################################################# 
-->

<?php 
$link = mysql_connect('hostname','dbuser','dbpassword'); 
if (!$link) { 
	die('Could not connect to MySQL: ' . mysql_error()); 
} 
echo 'Connection OK'; mysql_close($link); 
?> 