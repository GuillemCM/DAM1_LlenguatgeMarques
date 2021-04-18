<?php
	//Borrar sessió
	session_start();
	if (isset($_SESSION)) 
	{
		unset($_SESSION["user"]);
	}
	header("Location: index.php");
?>