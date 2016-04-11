<?php
    date_default_timezone_set("Europe/London");

    function chatGetFile() {
        return "res/ChatLog.2.txt";
    }

    function chatGetLog() {
        // Output file text
        $file = file_get_contents(chatGetFile());
        return($file);
    }

    function chatAddMessage($user, $message) {
        $output = $user. ": ". $message. "\n";
        file_put_contents(chatGetFile(), $output, FILE_APPEND);
    }

    function chatGetDate() {
        $fileTime = filemtime(chatGetFile());
        $date = date("F d Y H:i:s", $fileTime);
        return ($date. "");
    }
?>
