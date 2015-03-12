<?php

include 'includes/functions.php';

// start the session (as there is no header on this page)
session_start();

// unset the login session variable
unset($_SESSION['loggedIn']);

// destroy the cookie
destroyTheCookie();

// redirect to home page
header('Location: index.php');


?>