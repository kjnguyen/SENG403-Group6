<?php
    define("INCLUDE_FILE", true);
    include('header.php');
    
    //Do not output anything before this line (Do not use echo or html code)
    //---------------------------------------------------
?>
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Create Listing</a>
					</li>
				</ul>
			</div>

			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-picture"></i>Create Listing</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<div class="control-group">
						
	<label class="control-label" for"tyeahead">Price</label>
	<div class="controls">
		<input id="price" name="price" class="input-xlarge focused" type="text"</input>
	</div>
</div>
<div class="control-group">
	<label class="control-label" for"tyeahead">Square Feet</label>
	<div class="controls">
		<input id="square_feet" name="sq_ft" class="input-xlarge focused" type="text"</input>
	</div>
</div>
<div class="control-group">
	<label class="control-label" for"tyeahead">Number of Floors</label>
	<div class="controls">
		<input id="num_floors" name="num_floors" class="input-xlarge focused" type="text"</input>
	</div>
</div>
<div class="control-group">
	<label class="control-label" for"tyeahead">Number of Bedrooms</label>
	<div class="controls">
		<input id="num_bdrms" name="num_bdrms" class="input-xlarge focused" type="text"</input>
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
		<input id="description" name="description" input-xlarge focused" type="text"</input>
	</div>
</div>

<?php include_once './pictures.php'; ?>
									</div>
									<div class="form-actions">
									<button class="btn btn-primary" type="submit" value="Create" class="button">Create</button>
								</div>

						
					</div>
				</div><!--/span-->
			
			</div><!--/row-->



    
<?php
    include('footer.php');
?>
