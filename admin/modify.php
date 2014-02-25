<?php
    define("INCLUDE_FILE", true);
    include('header.php');
    
    //Do not output anything before this line (Do not use echo or html code)
    //---------------------------------------------------
?>

			<?php 
				define("modify_utils.php", True);
				include_once 'modify_utils.php';
				$permission = check_permission($_POST['ID']);
				if ($permission != 1){
					printf("<script>location.href='bad_permission.php'</script>");
				}
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
						<form name="Modify" method="post" action="modify_results.php" id="contacts-form" style="font-size: 80%;" enctype="multipart/form-data">
							<fieldset>
								<div class="control-group">
							
										 <?php
                                                                                 define("search_utils.php", True);
                                                                                 include_once '../search_utils.php';
                                                                                 $ID = $_POST['ID'];
                                                                                 $item = search_one_item($ID);
											       // echo "
											      // <p><label>ID number(required): </label><input type=\"text\" name=\"ID\" value=\"".$_GET['ID']."\"/></a></p>
											      // <p><label>Company ID: </label><input type=\"text\" name=\"CompID\" value=\"".$_GET['CompID']."\"/></p>
										//	
                                                                                 // ID and CompID should not be modifiable
											      echo "
											<p><input type=\"hidden\" name=\"ID\" value=\"".$ID."\"/></p>
											<p><label>Company ID: </label><input type=\"hidden\" name=\"CompID\" value=\"".$_POST['CompID']."\"/></p>
											<p><label>Price: </label><input type=\"text\" name=\"price\" value=\"".$item['price']."\"/></p>
											<p><label>Square Feet: </label><input type=\"text\" name=\"sq_ft\" value=\"".$item['sq_ft']."\"/></p>
											<p><label>Number of Floors: </label><input type=\"text\" name=\"num_floors\" value=\"".$item['num_floors']."\"/></p>
											<p><label>Number of Bedrooms: </label><input type=\"text\" name=\"num_bdrms\" value=\"".$item['num_bdrms']."\"/></p>
											<p><label>Number of Bathrooms: </label><input type=\"text\" name=\"num_baths\" value=\"".$item['num_baths']."\"/></p>
											<p><label>Year Built: </label><input type=\"text\" name=\"year_built\" value=\"".$item['year_built']."\"/></p>
											<p><label>Property Type: </label><input type=\"text\" name=\"prop_type\" value=\"".$item['prop_type']."\"/></p>
											<p><label>Building Type: </label><input type=\"text\" name=\"bldg_type\" value=\"".$item['bldg_type']."\"/></p>
											<p><label>District: </label><input type=\"text\" name=\"district\" value=\"".$item['district']."\"/></p>
											<p><label>Maintenance: </label><input type=\"text\" name=\"maintenance_fee\" value=\"".$item['maintenance_fee']."\"/></p>
											<p><label>Address: </label><input type=\"text\" name=\"address\" value=\"".$item['address']."\"/></p>
											<p><label>Description: </label><input type=\"textarea\" name=\"description\" value=\"".$item['description']."\"/></p>
											"
										 ?>
										  <p><label>Status: </label>
										    <select name="status">
										        <?php
										        define("modify_utils.php", True);
										        include_once 'modify_utils.php';
										        $status = modify_list_of_status();
										        if(!empty($status)) {
										            $selected = $item['status'];
										            foreach ($status as $s) {
										                echo "<option value=\"".$s['status']."\"";
										                if ($s['status'] == $selected) {
										                    echo " selected=\"selected\"";
										                }
										                echo ">".$s['status']."</option>";
										            }
										        }
										        ?>
										    </select></p>
                                            <?php include_once './pictures.php'; ?>
									</div>
									<div class="form-actions">
									<button class="btn btn-primary" type="submit" value="Modify" class="button">Modify</button>
								</div>
							</fieldset>
						</form>
					</div>
				</div><!--/span-->
			
			</div><!--/row-->

    
<?php
    include('footer.php');
?>
