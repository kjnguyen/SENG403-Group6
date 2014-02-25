<?php
    define("INCLUDE_FILE", true);
    include_once 'auth_utils.php';
    //Start session
    session_start();
    //Check login first
    CheckLogin();
    //Logout now
    Logout();
?>