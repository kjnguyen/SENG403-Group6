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
        <label>Your name:</label>
        <input required type="text" name="SenderName" maxlength="64" value="" />
        <label>Your Email:</label>
        <input required type="text" name="SenderEmail" maxlength="64" value="" />
        <label>Your message:</label>
        <textarea required rows="4" cols="50" name="Message" maxlength="4096"></textarea>
        <button type="submit">Submit</button>
    </form>
<?php 
    //Set variables
    $_SESSION["Send_Message"] = 1;
    $_SESSION["Send_Message_Targeted_Company_ID"] = $_GET['ID'];
}


?>