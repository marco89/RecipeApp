<?php

$db_host = "localhost";
$db_name = "recipe_app";
$db_user = "cms_www";
$db_pass = "ooSgk2)yoWsYj*z8";

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (mysqli_connect_error()) {
    echo mysqli_connect_error();
    exit;
}
