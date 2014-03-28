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
    
    //General stuff
    $Lang_Home = "Home";
    $Lang_Add_Company = "Add a company";
    
    //Form
    $Lang_Company_Name = "Company Name";
    $Lang_Company_Adr = "Company Address";
    $Lang_Company_Mgr = "Company manager";
    $Lang_Company_Ph = "Company Phone Number";
    $Lang_Company_Email = "Company Email";
    $Lang_Company_Username = "Username";
    $Lang_Company_Password = "Password";
    $Lang_Company_Cfm_Password = "Confirm Password";
    $Lang_Company_Cfm_Pswd_Msg = "Please confirm your password!";
    $Lang_Company_Description = "Company Description";
    $Lang_Company_Add = "Add";
    $Lang_Company_Cancel = "Cancel;"
?>