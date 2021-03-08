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
    //returning a single row
    class CHAT{
        public $id, $username, $message;
        function __construct($id, $uname, $message){
            $this->id = $id;
            $this->username = $uname;
            $this->message = $message;
        }
    }
    function getChatData(){
        $res = query("SELECT * FROM chat_records");
        if(!$res){return false;}
        $list = array();
        while($row = getRows($res)){
            $chat = new CHAT($row['id'], $row['username'], $row['message']);
            // $list['message'] = $row['message'];
            // $list['username'] = $row['username'];
            $list[] = $chat;
        }
        return json_encode($list);
    }
    function getLastMessageId(){
        $res = query("SELECT id FROM chat_records ORDER BY id DESC LIMIT 1");
        if(!$res){return false;}
        $list = array();
        $row = getRows($res);
        $list['id'] = $row['id'];
        return json_encode($list);
    }

 ?>
