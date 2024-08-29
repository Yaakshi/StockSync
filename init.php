<?php

session_start();

include("database/connection.php");

// Set session duration and cookie parameters
ini_set('session.gc_maxlifetime', 3600); // Session duration: 1 hour
session_set_cookie_params(3600, "/", "", true, true); // Cookie parameters: 1 hour, secure, HttpOnly

// Automatic session renewal logic
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 1800)) {
    // Last activity was more than 30 minutes ago
    session_unset();     // Unset session variables
    session_destroy();   // Destroy the session
    header("Location: login.php"); // Redirect to login page after session timeout
    exit;
}

$_SESSION['last_activity'] = time(); // Update last activity timestamp

// Remember Me logic
if (isset($_COOKIE['remember_me']) && !isset($_SESSION['user_id'])) {
    // Check the remember me token
    $token = $_COOKIE['remember_me'];
    
    // Perform database check for token and expiration
    $stmt = $mysqli->prepare("SELECT user_id FROM user_sessions WHERE token = ? AND expiration > NOW()");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->bind_result($user_id);
    $stmt->fetch();
    
    if ($user_id) {
        // Token is valid; set the session
        $_SESSION['user_id'] = $user_id;
    } else {
        // Invalid token; clear the remember me cookie
        setcookie('remember_me', '', time() - 3600, "/", "", true, true);
    }

    $stmt->close(); // Close the statement
}

// Close MySQLi connection when done
$mysqli->close();
?>
