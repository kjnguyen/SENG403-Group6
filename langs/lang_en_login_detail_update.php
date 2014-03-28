<?php

    //Prevent Direct Access, return 404 page not found
    if(!defined("INCLUDE_FILE"))
    {
    	header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found', true, 404);die();
    }
    
    //Login detail update page language
    $Lang_Home = "Home";
    $Lang_Edit_Login_Details = "Edit Login Details";
    $Lang_Confirmation =  "Comfirmation";
    
    //Php process messages
    $Lang_Error = "Error: ";
    $Lang_No_Direct_Access = "No direct access to this page.";
    $Lang_No_Permission = "You do not have permission to perform this action!";
    $Lang_Invalid_User_ID = "Invalid user ID.";
    $Lang_No_Permission_Mod_Username = "You do not have permission to modfiy username field.";
    $Lang_Invalid_User_Name = "Username contains invalid characters. Only letters and numbers are allowed!";
    $Lang_Invalid_Email_Adr = "Invalid email address.";
    $Lang_Pswd_Mismatch = "Passwords mismatch!";
    $Lang_Nothing_Being_Changed = "You are not changing anything...";
    $Lang_Updated_Failed = "Update login detail failed, this could caused by duplicated email or username.";
?>