function saveChatData(username, message) {

    const doc = new XMLHttpRequest()
    const url = "saveChatData.php"

    const data = "messageSendReceive=set&username=" + username + "&message=" + message
    doc.open("POST", url, true)
    doc.setRequestHeader("Content-type", "application/x-www-form-urlencoded")

    doc.onreadystatechange = () => {
        if (doc.readyState == 4 && doc.status == 200) {

            const info = doc.responseText;

            // const decoded = JSON.parse(info);

            // document.getElementById("chatArea").innerHTML +=
            //     `<div class="messageReceive">
            //         <div class="nameBanner">P</div>
            //         <div class="message">
            //             ${info}
            //         </div>
            //     </div>`
            // createDOMDoctor(decoded);
        }
    }
    doc.send(data)
}
function receiveInitialChats(current_user) {

    const doc = new XMLHttpRequest()
    const url = "saveChatData.php"

    const data = "messageInitialReceive=set"

    doc.open("POST", url, true)
    doc.setRequestHeader("Content-type", "application/x-www-form-urlencoded")

    doc.onreadystatechange = () => {
        if (doc.readyState == 4 && doc.status == 200) {

            const info = doc.responseText;

            const decodedData = JSON.parse(info);

            for (let i = 0; i < decodedData.length; i++) {
                const chatItem = decodedData[i];
                if (chatItem.username === current_user) {
                    document.getElementById("chatArea").innerHTML +=
                        `<div class="messageSend">
                            <div class="nameBanner">${chatItem.username}</div>
                            <div class="message">
                                ${chatItem.message}
                            </div>
                        </div>`
                } else {
                    document.getElementById("chatArea").innerHTML +=
                        `<div class="messageReceive">
                            <div class="nameBanner">${chatItem.username[0]}</div>
                            <div class="message">
                                ${chatItem.message}
                            </div>
                        </div>`
                }
            }
        }
    }
    doc.send(data)
}
const scrollToBottom = () => {
    const container = document.getElementById("chatArea")
    container.scrollTo(0, container.offsetHeight);
}