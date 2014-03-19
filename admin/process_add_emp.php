<?php
    define("INCLUDE_FILE", true);
    include('header.php');
    
    //Do not output anything before this line (Do not use echo or html code)
    //---------------------------------------------------
?>



<div>
    <ul class="breadcrumb">
        <li>
            <a href="../">Home</a> <span class="divider">/</span>
        </li>
        <li>
            <a href="./add_company.php">Add an Employee</a> <span class="divider">/</span>
        </li>
        <li>
          <a href ="#"><b>Confirmation</b></a>
        </li>
    </ul>
</div>

<?php
if ($_SESSION['Authed_Permission'] != 2) {
    echo "permission denied";
    goto EXEFinished; 
}

if(!defined("empcreatefunc.php")) {define("empcreatefunc.php", True);}
include_once 'empcreatefunc.php';
if(!defined("add_utils.php")) {define("add_utils.php", True);}
include_once 'add_utils.php';

if($_POST['process_add_emp'] == 'true') {
    $compID = $_POST['compID'];
    $employee_name = $_POST['employee_name'];
    $phone_no = $_POST['phone_no'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cmf_password = $_POST['Cfm_Password'];
	
	$success = True;
    if ($error_msg = is_emp_input_invalid($employee_name, $phone_no, $email, $username, $password, $cmf_password)) {
        echo '<div class="alert alert-error">ERROR: <br>'.$error_msg.'</div>';
        $success = False;
        goto EXEFinished; 
    }
    $success = create_emp_secure($compID, $employee_name, $phone_no, $email, $username, $password);
    if (!$success) {
        echo '<div class="alert alert-error">ERROR: <br> Database operation failed</div>';
        goto EXEFinished;
        
    }
    echo '<div class="alert alert alert-success">';
    echo 'Employee successfully added';
    echo '</div>';

EXEFinished:
    
    if ($success) {
        echo '<a href="index.php" class="btn btn-info">Go Back</a>';
    }
    else {
//        echo
//        '<script>
//        function goBack()
//          {
//          window.history.back()
//          }
//        </script>
//        <button class="btn btn-info" onclick="goBack()">Go Back</button>
//        ';
        echo '<a href="index.php" class="btn btn-info">Go Back to Home Page</a>';
    }
}

function is_emp_input_invalid($employee_name, $phone_no, $email, $username, $password, $cmf_password) {
    $valid = True;
    $error_msg = "";

    if (!$employee_name) {
        $valid = False;
        $error_msg .= '* Employee Name is required<br>';
    }
	
    if (!$phone_no) {
        $valid = False;
        $error_msg .= '* Phone Number is required<br>';
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
    if (!$valid) {
        return $error_msg;
    }
	
    return NULL;
}
?>
<?php
    include('footer.php');
?>