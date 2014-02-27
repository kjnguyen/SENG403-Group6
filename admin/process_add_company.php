<?php
    define("INCLUDE_FILE", true);
    include('header.php');
    
    //Do not output anything before this line (Do not use echo or html code)
    //---------------------------------------------------
?>
<?php
if ($_SESSION['Authed_Permission'] != 1) {
    echo "permission denied";
    die();
}
?>


<div>
    <ul class="breadcrumb">
        <li>
            <a href="#">Home</a> <span class="divider">/</span>
        </li>
        <li>
            <a href="#">Blank</a>
        </li>
    </ul>
</div>
<?php

define("add_utils.php", True);
include_once 'add_utils.php';

if($_POST['process_add_company'] == 'true') {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $description = $_POST['description'];
    $manager_name = $_POST['manager_name'];
    $phone_no = $_POST['phone_no'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $username = $_POST['username'];

//        echo $name.'<br>';
//        echo $address.'<br>';
//        echo $description;
//        echo $manager_name;
//        echo $phone_no;
//        echo $email;
//        echo $password;
//        echo $username;
    $success = True;
    if ($error_msg = is_input_invalid($name, $phone_no, $email, $password, $username)) {
        echo '<div class="alert alert-error">'.$error_msg.'</div>';
        $success = False;
        goto EXEFinished; 
    }
    
    
    add_company($name, $address, $description, $manager_name, $phone_no, $email, $password, $username);
    echo '<div class="alert alert alert-success">';
    echo 'Company successfully added';
    echo '</div>';
    
EXEFinished:
    
    if ($success) {
        echo '<a href="index.php" class="btn btn-info">Go Back</a>';
    }
    else {
        echo
        '<script>
function goBack()
  {
  window.history.back()
  }
</script>


<button onclick="goBack()">Go Back</button>
';
    }
}


/**
 * 
 * @param type $name - required
 * @param type $phone_no - required
 * @param type $email - required and unique
 * @param type $password - required
 * @param type $username - required and unique
 */
function is_input_invalid($name, $phone_no, $email, $password, $username) {
    $valid = True;
    $error_msg = "";
    if (!$name) {
        $valid = False;
        $error_msg .= 'Company Name is required<br>';
    }
    if (!$phone_no) {
        $valid = False;
        $error_msg .= 'Phone Number is required<br>';
    }
    if (!$password) {
        $valid = False;
        $error_msg .= 'Password is required<br>';
    }
    if (!$email) {
        $valid = False;
        $error_msg .= 'Email is required<br>';
    }
    else {
        if (!email_unique($email))  {
            $valid = False;
            $error_msg .= 'Email is already in use<br>';
        }
    }
    
    if (!$username) {
        $valid = False;
        $error_msg .= 'Username is required<br>';
    }
    else {
        if (!username_unique($username))  {
            $valid = False;
            $error_msg .= 'Username is already in use<br>';
        }
    }
    
    if (!$valid) {
        return $error_msg;
    }
    return NULL;
}
?>
