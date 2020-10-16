<?php
	$servername = "localhost";
	$username = "s1903359DB";
	$password = "Testing2020!";
	$dbname = "PublicDB";

	$connection = new MySQLi($servername, $username, $password, $dbname);

	if($connection->connect_error) {
		echo $connection->connect_error;
	}

	
?>