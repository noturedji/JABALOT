<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "testjabadb";

$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if($mysqli -> connect_errno) {
    echo "Failed to connect db" . $mysqli -> connect_error;
    exit();
}

?>