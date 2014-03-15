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
          <a href ="#"><b>Modify Company Confirmation</b></a>
        </li>
    </ul>
</div>
 <?php

    if(!defined("modify_company_utils.php")) {define("modify_company_utils.php", True);}
    include_once 'modify_company_utils.php';


    $id = $_POST['ID'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $manager_name = $_POST['manager_name'];
    $phone_no = $_POST['phone_no'];
    $description = $_POST['description'];
   

    $success = True;
    if ($error_msg = is_modify_invalid($id, $name, $address, $manager_name, $phone_no, $description )) {
        echo '<div class="alert alert-error">ERROR: <br>'.$error_msg.'</div>';
        $success = False;
        goto EXEFinished; 
    }



    $success = modify_values_secure($id, $name, $address, $manager_name, $phone_no, $description);
    if(!$success){
        echo '<div class="alert alert-error">ERROR: <br> Company Database operation failed</div>';
        goto EXEFinished;
    }

    echo '<div class="alert alert alert-success">';
    echo 'Company successfully modified';
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
    function is_modify_invalid($id, $name, $address, $manager_name, $phone_no, $description) {
        $valid = True;
        $error_msg = "";
        if(!$id){
            $valid = False;
            $error_msg .= "* Missing Comapny ID<br>";
        }
        if(!$name){
            $valid = False;
            $error_msg .= "* Company name is required<br>";
        }
        if(!$phone_no){
            $valid = False;
            $error_msg .= "* Phone number is required<br>";
        }
        if(!$address){
            $valid = False;
            $error_msg .= "* Address is required<br>";
        }
        if(!$manager_name){
            $valid = False;
            $error_msg .= "* Manager name is required<br>";
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
