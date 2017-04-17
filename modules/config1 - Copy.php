<?php

	$databaseHost = 'localhost';
	$databaseName = 'id1300904_mattendance';
	$databaseUsername = 'id1300904_root';
	$databasePassword = 'mattendance@123';
	
	try {
		
		$conn = new PDO('mysql:host=' . $databaseHost . ';dbname=' . $databaseName . '', $databaseUsername, $databasePassword);
	}
	catch (PDOException $e) {
    echo $e->getMessage();
	}
	// echo "Connection is there<br/>";
	$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

?>