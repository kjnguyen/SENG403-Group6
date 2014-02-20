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
                                                <ul class="pagination" style="position: relative; top: 0px; left: 0px;">
                                                <?php
                                                    /*$host = "localhost";
                                                    $user = "localhost";
                                                    $pass = "";
                                                    $db = "test";
                                                    mysql_connect("$host", "$user", "$pass")or die("cannot connect");
                                                    mysql_select_db("$db")or die("cannot select DB");
                                                 */
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
                                                    
                                                    
    
                                                ?>
                                                </ul>
                                                </div>
					</article>
				</section>
			</div>
		</div>
	</section>

<?php
    include_once "footer.php";
?>