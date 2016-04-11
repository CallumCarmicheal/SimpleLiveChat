<?php
    date_default_timezone_set("Europe/London");
    function random_lipsum($amount = 1, $what = 'paras', $start = 0) {
        return simplexml_load_file("http://www.lipsum.com/feed/xml?amount=$amount&what=$what&start=$start")->lipsum;
    }

    $chatFileLoc = "res/ChatLog.1.txt";
    $requestMethod = $_SERVER['REQUEST_METHOD'];

    /* $name = "CallPHP";
    $message = random_lipsum(5, "words");
    $output = $name. ": ". $message. "\n";
    file_put_contents($chatFileLoc, $output, FILE_APPEND); */


    if($requestMethod == "GET") {

        $method = "chat";
        if(!empty($_GET['method']))
            $method = $_GET['method'];

        if($method == "chat") {
            // Output file text
            $file = file_get_contents($chatFileLoc);
            die($file);
        } else if($method == "lineGet") {
            //
        } else if($method == "poll") {
            // Echo the current line in the chat
            // (USED TO SAVE BANDWIDTH ON POLLING!)

            $fileTime = filemtime($chatFileLoc);
            $date = date("F d Y H:i:s", $fileTime);
            die($date. "");
        } else {
            exit;
        }
    }

    else if ($requestMethod == "POST") {
        // Write user input to file

        /* Input Validation? */ {
            if(empty($_POST['name']))
                die("ERROR - No Name selected in post");

            if(empty($_POST['msg']))
                die("ERROR - No msg selected in post");
        }

        /* Store User Input */ {
            $name       = $_POST['name'];
            $message    = $_POST['msg'];
        }

        /* Write to file */ {
            $output = $name. ": ". $message. "\n";
            file_put_contents($chatFileLoc, $output, FILE_APPEND);
        }
    }

?>
