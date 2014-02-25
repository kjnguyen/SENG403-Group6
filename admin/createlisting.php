<?php
    define("INCLUDE_FILE", true);
    include('header.php');
    
    //Do not output anything before this line (Do not use echo or html code)
    //---------------------------------------------------
?>

<legend>
	Post Listing
</legend>
<div class="control-group">
	<label class="control-label" for"tyeahead">Price</label>
	<div class="controls">
		<input id="price" class="input-xlarge focused" type="text"</input>
	</div>
</div>
<div class="control-group">
	<label class="control-label" for"tyeahead">Square Feet</label>
	<div class="controls">
		<input id="square_feet" class="input-xlarge focused" type="text"</input>
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
		<input id="num_bdrms" class="input-xlarge focused" type="text"</input>
	</div>
</div>
<div class="control-group">
	<label class="control-label" for"tyeahead">Square Feet</label>
	<div class="controls">
		<input id="square_feet" class="input-xlarge focused" type="text"</input>
	</div>
</div>

			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Blank</a>
					</li>
				</ul>
			</div>

			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-picture"></i>Blank</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						
					</div>
				</div><!--/span-->
			
			</div><!--/row-->

    
<?php
    include('footer.php');
?>
