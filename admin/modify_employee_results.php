<?php
    define("INCLUDE_FILE", true);
    include('header.php');
    
    //Do not output anything before this line (Do not use echo or html code)
    //---------------------------------------------------
?>

<!-- *****************************************************************************-->
<div>
    <ul class="breadcrumb">
        <li>
            <a href="index.php">Home</a> <span class="divider">/</span>
        </li>
        <li>
          <a href ="#"><b>Modify Employee Confirmation</b></a>
        </li>
    </ul>
</div>
 <?php

    if(!defined("modify_employee_utils.php")) {define("modify_employee_utils.php", True);}
    include_once 'modify_employee_utils.php';


    $id = $_POST['ID'];
    $name = $_POST['name'];
    $phone_no = $_POST['phone_no'];                         
    //$permission = $_POST['permission'];
    $username = $_POST['username'];
    $password = $_POST['password'];
   

    $success = True;
    if ($error_msg = is_modify_invalid($id, $name, $phone_no,$username, $password )) {
        echo '<div class="alert alert-error">ERROR: <br>'.$error_msg.'</div>';
        $success = False;
        goto EXEFinished; 
    }



    $success = modify_values_secure($id, $name, $phone_no,$username, $password );
    if(!$success){
        echo '<div class="alert alert-error">ERROR: <br> Database operation failed</div>';
        goto EXEFinished;
    }	

    echo '<div class="alert alert alert-success">';
    echo 'Employee successfully modified';
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

    /**
     * Input validation function
     * @param type $id
     * @param type $name
     * @param type $phone_no
     * @param type $username
     * @param type $password
     * @return string|null
     */
    function is_modify_invalid($id, $name, $phone_no, $username, $password) {
        $valid = True;
        $error_msg = "";
        if(!$id){
            $valid = False;
            $error_msg .= "* Missing Employee ID<br>";
        }
        if(!$name){
            $valid = False;
            $error_msg .= "* Name is required<br>";
        }
        if(!$phone_no){
            $valid = False;
            $error_msg .= "* Phone number is required<br>";
        }
        if(!$username){
            $valid = False;
            $error_msg .= "* Username is required<br>";
        }
        if(!$password){
            $valid = False;
            $error_msg .= "* Password is required<br>";
        }
        if (!$valid) {
            return $error_msg;
        }
        return NULL;


    }
?>




<?php
    include_once "footer.php";
?>
