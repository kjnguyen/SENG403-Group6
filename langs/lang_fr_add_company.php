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
    $Lang_Home = "[FR]Home";
    $Lang_Add_Company = "[FR]Add a company";
    
    //Form
    $Lang_Company_Name = "[FR]Company Name";
    $Lang_Company_Adr = "[FR]Company Address";
    $Lang_Company_Mgr = "[FR]Company manager";
    $Lang_Company_Ph = "[FR]Company Phone Number";
    $Lang_Company_Email = "[FR]Company Email";
    $Lang_Company_Username = "[FR]Username";
    $Lang_Company_Password = "[FR]Password";
    $Lang_Company_Cfm_Password = "[FR]Confirm Password";
    $Lang_Company_Cfm_Pswd_Msg = "[FR]Please confirm your password!";
    $Lang_Company_Description = "[FR]Company Description";
    $Lang_Company_Add = "[FR]Add";
    $Lang_Company_Cancel = "[FR]Cancel";
?>