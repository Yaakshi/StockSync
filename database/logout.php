<?php

include("connection.php");

session_start();

if (isset($_COOKIE['remember_me'])) {
    $token = $_COOKIE['remember_me'];

    $delete_query = "DELETE FROM user_tokens WHERE token = ?";
    $delete_stmt = $conn->prepare($delete_query);
    $delete_stmt->bind_param("s", $token);
    $delete_stmt->execute();
    $delete_stmt->close();

    setcookie('remember_me', '', time() - 3600, '/', '', false, true);
}

session_unset();

session_destroy();

header('location: ../index.php');

?>