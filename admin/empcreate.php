<?php
    define("INCLUDE_FILE", true);
    include('header.php');
    
    //Do not output anything before this line (Do not use echo or html code)
    //---------------------------------------------------
?>

<?php
if ($_SESSION['Authed_Permission'] != 1) {
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
						<label class="control-label" for"focusedInput">Agent Name</label>
						<div class="controls">
						<input class="input-xlarge focuse" id="agent_name" name="agent_name" type="text"</input>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for"tyeahead">Phone Number</label>
						<div class="controls">
						<input id="phone_no" name="phone_no" type="text"</input>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for"tyeahead">Email</label>
						<div class="controls">
						<input id="email" name="email" type="text"</input>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for"tyeahead">Username</label>
						<div class="controls">
						<input id="username" name="username" input-xlarge focused" type="text"</input>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for"tyeahead">Password</label>
						<div class="controls">
						<input id="password" name="password" input-xlarge focused" type="text"</input>
						</div>
					</div>

					<input type="hidden" name="process_add_emp" value='true'>
			<div class="form-actions">
				<button type="submit" class="btn btn-primary">Create</button>
				<a href="index.php class="btn">Cancel</a>
			</div>
				</fieldset>
			</form>

						
		</div>
	</div><!--/span-->
			
</div><!--/row-->



    
<?php
    include('footer.php');
?>
