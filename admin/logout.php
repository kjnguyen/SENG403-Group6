<?php
    define("INCLUDE_FILE", true);
    include_once 'auth_utils.php';
    //Check login first
    CheckLogin();
    //Logout now
    Logout();
?>