<?php
	$servername = "localhost";
	$usernameDB = "root";
	$password = "";
	$dbname = "supermercat";

	$conn = new mysqli($servername, $usernameDB, $password, $dbname);

	if ($conn->connect_error) 
	{
		die("ERROR al connectar con la base de datos");
	}
?>