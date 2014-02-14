<?php
    //Start session
    session_start();
    
    //Variable
    $email_usr = false; //Use to check username type
    
    //Call login function
    Login($_POST['username'], $_POST['password']);
    
    //Login function
    //Should receive username as input, and sha512 password as the 2nd input
    function Login($Username = null, $Password = null) {
        global $email_usr;
        //Check for valid inputs
        if ($Username == null || $Password == null) {
            ReturnToLoginPage(1);
        }
        
        //Check for valid username
        if (CheckUsername($Username) == 0) {
            ReturnToLoginPage(2);
        }
        
        CompareData($Username, $Password);
    }
    
    /*
     * CheckUsername function
     * Input: Username
     * Output: 0 = invalid, 1 = valid
     */
    function CheckUsername($Username) {
        global $email_usr;
        //Check for length and not NULL
        if($Username == null || strlen($Username) < 1 || strlen($Username) > 90) {
            return 0;
        }
        
        //Check for valid characters
        $resp = preg_match("/[^A-Za-z0-9@.]/", $Username);
        if ($resp > 0) {
            return 0;
        }
        
        //Check if it is email or username login
        $resp = preg_match("/[@.]/", $Username);
        if ($resp > 0) {
            $email_usr = true; //We detect @ and/or dot
            //Check for valid email address
            if (!filter_var($Username, FILTER_VALIDATE_EMAIL)) {
                return 0; //Invalid email address
            }
        }
        
        //Valid username!
        return 1;
    }
    
    /*
     * This function will match username and email with database
     * Input: $Username, $Passowrd ($Password should be in sha 512 format)
     */
    function CompareData($Username, $Password) {
        //Get global variable
        global $email_usr;
        if ($Username == null || $Password == null) {
            return 0;
        }
        
        //Encrypt password to cpmpare
        $Password = hash('sha512', $Password);
        
        //Make SQL connection
        include_once '../mysqlcon.php';
        $mysqlconn = getSQLConnection();
        
        //Prepare mysql stm
        $query = null;
        if ($email_usr == false) {
            @$query = $mysqlconn->prepare("SELECT ID, email, password, permission, username FROM User WHERE username=?");
        } else if ($email_usr == true) {
            @$query = $mysqlconn->prepare("SELECT ID, email, password, permission, username FROM User WHERE email=?");
        } else {
            return 0;
        }
        //Check prepare stm successful
        if (!$query) {
            @mysqli_close($mysqlconn);
            return 0;
        }
        
        //Bind variable
        @$query->bind_param('s', $Username);
        //Check bind successful
        if (!$query) {
            @mysqli_close($mysqlconn);
            return 0;
        }
        
        //Execute mysql
        @$query->execute();
        //Check execution successfull
        if (!$query) {
            @mysqli_close($mysqlconn);
            return 0;
        }
        
        //Fetch data
        $F_uID;
        $F_User;
        $F_Pass;
        $F_email;
        $F_Perm;
        $F_Count = 0;
        $query->bind_result($T_uID, $T_email, $T_Pass, $T_Perm, $T_User);
        while(@$query->fetch()) {
            $F_uID = $T_uID;
            $F_User = $T_User;
            $F_Pass = $T_Pass;
            $F_email = $T_email;
            $F_Perm = $T_Perm;
            $F_Count++;
        }
        
        //Check data
        if ($F_Count != 1 || $F_Pass != $Password) {
            return -1;
        }
        
        //Finish login set sessions
        $_SESSION['Authed_UserID'] = $F_uID;
        $_SESSION['Authed_Username'] = $F_User;
        $_SESSION['Authed_Email'] = $F_email;
        $_SESSION['Authed_Permission'] = $F_Perm;
        $_SESSION['Authed_Exipre'] = time() + 3600;
        
        echo $_SESSION['Authed_UserID'].' ||| '.$_SESSION['Authed_Username'].' ||| '.$_SESSION['Authed_Email'].' ||| '.$_SESSION['Authed_Permission'].' ||| '.$_SESSION['Authed_Exipre'];
    }
    
    /*
     * Redirect userback to login page
     * $ReturnID definition
     * 1 = Invalid function call, missing arugs?
     * 2 = Invalid username
     * 3 = 
     */
    
    function ReturnToLoginPage($ReturnID) {
        if ($ReturnID == null) {
            $ReturnID = 0;
        }
        header("location:./login.php?ReturnID=$ReturnID");
        die();
    }
?>