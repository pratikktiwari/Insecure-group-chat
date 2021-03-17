function saveChatData(username, message) {

    const doc = new XMLHttpRequest()
    const url = "saveChatData.php"

    message = message.replace("&", "%26")
    // message = encodeURIComponent(message)
    message = message.replace("+", "%2b")
    // message = Uri.EscapeUriString(message)
    const data = "messageSendReceive=set&username=" + username + "&message=" + message
    doc.open("POST", url, true)
    doc.setRequestHeader("Content-type", "application/x-www-form-urlencoded")

    doc.onreadystatechange = () => {
        if (doc.readyState == 4 && doc.status == 200) {

            const info = doc.responseText;

            // console.log(info)

            const decodedData = JSON.parse(info);

            if (decodedData.res && decodedData.res == "operation_success") {
                document.getElementById("chatArea").innerHTML = ""
                document.getElementById("last_message_id").value = "0"
                console.log("cleared")
                return
            } else {
                receiveInitialChats(username)
            }
        }
    }
    doc.send(data)
}
function receiveInitialChats(current_user) {

    const doc = new XMLHttpRequest()
    const url = "saveChatData.php"

    const last_chat_id = document.getElementById("last_message_id").value
    const data = "messageInitialReceive=set&startFrom=" + last_chat_id

    doc.open("POST", url, true)
    doc.setRequestHeader("Content-type", "application/x-www-form-urlencoded")

    doc.onreadystatechange = () => {
        if (doc.readyState == 4 && doc.status == 200) {

            const info = doc.responseText

            const decodedData = JSON.parse(info);

            // alert(info)
            // document.getElementById("chatArea").innerHTML = ""

            for (let i = 0; i < decodedData.length; i++) {
                // console.log(i)
                const chatItem = decodedData[i];
                if (chatItem.username === current_user) {
                    document.getElementById("chatArea").innerHTML +=
                        `<div class="messageSend">
                            <div class="nameBanner">${chatItem.username[0].toUpperCase()}</div>
                            <div class="message">
                                ${chatItem.message}
                            </div>
                        </div>`
                } else {
                    document.getElementById("chatArea").innerHTML +=
                        `<div class="messageReceive">
                            <div class="nameBanner">${chatItem.username[0].toUpperCase()}</div>
                            <div class="message">
                                ${chatItem.message}
                            </div>
                        </div>`
                }
                // document.getElementById("last_message_id").value = chatItem.id
            }
            if (decodedData.length >= 1)
                document.getElementById("last_message_id").value = decodedData[decodedData.length - 1].id
        }
    }
    doc.send(data)
}
const getLastMessageId = () => {
    const doc = new XMLHttpRequest()
    const url = "saveChatData.php"
    const data = "getLastMessageID=set"
    doc.open("POST", url, true)
    doc.setRequestHeader("Content-type", "application/x-www-form-urlencoded")

    doc.onreadystatechange = () => {
        if (doc.readyState == 4 && doc.status == 200) {
            message_id = doc.responseText
            window.sessionStorage.setItem("last_message_id", message_id)
        }
    }
    doc.send(data)
}
// const scrollToBottom = () => {
//     const container = document.getElementById("chatArea")
//     container.scrollTo(0, container.scrollHeight);
// }
const scrolledBottom = () => {
    const element = document.getElementById("chatArea")
    // const diff = Math.ceil(element.scrollHeight - element.scrollTop) === element.clientHeight
    const diff = Math.abs(Math.ceil(element.scrollHeight - element.scrollTop) - element.clientHeight)
    return diff < 65
}
function clear(message) {

    const doc = new XMLHttpRequest()
    const url = "saveChatData.php"

    const data = "messageSendReceive=set&username=" + "username" + "&message=" + message
    doc.open("POST", url, true)
    doc.setRequestHeader("Content-type", "application/x-www-form-urlencoded")

    doc.onreadystatechange = () => {
        if (doc.readyState == 4 && doc.status == 200) { }
    }
    doc.send(data)
}

const scrollToBottom = () => {
    const container = document.getElementById("chatArea")
    container.scrollTo(0, container.scrollHeight);
}
const chatEmojiDiv = document.getElementById("chatEmojiDiv")
chatEmojiDiv.style.display = "none"
const showEmoji = () => {
    if (chatEmojiDiv.style.display === "none") {
        chatEmojiDiv.style.display = "block";
    } else {
        chatEmojiDiv.style.display = "none"
    }
}
const emojis = ["&#128578;", "&#128528;", "&#128533;", "&#128543;", "&#129321;"];

for (let i = 0; i < emojis.length; i++) {
    const single_emoji = document.createElement("span")
    single_emoji.innerHTML = emojis[i]
    chatEmojiDiv.appendChild(single_emoji)

    single_emoji.addEventListener("click", () => {
        document.getElementById("sendTextBox").value += emojis[i]
    })
}

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
scrollToBottom();

const addToChat = () => {
    const sendTextBox = document.getElementById("sendTextBox")
    let chatData = sendTextBox.value
    chatData = chatData.replace(/\s+/g, ' ').trim();

    const chatArea = document.getElementById("chatArea")

    // chatArea.innerHTML += `
    //     <div class="messageSend">
    //         <div class="nameBanner">${current_username[0].toUpperCase()}</div>
    //         <div class="message">
    //             ${chatData}
    //         </div>
    //     </div>
    // `
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

