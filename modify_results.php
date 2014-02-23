<?php
    include_once "header.php";
?>

	<!-- content -->
	<section id="content">
		<div class="container_16">
			<div class="clearfix">
				<section id="mainContent" class="grid_10" style="position: relative; width: 100%;">
					<article style="position: relative; width: 100%;">
						<h2>Modify listing</h2>
                                               <div id="faded" style="position: relative; width: 100%;"> 
                                               
                                                <?php
                                                 
                                                    define("modify_utils.php", True);
                                                    include_once 'modify_utils.php';
                                              
                                                
                                                    $id = $_GET['ID'];
                                                    $CompID = $_GET['CompID'];
                                                    $price = $_GET['price'];
                                                    $sq_ft = $_GET['sq_ft'];                         
                                                    $num_floors = $_GET['num_floors'];
                                                    $num_bdrm = $_GET['num_bdrm'];
                                                    $num_baths = $_GET['num_baths'];
                                                    $year_built = $_GET['year_built'];
                                                    $prop_type = $_GET['prop_type'];
                                                    $bldg_type = $_GET['bldg_type'];
                                                    $district = $_GET['district'];
                                                    $maintenance_fee = $_GET['maintenance_fee'];
                                                    $status = $_GET['status'];  
                                                    $address = $_GET['address'];
                                                    $description = $_GET['description'];
                                                     
                                                    
                                                  /*  mysql_connect("$host","$user", "$pass")or die("cannot connect");  
                                                    mysql_select_db("$db")or die("cannot select DB");  */
                                                    

                                                    $results_array = modify_values($id, $CompID, $price, $sq_ft, $num_floors, 
                                                            $num_bdrm, $num_baths, $year_built, $prop_type, $bldg_type, 
                                                            $district, $maintenance, $status, $address, $description);
                                                    
                                                    echo"Modifiction Sent!";
                                                    echo "<br>Values that were updated:"
    						    echo "<br>ID = $id";
    						    echo "<br>Company ID = $CompID";
    						    echo "<br>Price = $price";
    						    echo "<br>Square Footage = $sq_ft";
    						    echo "<br>Number of Floors = $num_floors";
    						    echo "<br>Number of Bedrooms = $num_bdrm";
    						    echo "<br>Number of Bathrooms = $num_baths";
    						    echo "<br>Year Built = $year_built";
    						    echo "<br>Property Type = $prop_type";
    						    echo "<br>Building Type = $bldg_type";
    						    echo "<br>district = $district";
    						    echo "<br>Maintenance Fees = $maintenance_fee";
    						    echo "<br>Status = $status";
    						    echo "<br>Address = $address";
    						    echo "<br>Description = $description";
    						    
    				
                                                ?>
                                                
						</div>
                            		
					</article>
				</section>
			</div>
		</div>
	</section>
<?php
    include_once "footer.php";
?>
