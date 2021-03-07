<?php	
	$db_host = "localhost";
	$db_name = "chatapp";
	$db_pass = "";
	$db_user = "root";

	$connection = new mysqli($db_host, $db_user, $db_pass, $db_name);
	if ($connection->connect_error) die($connection->connect_error);
?>	
