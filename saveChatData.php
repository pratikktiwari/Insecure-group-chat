<?php
	session_start();
	include_once "db/functions.php";

	if (isset($_POST['messageSendReceive'])){

		$username = $_SESSION['username'];
		$message = $_POST['message'];

		if(strlen($message) == 0){
			// echo "abcd";
		}else{
			addChat($username, $message);
            echo getChatData();
		}
	}else if(isset($_POST['messageInitialReceive'])){
		echo getChatData();
	}
	else{
		echo "Some error occured. Try again.";
	}
	
?>