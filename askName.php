<?php
    session_start();
    if(isset($_POST['username']) && isset($_POST['key'])){
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['key'] = $_POST['key'];
        header("Location:chatInterface.php");
    }
?>
<html>

<head>
    <title>Group chat app</title>
    <link rel="stylesheet" href="css/index.css" />
</head>

<body>
    <div class="topContainer">
        <form action="askName.php" method="post">
            <div>
                <input type="text" name="username" placeholder="Nick Name" required/>
            </div>
            <div>
                <input type="text" name="key" placeholder="Pass code" required/>
            </div>
            <div>
                <button>Join Now</button>
            </div>
        </form>
    </div>
</body>

</html>