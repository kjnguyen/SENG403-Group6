<?php
    include_once "header.php";
?>

	<!-- content -->
	<section id="content">
		<div class="container_16">
			<div class="clearfix">
				<section id="mainContent" class="grid_10" style="position: relative; width: 100%;">
					<article style="position: relative; width: 100%;">
						<h2>Xiao's Search Results Page</h2>
                                                <div id="faded" style="position: relative; width: 100%;">
                                                <ul class="pagination" style="position: relative; top: 0px; left: 0px;">
                                                <?php
                                                    define("search_utils.php", True);
                                                    include_once 'search_utils.php';
                                                    echo "hello, this is the listing search results div <br>";
                                                    
                                                    $city = $_GET['city'];
                                                    $province = $_GET['province'];
                                                    $min_price = $_GET['min_price'];
                                                    $max_price = $_GET['max_price'];
                                                    $num_bdrm = $_GET['num_bdrm'];
                                                    $district = $_GET['district'];
                                                    $status = $_GET['status'];
                                                    
                                                    echo "Search Criteria: <br>";
                                                    echo "city = $city, province = $province, min_price = $min_price, max_price = $max_price, num_bdrm = $num_bdrm, district  = $district, status = $status<br>";

                                                    $results_array = search_listing($city, $province, $min_price, $max_price, $num_bdrm, $district, $status);
                                                    
                                                    if (empty($results_array)) {
                                                        echo "<h1>No Results Found</h1>";
                                                    }
                                                    else {
                                                        foreach ($results_array as $row) {
                                                            echo '<li class="" style="width: auto;">';
                                                            echo '<a href="#" rel="0">';
                                                            echo '<img src="images/f_thumb1.png" alt="">';
                                                            echo 'ID:   '.$row['ID'].'<br>';
                                                            echo $row['sq_ft'].' Sqr. Ft.<br>';                                                                
                                                            echo $row['num_bdrms'].' bedrooms<br>';
                                                            echo 'Date Listed:  '.$row['date_listed'].'<br>';
                                                            echo 'Address:    '.$row['address'];
                                                            echo '</a></li>';
                                                        }
                                                    }
    
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