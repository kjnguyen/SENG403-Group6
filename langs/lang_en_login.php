<?php
   /*
    * This file was written by Jack L (http://jack-l.com)
    * Please do not change without my permission!
    * You may use any part of the follow code on your other projects or programs.
    * Please send me Email if you have any questions related to this page.
    */

    //Prevent Direct Access, return 404 page not found
    if(!defined("INCLUDE_FILE"))
    {
    	header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found', true, 404);die();
    }
    
    //English file for login page
    $Lang_Welcome_To_Admin_Page = 'Welcome to admin control panel';
    $Lang_Go_Back_To_Market = 'Back to 4J Estate Marketplace';
    $Lang_Please_Enter_Data_To_Login = 'Please enter your username and password to login.';
    $Lang_Username_or_Email = 'Username or Email';
    $Lang_Password = 'Password';
    $Lang_Login = 'Login';
    $Lang_Req_Account = 'Request Account';
    
    //Error messages
    $Lang_Internal_Server_Err = 'Internal server error. Please try again!';
    $Lang_Successfully_Loggedout = 'Successfully logged out.';
    $Lang_Invalid_Login_Req = 'Invalid login request. Please try again!';
    $Lang_Invalid_Username = 'Invalid username. Please try again!';
    $Lang_Pswd_Not_Match = 'Invalid username or password!';
    $Lang_Not_Logged_In = 'You are not logged in, please login first!';
?>