<!DOCTYPE html>
<html lang="en">
<head>
	<title></title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="template/css/reset.css" type="text/css" media="all">
	<link rel="stylesheet" href="template/css/grid.css" type="text/css" media="all">
	<link rel="stylesheet" href="template/css/style.css" type="text/css" media="all">
	<script type="text/javascript" src="template/js/jquery-1.4.2.min.js" ></script>
	<script type="text/javascript" src="template/js/cufon-yui.js"></script>
	<script type="text/javascript" src="template/js/Myriad_Pro_italic_400-Myriad_Pro_italic_600.font.js"></script>
	<script type="text/javascript" src="template/js/cufon-replace.js"></script>	
	<script type="text/javascript" src="template/js/jquery.faded.js"></script>
	<script type="text/javascript" src="template/js/script.js"></script>
	<!--[if lt IE 7]>
		<link rel="stylesheet" href="template/css/ie/ie6.css" type="text/css" media="screen">
		<script type="text/javascript" src="template/js/ie_png.js"></script>
		<script type="text/javascript">
				ie_png.fix('.png, .logo, .extra-banner');
		</script>
	<![endif]-->
	<!--[if lt IE 9]>
		<script type="text/javascript" src="template/js/html5.js"></script>
	<![endif]-->
</head>

<body>
	<!-- header -->
	<header>
		<div class="container_16">
			<div class="logo">
				<h1><a href="index.html"><strong>Real</strong> Estate</a></h1>
			</div>
			<nav>
				<ul>
					<li><a href="index.php">Home</a></li>
					<li><a href="index-1.html" class="current">Selling</a></li>
					<li><a href="index-2.html">Buying</a></li>
					<li><a href="index-3.html">Renting</a></li>
					<li><a href="modify.php">Moving</a></li>
					<li><a href="index-5.html">Finance</a></li>
					<li><a href="index-6.html">Contacts</a></li>
				</ul>
			</nav>
            
            <!-- From Jack: You will have change the listing here...-->
			<!-- faded slider begin -->
			<div id="faded">
				<div class="rap">
					<a href="#"><img src="images/big-img1.jpg" alt="" width="571" height="398"></a>
					<a href="#"><img src="images/big-img2.jpg" alt="" width="571" height="398"></a>
					<a href="#"><img src="images/big-img3.jpg" alt="" width="571" height="398"></a>
				</div>
				<ul class="pagination" style="right: auto; left: 600px;">
                                    <?php
                                    define("search.php", True);
                                    include_once 'search.php';
                                    ?>
				</ul>
				<img src="images/extra-banner.png" alt="" class="extra-banner">
			</div>
			<!-- faded slider end -->
		</div>
	</header>

	<!-- content -->
	<section id="content">
		<div class="container_16">
			<div class="clearfix">
				<section id="mainContent" class="grid_10" style="position: relative; width: 100%;">
					<article style="position: relative; width: 100%;">
						<h2>Modify listing</h2>
                                               
                                               
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
                                                    $maintenance = $_GET['maintenance_fee'];
                                                    $status = $_GET['status'];  
                                                    $address = $_GET['address'];
                                                    $description = $_GET['description'];
                                                     
                                                    
                                                  /*  mysql_connect("$host","$user", "$pass")or die("cannot connect");  
                                                    mysql_select_db("$db")or die("cannot select DB");  */
                                                    

                                                    $results_array = modify_values($id,$CompID, $price, $sq_ft, $num_floors, 
                                                            $num_bdrm, $num_baths, $year_built, $prop_type, $bldg_type, 
                                                            $district, $maintenance, $status, $address, $description);
                                                    if($results_array){
                                                    	echo "Error: An $results_array<br>";
                                                    }	
                                                    else{
	                                                    echo"Modifictions made";
	                                                    echo "<br>Values that were updated:";
	                                                    if($CompID){	
	    						    	echo "<br>Company ID: $CompID";
	                                                    }
	                                                    if($Price){
	    						    	echo "<br>Price: $price";
	                                                    }
	                                                    if($sq_ft){
	    						    	echo "<br>Square Footage: $sq_ft";
	                                                    }
	                                                    if($num_floors){
	    						    	echo "<br>Number of Floors: $num_floors";
	                                                    }
	                                                    if($num_bdrm){
	    						    	echo "<br>Number of Bedrooms: $num_bdrm";
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
	                                                    if($maintenance){
	    						    	echo "<br>Maintenance Fees: $maintenance";
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
    				
                                                ?>
                                                
						
                            		
					</article>
				</section>
			</div>
		</div>
	</section>
<?php
    include_once "footer.php";
?>
