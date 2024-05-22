<?php
session_start(); // Start the session

// Check if the user is logged in
if(isset($_COOKIE['user_id'])){
   // If the user is logged in, unset the user_id cookie
   setcookie('user_id', '', time() - 3600, '/'); // Set expiration time in the past to delete the cookie
}

// Redirect the user to the login page after logout
header('Location: login.php');
exit();
?>
