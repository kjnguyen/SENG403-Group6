<?php
//Prevent Direct Access, return 404 page not found
if(!defined("search_utils.php"))
{
    echo '404 Not Found';
     header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found', true, 404);die();
}

/*
 * Show_Msg_From function will not accept any input
 * It will display the form as output
 * This function should only be called with frontend template is initialized
 */
function Show_Msg_Form() {?>
    <form method="post" action="./send_msg.php">
        <label>Contact the company:</label><br />
        <label>Your name:</label><br />
        <input required type="text" name="SenderName" maxlength="64" value="" /><br />
        <label>Your Email:</label><br />
        <input required type="text" name="SenderEmail" maxlength="64" value="" /><br />
        <label>Your message:</label><br />
        <textarea required rows="10" cols="100" name="Message" maxlength="4096"></textarea><br />
        <br /><button type="submit">Submit</button><br />
    </form>
<?php
    //Set variables
    $_SESSION["Send_Message"] = 1;
    $_SESSION["Send_Message_Targeted_Company_ID"] = $_GET['ID'];
    $_SESSION["Send_Message_Return_URL"] = Get_Client_URL();
}

//Get client requested URL
//No arug, return URL string
function Get_Client_URL() {
    $ReqURL = 'http';
    if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {$ReqURL .= "s";}
        $ReqURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") {
            $ReqURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
        } else {
            $ReqURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    }
    return $ReqURL;
}
?>