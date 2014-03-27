<?php
    include_once "header.php";
?>
        

<!-- Floating window created using JQuery, credit goes to user: neurotik in StackOverflow-->
<div id="notification-anchor"></div>
<div id="notification">
<?php
define("search.php", True);
include_once 'search.php';

?>
    
    <?php
        if(!defined("compare_chooser.php")) {define("compare_chooser.php", True);}
        include 'compare_chooser.php';
        ?>
</div>
<script type="text/javascript"> 
    $(function() {
        var a = function() {
            var b = $(window).scrollTop();
            var d = $("#notification-anchor").offset().top;
            var c = $("#notification");
            if (b > d) {
                c.css({position:"fixed",top:"10px", right:"400px"})
            } else {
                c.css({position:"absolute",top:"100px", right:"400px"})
            }
        };
        $(window).scroll(a);a()
    });
</script> 

	<!-- Search Results Page -->
	<section id="content">
		<div class="container_16">
			<div class="clearfix">
				<section id="mainContent" class="grid_10" style="position: relative; width: 100%;">
					<article style="position: relative; width: 100%;">
						<h2>Listing Search Results</h2>
                            <div id="faded" style="position: relative; width: 100%;">
                                <ul class="pagination" style="position: relative; top: 0px; left: 0px;">
                                <?php
                                    if(!defined("search_utils.php")) {define("search_utils.php", True);}
                                    include_once 'search_utils.php';
                                    if (isset($_SESSION['mostRecentSearchResults'])) {
                                        unset($_SESSION['mostRecentSearchResults']);
                                    }
                                    $_SESSION['mostRecentSearchResults'] = $_SERVER['REQUEST_URI'];
                                    $city_id = $_GET['city_id'];

                                    $min_price = $_GET['min_price'];
                                    $max_price = $_GET['max_price'];
                                    $num_bdrm = $_GET['num_bdrm'];
                                    $district = $_GET['district'];
                                    $status = $_GET['status'];

    //                                                    echo "Search Criteria: <br>";
    //                                                    echo "city = $city, province = $province, min_price = $min_price, max_price = $max_price, num_bdrm = $num_bdrm, district  = $district, status = ".$status."<br>";

                                    $results_array = search_listing($city_id, $min_price, $max_price, $num_bdrm, $district, $status);

                                    if (empty($results_array))
                                    {
                                        echo "<h1>No Results Found</h1>";
                                    }
                                    else
                                    {
                                        $con = getSQLConnection();
                                        include_once './picturesLib.php';
                                        
                                        foreach ($results_array as $row)
                                        {
                                            $thumbs = getThumnails($con, $row['ID']);
                                            
                                            echo '<li class="" style="width: auto;">';
                                            echo '<a href="item.php?ID='.$row['ID'].'" rel="0">';
                                            if(!empty($thumbs))
                                            {
                                                echo '<img src="' . $thumbs[0]['path'] . '" height="84" width="93">';
                                            }
                                            else
                                            {
                                                echo '<img src="images/no-image.jpg" height="84" width="93">';
                                            }
                                            echo 'ID:   '.$row['ID'].'<br>';
                                            echo $row['sq_ft'].' Sqr. Ft.<br>';                                                                
                                            echo $row['num_bdrms'].' bedrooms<br>';
    //                                        echo 'Date Listed:  '.$row['date_listed'].'<br>';
                                            echo 'Address:    '.$row['address'].'<br>';
                                            echo 'Price:    $'.$row['price'];
                                            echo '</a></li>';
                                        }
                                        
                                        mysqli_close($con);
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