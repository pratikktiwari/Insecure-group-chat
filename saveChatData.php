<?php
	session_start();
	include_once "db/functions.php";

	if (isset($_POST['messageSendReceive'])){

		$username = $_SESSION['username'];
		$message = $_POST['message'];

		// $message = str_replace("'","\"\"",$message);//replace with double quote
		$message = str_replace("'","''",$message);//replace single with double
		//  $message = str_replace("&","&amp;",$message);//replace & with &amp;

		if($message=="clear_the_clutter(*)"){
			clearChatData();
			$list = array();
			$list['res'] = "operation_success";
			echo json_encode($list);
		}else if(strlen($message) == 0){
			// echo "abcd";
		}else{
			addChat($username, $message);

			$list = array();
			$list['res'] = "added";

            echo json_encode($list);
		}
	}
	// else if(isset($_POST['messageInitialReceive'])){
	// 	echo getChatData();
	// }
	else if(isset($_POST['messageInitialReceive']) && isset($_POST['startFrom'])){
		$startFrom = $_POST['startFrom'];
		// $list = new array();
		// echo $startFrom;
		echo getChatDataFromId($startFrom);
	}
	
	else if(isset($_POST['getLastMessageID'])){
		echo getLastMessageId();
	}
	else{
		echo "Some error occured. Try again.";
	}
	
?>