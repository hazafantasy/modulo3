<?php

session_start();

$o = filter_input(INPUT_GET, "best", FILTER_SANITIZE_SPECIAL_CHARS);

switch ($o) {

    case "1":
        $go = 20;
        break;

    case "2":
        $go = 60;
        break;

    case "3":
        $go = 10;
        break;

    default:
        $go = 0;
}


echo $go;