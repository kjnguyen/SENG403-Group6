<?php
    //Prevent Direct Access, return 404 page not found
    if(!defined("INCLUDE_FILE"))
    {
    	header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found', true, 404);die();
    }
    
    //Mail sending function
    //Arguments:
    //$to: can be multiple receivers (seperate by a comma), for example "123@example.com, 456@example.com"
    //$from: can be an email address. You may leave it empty or NULL to use default sender address. Default sender address is in settings.php
    //$subject: some string, not too long
    //$message: some string. If mail type is html, please organize your message with html code.
    //$mailtype: text or html, default is text if not defined.
    Function Mail_Send($to, $subject, $message, $mailtype = "text") {
        define('MAIL_TextCharLimitEachLine', 100, true);
        define('MAIL_TextBreakChar', "\r\n", true);
        /*if (constant('MAIL_SendMethod') == 0) {
            echo "<br />Send mail failed: Mail function disabled.<br />";
            return;
        } else if (constant('MAIL_SendMethod') != 1) {
            echo "<br />Send mail failed: Unknown method.<br />";
            return;
        }*/

        //if ($from == NULL || $from == "") {
            //$from = constant('MAIL_From');
        //}
        $from = "mailing@s403.jack-l.com";
        $headers = "";
        if ($mailtype == "html") {
            $headers .= 'MIME-Version: 1.0' . constant('MAIL_TextBreakChar');
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . constant('MAIL_TextBreakChar');
        } else if ($mailtype == "text") {
            $CharLimit = constant('MAIL_TextCharLimitEachLine');
            $message = wordwrap($message, $CharLimit, constant('MAIL_TextBreakChar')); //Auto line break for long messages
        } else {
            echo "<br />Send mail failed: Unknown mail type. Please use 'text' or 'html' only.<br />";
            return;
        }
        
        $headers .= 'From: '. $from . constant('MAIL_TextBreakChar');
        mail($to, $subject, $message, $headers);
    }
?>