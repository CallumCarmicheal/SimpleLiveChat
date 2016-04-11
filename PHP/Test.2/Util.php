<?php

    function random_lipsum($amount = 1, $what = 'paras', $start = 0) {
        return simplexml_load_file("http://www.lipsum.com/feed/xml?amount=$amount&what=$what&start=$start")->lipsum;
    }

    function varDie($type, $variable, $message, &$out) {
        flagDie(empty($type[$variable]), $message);
        $out = $type[$variable];
    }

    function flagDie($flag, $message) {
        if($flag) die($message);
    }
?>
