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
                        <a href="#"><b>Create a new listing</b></a>
					</li>
				</ul>
			</div>

			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-picture"></i>Create a new listing</h2>

					</div>
					<div class="box-content">
<form class="form-horizontal" name="create_listing" method="post" action="process_create.php">
                                            <div class="control-group">
						
<label class="control-label" for"tyeahead">Price</label>
	<div class="controls">
		<input id="price" name="price" type="text"</input>
	</div>
</div>
<div class="control-group">
	<label class="control-label" for"tyeahead">Square Feet</label>
	<div class="controls">
		<input id="square_feet" name="sq_ft" type="text"</input>
	</div>
</div>
<div class="control-group">
	<label class="control-label" for"tyeahead">Number of Floors</label>
	<div class="controls">
		<input id="num_floors" name="num_floors" type="text"</input>
	</div>
</div>
<div class="control-group">
	<label class="control-label" for"tyeahead">Number of Bedrooms</label>
	<div class="controls">
		<input id="num_bdrms" name="num_bdrms" type="text"</input>
	</div>
</div>
<div class="control-group">
	<label class="control-label" for"tyeahead">Year Built</label>
	<div class="controls">
		<input id="year_built" name="year_built" input-xlarge focused" type="text"</input>
	</div>
</div>
<div class="control-group">
	<label class="control-label" for"tyeahead">Property Type</label>
	<div class="controls">
		<input id="prop_type" name="prop_type" input-xlarge focused" type="text"</input>
	</div>
</div>
<div class="control-group">
	<label class="control-label" for"tyeahead">Building Type</label>
	<div class="controls">
		<input id="Bldg_Type" name="bldg_type" input-xlarge focused" type="text"</input>
	</div>
</div>
<div class="control-group">
	<label class="control-label" for"tyeahead">District</label>
	<div class="controls">
		<input id="district" name="district" input-xlarge focused" type="text"</input>
	</div>
</div>
<div class="control-group">
	<label class="control-label" for"tyeahead">City</label>
	<div class="controls">
		<input id="city" name="city" input-xlarge focused" type="text"</input>
	</div>
</div>
 <div class="control-group">
	<label class="control-label" for"tyeahead">Province</label>
	<div class="controls">
		<input id="city" name="province" input-xlarge focused" type="text"</input>
	</div>
</div>
<div class="control-group">
	<label class="control-label" for"tyeahead">Maintenance Fee</label>
	<div class="controls">
		<input id="maintenance_fee" name="maintenance_fee" input-xlarge focused" type="text"</input>
	</div>
</div>
<div class="control-group">
	<label class="control-label" for"tyeahead">Status</label>
	<div class="controls">
		<input id="status" name="status" input-xlarge focused" type="text"</input>
	</div>
</div>
<div class="control-group">
	<label class="control-label" for"tyeahead">Number of Bathrooms</label>
	<div class="controls">
		<input id="num_baths" name="num_baths" input-xlarge focused" type="text"</input>
	</div>
</div>
<div class="control-group">
	<label class="control-label" for"tyeahead">Address</label>
	<div class="controls">
		<input id="address" name="address" input-xlarge focused" type="text"</input>
	</div>
</div>
<div class="control-group">
	<label class="control-label" for"tyeahead">Description</label>
	<div class="controls">
            <textarea type="textarea" name="description" rows="3" style="width: 500px; height: 197px;"></textarea>
<!--		<input id="description" name="description" input-xlarge focused" type="text"</input>-->
	</div>
</div>
  
  <!--<script type="text/javascript">
    
    function addAnotherFileInput(fileInput)
    {
      var newFile = document.createElement("input");
      newFile.className = "input-file uniform_on";
      newFile.name = "files[]";
      newFile.type = "file";
      newFile.onchange = "addAnotherFileInput(this);";
      
      var newDiv = document.createElement("div");
      newDiv.className = "controls";
      newDiv.appendChild(newFile);
      
      fileInput.parentNode.parentNode.appendChild(newDiv);
    }
  </script>-->
  
  <!-- Add pictures -->
  <div class="control-group">
    <hr/>
    <label class="control-label">Add Pictures</label>
    <div class="controls">
      <input class="input-file uniform_on" name="files[]" type="file">
    </div>
    <div class="controls">
      <input class="input-file uniform_on" name="files[]" type="file">
    </div>
    <div class="controls">
      <input class="input-file uniform_on" name="files[]" type="file">
    </div>
    <h6>Accepted formats: *.jpeg, *.jpg, *.png, *.bmp, *.gif</h6>

    <div id="picMsg"></div>
    <br/>
    <div>
      Currently only 3 pictures can be displayed.
    </div>
  </div>
    <input type="hidden" name="process_add_listing" value='true'>
    <?php echo '<input type="hidden" name="compID" value='.$_POST['compID'].'>'; ?>
		<div class="form-actions">
			<button class="btn btn-primary" type="submit" class="button">Create</button>
                        <a href="index.php" class="btn">Cancel</a>
		</div>
    </form>
	</div>			
		</div>
                            
	</div><!--/span-->
        
<?php
    include('footer.php');
?>
