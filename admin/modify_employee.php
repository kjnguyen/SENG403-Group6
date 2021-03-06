<?php
    define("INCLUDE_FILE", true);
    include('header.php');
    
    //Do not output anything before this line (Do not use echo or html code)
    //---------------------------------------------------
?>

<?php 
        define("modify_employee_utils.php", True);
        include_once 'modify_employee_utils.php';
        $ID = $_POST['ID'];
        if (!$ID) {
             $ID = $_GET['ID'];
         }
        $permission = check_permission($ID);
        if ($permission != 1){
                printf("<script>location.href='bad_permission.php'</script>");
        }

?>


<div>
        <ul class="breadcrumb">
                <li>
                        <a href="index.php">Home</a> <span class="divider">/</span>
                </li>
                <li>
                  <a href="#"><b>Modify Employee</b></a>
                </li>
        </ul>
</div>


<?php
        if (isset($_POST['process_delete'])) {
            // do delete instead of modify
            if(!defined("modify_employee_utils.php")) {define("modify_employee_utils.php", True);}
            include_once 'modify_employee_utils.php';


            $id = $_POST['ID'];

            $success = True;
            if (!isset($id)) {
                echo '<div class="alert alert-error">ERROR: <br> Unable to process your request</div>';
                $success = False;
                goto EXEFinished; 
            }


            $success = delete_employee_secure($id);
            if(!$success){
                echo '<div class="alert alert-error">ERROR: <br> Database operation failed</div>';
                goto EXEFinished;
            }	

            echo '<div class="alert alert alert-success">';
            echo 'Employee successfully deleted';
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

            include_once "footer.php";
            exit();
        }
?>







<div class="row-fluid sortable">
        <div class="box span12">
                <div class="box-header well" data-original-title>
                        <h2><i class="icon-picture"></i>Modify Employee</h2>

                </div>
                <div class="box-content">
                        <form name="Modify" method="post" action="modify_employee_results.php" enctype="multipart/form-data" class="form-horizontal" >
                                <fieldset>

<?php
	if(!defined("modify_employee_utils.php")) {define("modify_employee_utils.php", True);}
	include_once 'modify_employee_utils.php';
	$ID = $_POST['ID'];
	if (!$ID) {
	$ID = $_GET['ID'];
	}
	$item = search_one_item($ID);


      echo '
<div class="control-group"><label class="control-label" for="focusedInput">ID: </label><div class="controls"> <input class="input-xlarge disabled" id="disabledInput" value="'.$ID.'" disabled/></div></div>
<div class="control-group"><label class="control-label" for="focusedInput">Agent Name: </label><div class="controls"><input type="text" name="name" value="'.$item['name'].'"/></div></div>
<div class="control-group"><label class="control-label" for="focusedInput">Phone Number: </label><div class="controls"><input type="text" name="phone_no" value="'.$item['phone_no'].'"/></div></div>
<div class="control-group"><label class="control-label" for="focusedInput">Email: </label><div class="controls"><input type="text" name="email" value="'.$item['email'].'"/></div></div>
<div class="control-group"><label class="control-label" for="focusedInput">Username: </label><div class="controls"><input type="text" name="username" value="'.$item['username'].'"/></div></div>

';
//<div class="control-group"><label class="control-label" for="focusedInput">Password: </label><div class="controls"><input type="text" name="password" value="'.$item['password'].'"/></div></div>

echo '
<input type="hidden" name="ID" value="'.$ID.'"/>
';
?>
</select></p>

					<div class="form-actions">
                        <button class="btn btn-primary" type="submit" value="Modify" class="button">Modify</button>
                    </div>
               </fieldset>
            </form>

        </div>
    </div>
</div>

<?php
    include('footer.php');
?>
