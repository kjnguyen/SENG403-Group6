<?php
    define("INCLUDE_FILE", true);
    include('header.php');
    
    //Do not output anything before this line (Do not use echo or html code)
    //---------------------------------------------------
?>

<?php 
        define("modify_company_utils.php", True);
        include_once 'modify_company_utils.php';
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
                  <a href="#"><b>Modify Company</b></a>
                </li>
        </ul>
</div>


<?php
        if (isset($_POST['process_delete'])) {
            // do delete instead of modify
            if(!defined("modify_company_utils.php")) {define("modify_company_utils.php", True);}
            include_once 'modify_company_utils.php';


            $id = $_POST['ID'];

            $success = True;
            if (!isset($id)) {
                echo '<div class="alert alert-error">ERROR: <br> Unable to process your request</div>';
                $success = False;
                goto EXEFinished; 
            }


            $success = delete_company_secure($id);
            if(!$success){
                echo '<div class="alert alert-error">ERROR: <br> Database operation failed</div>';
                goto EXEFinished;
            }	

            echo '<div class="alert alert alert-success">';
            echo 'Company successfully deleted';
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
                        <h2><i class="icon-picture"></i>Modify Company</h2>

                </div>
                <div class="box-content">
                        <form name="Modify" method="post" action="modify_company_results.php" enctype="multipart/form-data" class="form-horizontal" >
                                <fieldset>

<?php
	define("modify_company_utils.php", True);
	include_once 'modify_company_utils.php';
	$ID = $_POST['ID'];
	if (!$ID) {
	$ID = $_GET['ID'];
	}
	$item = search_one_item($ID);


      echo '
<div class="control-group"><label class="control-label" for="focusedInput">ID: </label><div class="controls"> <input class="input-xlarge disabled" id="disabledInput" value="'.$ID.'" disabled/></div></div>
<div class="control-group"><label class="control-label" for="focusedInput">Agent Name: </label><div class="controls"><input type="text" name="name" value="'.$item['name'].'"/></div></div>
<div class="control-group"><label class="control-label" for="focusedInput">Address: </label><div class="controls"><input type="text" name="address" value="'.$item['address'].'"/></div></div>
<div class="control-group"><label class="control-label" for="focusedInput">Manager Name: </label><div class="controls"><input type="text" name="manager_name" value="'.$item['manager_name'].'"/></div></div>
<div class="control-group"><label class="control-label" for="focusedInput">Phone Number: </label><div class="controls"><input type="text" name="phone_no" value="'.$item['phone_no'].'"/></div></div>
<div class="control-group"><label class="control-label" for="focusedInput">Description: </label><div class="controls"><textarea type="textarea" name="description" rows="3" style="width: 500px; height: 197px;">'.$item['description'].'</textarea></div></div>
';
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
