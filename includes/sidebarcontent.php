<?php
session_start();
$_SESSION['user'] = (isset($_GET['user']) === true) ? (int)$_GET['user'] : 0;


?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Chat</title>
        <link rel="stylesheet" href="css/chat.css">
    </head>
    <body>
        <h3>Chat</h3>
        <div class="chat">
            <div class="messages">
            
            </div>
            <textarea class="entry" placeholder="Type here and hit Return. Use Shift + Return for a new line"></textarea>
        </div>
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
        <script src="js/chat.js"></script>
    </body>
</html>
