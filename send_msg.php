<?php
    //Start session
    session_start();
    define("INCLUDE_FILE", true);
    //Start basic html output
?>
<html><head></head><body>

<?php
    //Check direct access
    if (isset($_SESSION['Send_Message']) && $_SESSION['Send_Message'] == 1) {
        unset($_SESSION['Send_Message']);
    } else {
        echo "No direct access and do not refresh the page<br />";
        die();
    }
    
    //Validate user inputs
    //Name
    if (!isset($_POST['SenderName']) || strlen($_POST['SenderName']) < 3 || strlen($_POST['SenderName']) > 64) {
        echo "Error: Invalid name length. Range: 3 to 64 characters.<br />";
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
    if (!isset($_SESSION["Send_Message_Targeted_Listing_ID"]) || !is_numeric($_SESSION["Send_Message_Targeted_Listing_ID"])) {
        echo "Error: Invalid company ID.<br />";
        goto ShowReURL;
    }
    
    //Retrieve company email from database
    include_once "./mysqlcon.php";
    $mysqlconn = getSQLConnection();
    $query = "";
    //Prepare
    @$query = $mysqlconn->prepare("SELECT u.email FROM User as u, Listing as l WHERE l.ID = ? AND l.CompID = u.ID");
    if (!$query) {
        echo "Error: Prepare stm failed.<br />";
        goto ShowReURL;
    }
    //Bind variables
    @$query->bind_param('i', $_SESSION["Send_Message_Targeted_Listing_ID"]);
    if (!$query) {
        echo "Error: Bind param stm failed.<br />";
        goto ShowReURL;
    }
    
    //Execute
    @$query->execute();
    if (!$query) {
        echo "Error: Execute stm failed.<br />";
        goto ShowReURL;
    }

    //Fetch data
    $F_Email = "";
    @$query->bind_result($T_Email);
    while(@$query->fetch()) {
        $F_Email = $T_Email;
    }
    
    //Check data fetched
    if (!filter_var($F_Email, FILTER_VALIDATE_EMAIL)) {
        echo "Error: Data fetch failed. Company Email: $F_Email<br />";
        goto ShowReURL;
    }
    
    //Call email function to send data
    include_once "./mail_func.php";
    $Message = 'Message from: '.$_POST['SenderName'].' ('.$_POST['SenderEmail'].')\n--------------------\n'.$_POST['Message'].'\n--------------------\n';
    Mail_Send($F_Email, "New message from customer - ".$_POST['SenderName'], $Message);
    
    echo 'Message successfully sent out. <br />';
    //Show return URL
ShowReURL:
    //Close mysql connection
    if (isset($mysqlconn) && ($mysqlconn != null || $mysqlconn = "")) {
        @mysqli_close($mysqlconn);
    }
    echo '<br /><a href="'.$_SESSION["Send_Message_Return_URL"].'">Click here to return</a><br />';
    die();
?>

</body></html>