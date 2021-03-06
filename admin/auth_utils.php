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
    
    /*
     * Login variables
     * You should not change the following variables.
     * $_SESSION['Authed_UserID'], User unique ID
     * $_SESSION['Authed_Username'], Username
     * $_SESSION['Authed_Email'], Email
     * $_SESSION['Authed_Permission'], (1 = admin, 2 = company, 3 = employee)
     * $_SESSION['Authed_Exipre'], expire time
     */
    
    //This function must be call before any html output!
    //No input
    //Output: If failed, user will be redirect to login page with error id in session.
    //Output: If success, nothing happen. Page will continue to load
    function CheckLogin() {
        $_SESSION['Authed_Error'] = 4;
        //Check variable set
        if (!isset($_SESSION['Authed_UserID']) || !isset($_SESSION['Authed_Username']) || !isset($_SESSION['Authed_Email']) || !isset($_SESSION['Authed_Permission']) || !isset($_SESSION['Authed_Exipre'])) {
            header("location:./login.php");
        }
        //Check null variable
        if ($_SESSION['Authed_UserID'] == null || $_SESSION['Authed_Username'] == null || $_SESSION['Authed_Email'] == null || $_SESSION['Authed_Permission'] == null || $_SESSION['Authed_Exipre'] == null) {
            header("location:./login.php");
        }
        //Check empty variable
        if ($_SESSION['Authed_UserID'] == '' || $_SESSION['Authed_Username'] == '' || $_SESSION['Authed_Email'] == '' || $_SESSION['Authed_Permission'] == '' || $_SESSION['Authed_Exipre'] == '') {
            header("location:./login.php");
        }
        //Check idle time, 1hr limit
        if ($_SESSION['Authed_Exipre'] < time()) {
            Logout();
        } else {
            $_SESSION['Authed_Exipre'] = time() + 3600;
        }
        //Everything passed
        unset($_SESSION['Authed_Error']);
    }
    
    //Must be call before any header output
    //Output: Unset login sessions and redirect user to login page
    function Logout() {
        unset($_SESSION['Authed_UserID']);
        unset($_SESSION['Authed_Username']);
        unset($_SESSION['Authed_Email']);
        unset($_SESSION['Authed_Permission']);
        unset($_SESSION['Authed_Exipre']);
        $_SESSION['Authed_Error'] = 0;
        header("location:./login.php");
    }
?>