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
    
    //English language file for edit login detail
    //General labels
    $Lang_Home = "[FR]Home";
    $Lang_Edit_Login_Details = "[FR]Edit Login Details";
    $Lang_Leave_Field_Empty_For_No_Change = "[FR]Please leave the field empty or same value if you do not want to change that field. [Except User ID]";
    
    //Form labels
    $Lang_Targeted_User_ID = "[FR]Targeted User ID";
    $Lang_Your_ID = "[FR]Your ID is";
    $Lang_User_ID = "[FR]User ID:";
    $Lang_Usr_Name = "[FR]Username";
    $Lang_New_Usr_Name = "[FR]New Username";
    $Lang_Your_Cur_Usr_Name = "[FR]Your current username is";
    $Lang_New_Email = "[FR]New Email";
    $Lang_Your_Cur_Email = "[FR]Your current Email is";
    $Lang_New_Pswd = "[FR]New Password";
    $Lang_Leave_Empty_For_No_Change_Pswd = "[FR]Leave empty for not change pswd.";
    $Lang_Cfm_Pswd = "[FR]Confirm Password";
    $Lang_Cfm_Pswd2 = "[FR]Please confirm your password!";
    $Lang_Save = "[FR]Save Changes";
    $Lang_Reset = "[FR]Reset";
    
?>