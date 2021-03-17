<?php
    session_start();
    $_SESSION['last_msg'] = 0;

    if(!isset($_SESSION['username']) || !isset($_SESSION['key'])){
        header("Location:askName.php");
    }

?>
<html>

<head>
    <title>Group chat app</title>
    <link rel="stylesheet" href="css/chat.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
</head>

<body>
    <div class="topContainer">
        <input id="current_username" type="hidden" disabled value=<?php echo $_SESSION['username'] ; ?> />
        <input id="last_message_id" name="startFrom" type="hidden" disabled value="0" />

        <div class="chatContainer">
            <div class="chatTopNav">
                <div class="nameBanner">
                    <?php echo strtoupper($_SESSION['username'][0]) ; ?>
                </div>
                <div class="nickName">
                    <?php echo $_SESSION['username']; ?>
                </div>
            </div>
            <div class="chatArea" id="chatArea">
                <!-- <div class="messageReceive">
                    <div class="nameBanner">P</div>
                    <div class="message">
                        hello world how are you
                        hello world how are you
                        hello world how are you
                    </div>
                </div>
                <div class="messageSend">
                    <div class="nameBanner">P</div>
                    <div class="message">
                        hello world how are you
                        hello world how are you
                        hello world how are you
                    </div>
                </div> -->
            </div>
            <div id="chatEmojiDiv">
                <!-- &#128578;
                &#128528;
                &#128533;
                &#128543;
                &#129321; -->
            </div>
            <div class="chatTextBox">
                <textarea id="sendTextBox"></textarea>
                <!-- <button onclick="showEmoji()">&#128578;</button> -->
                <button onclick="addToChat()">Send</button>
            </div>
        </div>
    </div>


    <script src="js/script.js"></script>
    <!-- <script>


    </script> -->

    <!-- <script src="https://cdn.rawgit.com/github/fetch/master/fetch.js" defer></script> -->
    <script src="js/html2canvas.js"></script>
</body>

</html>