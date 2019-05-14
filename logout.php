<?php
    //cerramos las sessiones inciadas
	session_start();
	// remove all session variables
	session_unset();
	// destroy the session
    session_destroy(); 
    //redirigir al usuario al login screen
    header("Location: login.php");
    die();
?>