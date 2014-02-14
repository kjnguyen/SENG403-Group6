<?php
    //Prevent Direct Access, return 404 page not found
    if(!defined("INCLUDE_FILE"))
    {
    	header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found', true, 404);die();
    }
    
    /*
     * Login variables
     * $Authed_UserID
     * $Authed_Username
     * $Authed_Email
     * $Authed_Permission, (1 = admin, 2 = company, 3 = employee)
     * $Authed_Exipre
     */
    
    function CheckLogin() {
    }
?>