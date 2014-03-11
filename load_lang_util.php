<?php
    //Prevent Direct Access, return 404 page not found
    if(!defined("INCLUDE_FILE"))
    {
    	header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found', true, 404);die();
    }

    //This file contains functions to load/switch language, it should be included in all multi-lang support pages
    if (isset($_GET["lang"])) {
        $Cur_LangID = $_GET["lang"];
    } else {
        $Cur_LangID = "en";
    }
    //If there is no input, we will use the default lang
    if ($Cur_LangID == "") {$Cur_LangID = "en";}
    //Check if lang file exist
    if (!isset($CurrentPageToRootDir)) { //If it is unset, assume the file is located at root folder
        $CurrentPageToRootDir = '.';
    }
    if (!file_exists($CurrentPageToRootDir.'/langs/lang_'.$Cur_LangID.'_admin_general.php') || !file_exists($CurrentPageToRootDir.'/langs/lang_'.$Cur_LangID.'_'.basename($_SERVER['PHP_SELF']))) {$Cur_LangID = "en";}
    if (!file_exists($CurrentPageToRootDir.'/langs/lang_'.$Cur_LangID.'_admin_general.php') || !file_exists($CurrentPageToRootDir.'/langs/lang_'.$Cur_LangID.'_'.basename($_SERVER['PHP_SELF']))) {die("Fatal Error: Unable to load language files.<br />'Lang_".$Cur_LangID.'_'.basename($_SERVER['PHP_SELF'])."' Not found!");}
    //Import language files
    include_once ($CurrentPageToRootDir.'/langs/lang_'.$Cur_LangID.'_'.basename($_SERVER['PHP_SELF']));
?>