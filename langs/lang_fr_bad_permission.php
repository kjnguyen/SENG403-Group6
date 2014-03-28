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
    
    //Bad permission page
    $Lang_Home = "[FR]Home";
    $Lang_Error = "[FR]Error";
    $Lang_Permission_Denied = "[FR]Permission Denied";
    $Lang_No_Permission_Msg = "[FR]Sorry you don't have permission to edit this Listing";
?>