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

    //This file contains functions to load/switch language, it should be included in all multi-lang support pages
    $Cur_LangID = $_GET["lang"];
    //If there is no input, we will use the default lang
    if ($Cur_LangID == "") {$Cur_LangID = "en";}
    //Check if lang file exist
    if (!isset($CurrentPageToRootDir)) { //If it is unset, assume the file is located at root folder
        $CurrentPageToRootDir = '.';
    }
    if (!file_exists($CurrentPageToRootDir.'/langs/lang_'.$Cur_LangID.'_'.basename(__FILE__))) {$Cur_LangID = "en";}
    if (!file_exists($CurrentPageToRootDir.'/langs/lang_'.$Cur_LangID.'_'.basename(__FILE__))) {die("Fatal Error: Unable to load language files.");}
    //Import language files
    include_once ($CurrentPageToRootDir.'/langs/lang_'.$Cur_LangID.'_'.basename(__FILE__));
?>