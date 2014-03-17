<?php
    define("INCLUDE_FILE", true);
    include('header.php');
    
    //Do not output anything before this line (Do not use echo or html code)
    //---------------------------------------------------
?>



<div>
    <ul class="breadcrumb">
        <li>
          <a href="./">Home</a> <span class="divider">/</span>
        </li>
        <li>
            <a href="./add_company.php">Add a Company</a> <span class="divider">/</span>
        </li>
        <li>
          <a href ="#"><b>Confirmation</b></a>
        </li>
    </ul>
</div>
<?php
if ($_SESSION['Authed_Permission'] != 1) {
    echo "permission denied";
    goto EXEFinished; 
}


if(!defined("add_utils.php")) {define("add_utils.php", True);}
include_once 'add_utils.php';

if($_POST['process_add_company'] == 'true') {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $description = $_POST['description'];
    $manager_name = $_POST['manager_name'];
    $phone_no = $_POST['phone_no'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cmf_password = $_POST['Cfm_Password'];
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
    if ($error_msg = is_input_invalid($name, $phone_no, $email, $password, $cmf_password, $username)) {
        echo '<div class="alert alert-error">ERROR: <br>'.$error_msg.'</div>';
        $success = False;
        goto EXEFinished; 
    }
    
    
    $success = add_company_secure($name, $address, $description, $manager_name, $phone_no, $email, $password, $username);
    if (!$success) {
        echo '<div class="alert alert-error">ERROR: <br> Database operation failed</div>';
        goto EXEFinished;
        
    }
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
        <button class="btn btn-info" onclick="goBack()">Go Back</button>
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
function is_input_invalid($name, $phone_no, $email, $password, $cmf_password, $username) {
    $valid = True;
    $error_msg = "";
    if (!$name) {
        $valid = False;
        $error_msg .= '* Company Name is required<br>';
    }
    if (!$phone_no) {
        $valid = False;
        $error_msg .= '* Phone Number is required<br>';
    }
    if (!$password) {
        $valid = False;
        $error_msg .= '* Password is required<br>';
    }
    else {
        if ($cmf_password != $password) {
            $valid = False;
            $error_msg .= '* Password Mismatch<br>';
        }
    }
    if (!$email) {
        $valid = False;
        $error_msg .= '* Email is required<br>';
    }
    else {
        if (!email_unique($email))  {
            $valid = False;
            $error_msg .= '* Email is already in use<br>';
        }
        else {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $valid = False;
                $error_msg .= "* $email is not a valid Email<br>";
            }
        }
    }
    
    if (!$username) {
        $valid = False;
        $error_msg .= '* Username is required<br>';
    }
    else {
        if (!username_unique($username))  {
            $valid = False;
            $error_msg .= '* Username is already in use<br>';
        }
    }
    
    if (!$valid) {
        return $error_msg;
    }
    return NULL;
}
?>
<?php
    include('footer.php');
?>
