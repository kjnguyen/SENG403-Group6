<?php
    define("INCLUDE_FILE", true);
    include('header.php');
    
    //Do not output anything before this line (Do not use echo or html code)
    //---------------------------------------------------
?>

<!-- *****************************************************************************-->

			<div>
				<ul class="breadcrumb">
					<li>
						<a href="index.php">Home</a> <span class="divider">/</span>
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
						 <?php
                                                 
                                                    define("modify_utils.php", True);
                                                    include_once 'modify_utils.php';
                                              
                                                
                                                    $id = $_POST['ID'];
                                                    $CompID = $_POST['CompID'];
                                                    $price = $_POST['price'];
                                                    $sq_ft = $_POST['sq_ft'];                         
                                                    $num_floors = $_POST['num_floors'];
                                                    $num_bdrms = $_POST['num_bdrms'];
                                                    $num_baths = $_POST['num_baths'];
                                                    $year_built = $_POST['year_built'];
                                                    $prop_type = $_POST['prop_type'];
                                                    $bldg_type = $_POST['bldg_type'];
                                                    $district = $_POST['district'];
                                                    $maintenance_fee = $_POST['maintenance_fee'];
                                                    $status = $_POST['status'];  
                                                    $address = $_POST['address'];
                                                    $description = $_POST['description'];
                                                     
                                                    
                                                  /*  mysql_connect("$host","$user", "$pass")or die("cannot connect");  
                                                    mysql_select_db("$db")or die("cannot select DB");  */
                                                    

                                                    $results_array = modify_values($id,$CompID, $price, $sq_ft, $num_floors, 
                                                            $num_bdrms, $num_baths, $year_built, $prop_type, $bldg_type, 
                                                            $district, $maintenance_fee, $status, $address, $description);
                                                    if($results_array){
                                                    	echo "Error: An $results_array<br>";
                                                    }	
                                                    else{
	                                                    echo"Modifictions made";
	                                                    echo "<br>Values that were updated:";
	                                                    if($CompID){	
	    						    	echo "<br>Company ID: $CompID";
	                                                    }
	                                                    if($price){
	    						    	echo "<br>Price: $price";
	                                                    }
	                                                    if($sq_ft){
	    						    	echo "<br>Square Footage: $sq_ft";
	                                                    }
	                                                    if($num_floors){
	    						    	echo "<br>Number of Floors: $num_floors";
	                                                    }
	                                                    if($num_bdrms){
	    						    	echo "<br>Number of Bedrooms: $num_bdrms";
	                                                    }
	                                                    if($num_baths){
	    							 echo "<br>Number of Bathrooms: $num_baths";
	                                                    }
	                                                    if($year_built){
	    						    	echo "<br>Year Built: $year_built";
	                                                    }
	                                                    if($prop_type){
	    						    	echo "<br>Property Type: $prop_type";
	                                                    }
	                                                    if($bldg_type){
	    						    	echo "<br>Building Type: $bldg_type";
	                                                    }
	                                                    if($district){
	    						    	echo "<br>district: $district";
	                                                    }
	                                                    if($maintenance_fee){
	    						    	echo "<br>Maintenance Fees: $maintenance_fee";
	                                                    }
	                                                    if($status){
	    						    	echo "<br>Status: $status";
	                                                    }
	                                                    if($address){
	    						    	echo "<br>Address: $address";
	                                                    }
	                                                    if($description){
	    						    	echo "<br>Description: $description";
	                                                    }
                                                    }
                                                    
                                                    include_once './pictureUploader.php';
                                                ?>
					</div>
				</div><!--/span-->
			
			</div><!--/row-->



<?php
    include_once "footer.php";
?>
