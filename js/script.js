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

            document.getElementById("chatArea").innerHTML +=
                `<div class="messageReceive">
                    <div class="nameBanner">P</div>
                    <div class="message">
                        ${info}
                    </div>
                </div>`
            // createDOMDoctor(decoded);
        }
    }
    doc.send(data)
}