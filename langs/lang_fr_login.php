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
    
    //French file for login page
    $Lang_Welcome_To_Admin_Page = 'Bonjour!';
    $Lang_Go_Back_To_Market = 'Retour ид 4J Estate Marketplace';
    $Lang_Please_Enter_Data_To_Login = '';
    $Lang_Username_or_Email = 'Nom d\'utilisateur ou e-mail';
    $Lang_Password = 'Mot de passe';
    $Lang_Login = 'Login';
    $Lang_Req_Account = 'Demander un compte';
    
    //Error messages
    $Lang_Internal_Server_Err = '[FR Translation not completed]Internal server error. Please try again!';
    $Lang_Successfully_Loggedout = '[FR Translation not completed]Successfully logged out.';
    $Lang_Invalid_Login_Req = '[FR Translation not completed]Invalid login request. Please try again!';
    $Lang_Invalid_Username = '[FR Translation not completed]Invalid username. Please try again!';
    $Lang_Pswd_Not_Match = '[FR Translation not completed]Invalid username or password!';
    $Lang_Not_Logged_In = '[FR Translation not completed]You are not logged in, please login first!';
?>