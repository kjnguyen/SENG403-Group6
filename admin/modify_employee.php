<?php
    define("INCLUDE_FILE", true);
    include('header.php');
    
    //Do not output anything before this line (Do not use echo or html code)
    //---------------------------------------------------
?>

<?php /*
        define("modify_employee_utils.php", True);
        include_once 'modify_utils.php';
        $ID = $_POST['ID'];
        if (!$ID) {
             $ID = $_GET['ID'];
         }
        $permission = check_permission($ID);
        if ($permission != 1){
                printf("<script>location.href='bad_permission.php'</script>");
        }
*/
?>


<div>
        <ul class="breadcrumb">
                <li>
                        <a href="index.php">Home</a> <span class="divider">/</span>
                </li>
                <li>
                  <a href="#"><b>Modify Listing</b></a>
                </li>
        </ul>
</div>


<div class="row-fluid sortable">
        <div class="box span12">
                <div class="box-header well" data-original-title>
                        <h2><i class="icon-picture"></i>Modify Listing</h2>

                </div>
                <div class="box-content">
                        <form name="Modify" method="post" action="modify_results.php" enctype="multipart/form-data" class="form-horizontal" >
                                <fieldset>

<?php
	define("search_utils.php", True);
	include_once '../search_utils.php';
	$ID = $_POST['ID'];
	if (!$ID) {
	$ID = $_GET['ID'];
	}
	$item = search_one_item($ID);


      echo '
<div class="control-group"><label class="control-label" for="focusedInput">ID: </label><div class="controls"> <input class="input-xlarge disabled" id="disabledInput" value="'.$ID.'" disabled/></div></div>
<div class="control-group"><label class="control-label" for="focusedInput">Agent Name: </label><div class="controls"><input type="text" name="name" value="'.$item['name'].'"/></div></div>
<div class="control-group"><label class="control-label" for="focusedInput">Phone Number: </label><div class="controls"><input type="text" name="phone_no" value="'.$item['phone_no'].'"/></div></div>
<div class="control-group"><label class="control-label" for="focusedInput">Permission: </label><div class="controls"><input type="text" name="permission" value="'.$item['permission'].'"/></div></div>
<div class="control-group"><label class="control-label" for="focusedInput">Username: </label><div class="controls"><input type="text" name="username" value="'.$item['username'].'"/></div></div>
<div class="control-group"><label class="control-label" for="focusedInput">Password: </label><div class="controls"><input type="text" name="password" value="'.$item['password'].'"/></div></div>
';
echo '
<input type="hidden" name="ID" value="'.$ID.'"/>
';
?>
</select></p>

					<div class="form-actions">
                        <button class="btn btn-primary" type="submit" value="Modify" class="button">Modify</button>
                    </div>




<?php
    include('footer.php');
?>
