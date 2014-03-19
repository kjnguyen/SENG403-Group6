<?php
    define("INCLUDE_FILE", true);
    include('header.php');
    
    //Do not output anything before this line (Do not use echo or html code)
    //---------------------------------------------------
?>

<?php
if (!isset($_POST['compID'])) {
    $permission = 0;
}
else
{
    if(!defined("postlisting.php")) {define("postlisting.php", True);}
    include_once 'postlistingfunc.php';
    $permission = check_createListing_permission($_POST['compID']);
    
}
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
            <a href="#"><b>Create Employee Account</b></a>
		</li>
	</ul>
</div>

<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-edit"></i>Create Employee Account</h2>
				
		</div>
		
		<div class="box-content">
			<form class="form-horizontal" name="emp_create" method="post" action="process_add_emp.php">
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="focusedInput">Employee Name</label>
						<div class="controls">
						<input class="input-xlarge focused" id="employee_name" name="employee_name" type="text"</input>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="focusedInput">Phone Number</label>
						<div class="controls">
						<input class="input-xlarge focused" id="phone_no" name="phone_no" type="text"</input>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="focusedInput">Email</label>
						<div class="controls">
						<input class="input-xlarge focused" id="email" name="email" type="text"</input>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="focusedInput">Username</label>
						<div class="controls">
						<input class="input-xlarge focused" id="username" name="username" class="input-xlarge focused" type="text"</input>
						</div>
					</div>
					<div class="control-group">
                                        <label class="control-label" for="focusedInput">Password</label>
                                        <div class="controls">
                                          <input class="input-xlarge focused" id="focusedInput" type="password" name="password" value="">
                                        </div>
                                      </div>
                                                                        <!--Confirm password-->
                                        <div class="control-group">
                                            <label class="control-label">Confirm Password: </label>
                                            <div class="controls">
                                        <input class="input-xlarge focused" id="focusedInput" type="password" name="Cfm_Password" value="">
                                        <p class="help-block">Please confirm your password!</p>
                                            </div>
                                        </div>

					<input type="hidden" name="process_add_emp" value='true'>
			<div class="form-actions">
                            <?php echo '<input type="hidden" name="compID" value='.$_POST['compID'].'>'; ?>
                    <button type="submit" class="btn btn-primary">Add</button>
                    <a href="index.php" class="btn">Cancel</a>
			</div>
				</fieldset>
			</form>

						
		</div>
	</div><!--/span-->
			
</div><!--/row-->



    
<?php
    include('footer.php');
?>
