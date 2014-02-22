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
                                               ?> 
                                               
                                                <form name="Modify" method="get" action="modify_results.php" id="contacts-form" style="position: absolute; top: 0px; font-size: 80%;">
                                               
                                                <fieldset>
						    <legend>Modify Criteria</legend><br>
						        <?php
						        echo "
						        <p><label>ID number(required): </label><input type=\"text\" name=\"ID\" value=\"".$_GET['ID']."\"/></a></p>
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
						        <p><label>Maintenance: </label><input type=\"text\" maintenance=\"city\" value=\"".$_GET['maintenance']."\"/></p> 
						        <p><label>Address: </label><input type=\"text\" name=\"address\" value=\"".$_GET['address']."\"/></p>    
						        <p><label>Description: </label><input type=\"text\" name=\"description\" value=\"".$_GET['description']."\"/></p>    
						
						         "
						         ?>
						    <p>Status:
						    <select name="status">
						        <?php
						        define("modify_utils.php", True);
						        include_once 'modify_utils.php';
						        $status = modify_list_of_status();
						        echo "<option value=\"\">Any</option>";
						        if(!empty($status)) {
						            $selected = $_GET['status'];
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
						    <p><button type="reset" value="Reset" class="button">Reset</button> <button type="submit" value="Modify" class="button">Modify</button></p>
						</fieldset>
                                                
                                                </form>
                                                <?php
                                                
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
