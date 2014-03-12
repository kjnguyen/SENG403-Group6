<?php
    define("INCLUDE_FILE", true);
    include('header.php');
    
    //Do not output anything before this line (Do not use echo or html code)
    //---------------------------------------------------
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
						<h2><i class="icon-picture"></i>Create Employee Account</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<div class="control-group">
						
<label class="control-label" for"tyeahead">Agent Name</label>
	<div class="controls">
		<input id="agent_name" name="agent_name" type="text"</input>
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
	<label class="control-label" for"tyeahead">Permission</label>
	<div class="controls">
		<input id="permission" name="permission" type="text"</input>
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

	</div>
	<input type="hidden" name="process_add_emp" value='true'>
		<div class="form-actions">
			<button class="btn btn-primary" type="submit" value="Create">Create</button>
		</div>

						
		</div>
	</div><!--/span-->
			
</div><!--/row-->



    
<?php
    include('footer.php');
?>
