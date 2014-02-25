<?php
   /*
    * This file was written by Jack L (http://jack-l.com)
    * Please do not change without my permission!
    * You may use any part of the follow code on your other projects or programs.
    * Please send me Email if you have any questions related to this page.
    */

    define("INCLUDE_FILE", true);
    include_once 'auth_utils.php';
    //Start session
    session_start();
    //Check login first
    CheckLogin();
    //Logout now
    Logout();
?>