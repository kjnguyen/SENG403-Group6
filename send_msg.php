<?php
    //Start session
    session_start();
    //Start basic html output
?>
<html><head></head><body>

<?php
    //Check direct access
    if (isset($_SESSION['Send_Message']) && $_SESSION['Send_Message'] == 1) {
        unset($_SESSION['Send_Message']);
    } else {
        echo "No direct access!<br />";
        die();
    }
    
    //Validate user inputs
    //Name
    if (!isset($_POST['SenderName']) || strlen($_POST['SenderName']) < 3 || strlen($_POST['SenderName']) > 64) {
        echo "Error: Invalid length. Range: 3 to 64 characters.<br />";
        goto ShowReURL;
    }
    
    $resp = preg_match("/[^A-Z a-z]/", $_POST['SenderName']);
    if ($resp > 0) {
        echo "Error: Username contains invalid characters. Only letters and spaces are allowed!";
        goto ShowReURL;
    }
    
    //Validate email
    if (!filter_var($_POST['SenderEmail'], FILTER_VALIDATE_EMAIL)) {
        echo "Error: Invalid Email address!";
        goto ShowReURL;
    }
    
    //Check message length
    if (!isset($_POST['Message']) || strlen($_POST['Message']) < 10 || strlen($_POST['Message']) > 4096) {
        echo "Error: Invalid message length. Range: 10 to 4096 characters.<br />";
        goto ShowReURL;
    }
    
    //Validate input company ID
    if (!isset($_SESSION["Send_Message_Targeted_Company_ID"]) || !is_numeric($_SESSION["Send_Message_Targeted_Company_ID"])) {
        echo "Error: Invalid company ID.<br />";
        goto ShowReURL;
    }
    
    //Get company admin ID 
    

    //Show return URL
    die();
ShowReURL:
    echo '<br /><a href="'.$_SESSION["Send_Message_Return_URL"].'">Click here to return</a><br />';
    die();
?>

</body></html>