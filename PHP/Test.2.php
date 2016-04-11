<?php

    require("Test.2/Util.php");
    require("Test.2/ChatLog.php");

    $requestMethod = $_SERVER['REQUEST_METHOD'];

    if($requestMethod == "GET") {
        $method = "chat";
        if(!empty($_GET['method']))
            $method = $_GET['method'];

        if($method == "chat")
            die(chatGetLog());
        else if($method == "poll")
            die(chatGetDate());
        else exit;
    }

    else if ($requestMethod == "POST") {
        varDie($_POST, "name", "No name found in post", $name);
        varDie($_POST, "msg",  "No msg found in post",  $message);
        chatAddMessage($name, $message);
    }

?>
