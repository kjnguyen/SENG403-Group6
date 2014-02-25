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
						<h2><i class="icon-picture"></i>Modify Listing</h2>
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
								   <p>ID Number:
									    <select name="ID">
									        <?php
									        define("modify_utils.php", True);
									        include_once 'modify_utils.php';
									        $id = get_list_of_id();
									        if(!empty($id)) {
									            $selected = $_GET['ID'];
									            foreach ($id as $i) {
									                echo "<option value=\"".$i['ID']."\"";
									                if ($i['ID'] == $selected) {
									                    echo " selected=\"selected\"";
									                }
									                echo ">".$i['ID']."</option>";
									            }
									        }
									        ?>
									    </select></p>
										 <?php
											       // echo "
											      // <p><label>ID number(required): </label><input type=\"text\" name=\"ID\" value=\"".$_GET['ID']."\"/></a></p>
											      // <p><label>Company ID: </label><input type=\"text\" name=\"CompID\" value=\"".$_GET['CompID']."\"/></p>
											
											      echo "
											<p><label>Company ID: </label><input type=\"text\" name=\"CompID\" value=\"".$_GET['CompID']."\"/></p>
											<p><label>Price: </label><input type=\"text\" name=\"price\" value=\"".$_GET['price']."\"/></p>
											<p><label>Square Feet: </label><input type=\"text\" name=\"sq_ft\" value=\"".$_GET['sq_ft']."\"/></p>
											<p><label>Number of Floors: </label><input type=\"text\" name=\"num_floors\" value=\"".$_GET['num_floors']."\"/></p>
											<p><label>Number of Bedrooms: </label><input type=\"text\" name=\"num_bdrm\" value=\"".$_GET['num_bdrm']."\"/></p>
											<p><label>Number of Bathrooms: </label><input type=\"text\" name=\"num_baths\" value=\"".$_GET['num_baths']."\"/></p>
											<p><label>Year Built: </label><input type=\"text\" name=\"year_built\" value=\"".$_GET['year_built']."\"/></p>
											<p><label>Property Type: </label><input type=\"text\" name=\"prop_type\" value=\"".$_GET['prop_type']."\"/></p>
											<p><label>Building Type: </label><input type=\"text\" name=\"bldg_type\" value=\"".$_GET['bldg_type']."\"/></p>
											<p><label>District: </label><input type=\"text\" name=\"district\" value=\"".$_GET['district']."\"/></p>
											<p><label>Maintenance: </label><input type=\"text\" name=\"maintenance_fee\" value=\"".$_GET['maintenance_fee']."\"/></p>
											<p><label>Address: </label><input type=\"text\" name=\"address\" value=\"".$_GET['address']."\"/></p>
											<p><label>Description: </label><input type=\"text\" name=\"description\" value=\"".$_GET['description']."\"/></p>
											
											"
										 ?>
									</div>
									<div class="form-actions">
										<button class="btn btn-primary" type="submit">Modify</button>
								</div>
							</fieldset>
						</form>
					</div>
				</div><!--/span-->
			
			</div><!--/row-->

    
<?php
    include('footer.php');
?>
