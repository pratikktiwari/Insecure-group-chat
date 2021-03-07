<?php
    session_start();

?>
<html>

<head>
    <title>Group chat app</title>
    <link rel="stylesheet" href="css/chat.css" />
</head>

<body>
    <div class="topContainer">
        <div class="chatContainer">
            <div class="chatTopNav">
                <div class="nameBanner">P</div>
                <div class="nickName">
                    <?php echo $_SESSION['username']; ?>
                </div>
            </div>
            <div class="chatArea" id="chatArea">
                <div class="messageReceive">
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
                </div>
            </div>
            <div class="chatTextBox">
                <textarea id="sendTextBox"></textarea>
                <button onclick="addToChat()">Send</button>
            </div>
        </div>
    </div>
    <script>
        const addToChat = () => {
            const sendTextBox = document.getElementById("sendTextBox")
            let chatData = sendTextBox.value
            chatData = chatData.replace(/\s+/g, ' ').trim();

            const chatArea = document.getElementById("chatArea")

            chatArea.innerHTML += `
                <div class="messageSend">
                    <div class="nameBanner">P</div>
                    <div class="message">
                        ${chatData}
                    </div>
                </div>
            `
            sendTextBox.value = ""
            scrollToBottom()
            saveChatData("abcd", chatData)
        }
        document.querySelector('#sendTextBox').addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault()
                addToChat()
            }
        });
        const scrollToBottom = () => {
            const container = document.getElementById("chatArea")
            container.scrollTo(0, container.offsetHeight);
        }
    </script>
    <script src="js/script.js"></script>
    <!-- <script src="https://cdn.rawgit.com/github/fetch/master/fetch.js" defer></script> -->
</body>

</html>