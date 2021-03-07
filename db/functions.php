<?php
    include_once "db.php";

    function query($query){
        global $connection;
        $result = $connection->query($query);
        if (!$result) die($connection->error);
        return $result;
    }

    function getRows($result){
        $row = $result->fetch_array(MYSQLI_ASSOC);
        return $row;
    }
    function addChat($username,$message){
        query("INSERT INTO chat_records (username,message,dateTime) VALUES ('$username','$message',NOW())");
    }
    function getChatData(){
        $res = query("SELECT * FROM chat_records");
		if(!$res){return false;}
		$list = array();
		while($row = getRows($res)){
			$list['message'] = $row['message'];
            $list['username'] = $row['username'];
		}
		return json_encode($list);
    }

 ?>
