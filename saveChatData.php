<?php
	session_start();
	include_once "db/functions.php";

	if (isset($_POST['messageSendReceive'])){

		$username = $_SESSION['username'];
		$message = $_POST['message'];

		// $message = str_replace("'","\"\"",$message);//replace with double quote
		$message = str_replace("'","''",$message);//replace single with double

		if($message=="clear_the_clutter(*)"){
			clearChatData();
			echo "";
		}else if(strlen($message) == 0){
			// echo "abcd";
		}else{
			addChat($username, $message);
            echo getChatData();
		}
	}else if(isset($_POST['messageInitialReceive'])){
		echo getChatData();
	}else if(isset($_POST['getLastMessageID'])){
		echo getLastMessageId();
	}
	else{
		echo "Some error occured. Try again.";
	}
	
?>