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
						<form class="form-horizontal">
							<fieldset>
								<div class="control-group">
									<label class="control-label" for="focusedInput">Input 1</label>
									<div class="controls">
										<input id="focuesInput" class="input-xlarge focused" type="text"
										value="Input Value Here"></input>
									</div>
									<div class="form-actions">
										<button class="btn btn-primary" type="submit">Modify Listing</button>
								</div>
							</fieldset>
						</form>
					</div>
				</div><!--/span-->
			
			</div><!--/row-->

    
<?php
    include('footer.php');
?>
