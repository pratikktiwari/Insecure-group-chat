<?php
    session_start();

?>
<html>

<head>
    <title>Group chat app</title>
    <link rel="stylesheet" href="css/chat.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <div class="topContainer">
        <input id="current_username" type="hidden" disabled value=<?php echo $_SESSION['username'] ; ?> />
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
            <div class="chatTextBox">
                <textarea id="sendTextBox"></textarea>
                <button onclick="addToChat()">Send</button>
            </div>
        </div>
    </div>
    <script>
        const current_username = document.getElementById("current_username").value
        document.body.onload = () => {
            receiveInitialChats(current_username)
            getLastMessageId()
        }
        //infinite receive chat multiple times => 
        //check last message id => compare and push to innerHTML
        // window.setInterval(() => {
        //         receiveInitialChats(current_username);
        //         scrolledBottom() && scrollToBottom();

        //     }, 500)
        const refreshChat = () => window.setTimeout(() => {
            receiveInitialChats(current_username);
            scrolledBottom() && scrollToBottom();
            setTimeout(refreshChat, 500)
        }, 500)
        setTimeout(refreshChat, 500)

        const addToChat = () => {
            const sendTextBox = document.getElementById("sendTextBox")
            let chatData = sendTextBox.value
            chatData = chatData.replace(/\s+/g, ' ').trim();

            const chatArea = document.getElementById("chatArea")

            chatArea.innerHTML += `
                <div class="messageSend">
                    <div class="nameBanner">${current_username[0].toUpperCase()}</div>
                    <div class="message">
                        ${chatData}
                    </div>
                </div>
            `
            sendTextBox.value = ""

            scrollToBottom()
            saveChatData(current_username, chatData)
        }
        document.querySelector('#sendTextBox').addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault()
                addToChat()
            }
        });

    </script>
    <script src="js/script.js"></script>
    <!-- <script src="https://cdn.rawgit.com/github/fetch/master/fetch.js" defer></script> -->
</body>

</html>