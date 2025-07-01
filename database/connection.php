<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "stocksync";

function getMySQLiConnection($servername, $username, $password, $dbname) {

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

try {

    $conn = getMySQLiConnection($servername, $username, $password, $dbname);
} 

catch (Exception $e) {

    $error_message = $e->getMessage();
}

?>