<?php

	$databaseHost = 'localhost';
	$databaseName = 'mattendance';
	$databaseUsername = 'root';
	$databasePassword = '';

	$conn = new PDO('mysql:host=' . $databaseHost . ';dbname=' . $databaseName . '','root','');
	echo "Connection is there<br/>";
	$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

?>
