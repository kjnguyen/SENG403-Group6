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
                                                    include_once 'mysqlcon.php';
                                                    $con = getSQLConnection();
                                                    mysqli_select_db($con, 's403_project');
                                                    //mysqli_connect("localhost", "root", "1234", "s403_project");
                                                    echo mysqli_error($con);
                                                    echo "hello, this is the listing search results div <br>";
                                                    $query = "select ID, date_listed, sq_ft, num_bdrms, address, description from Listing";
                                                    $results = mysqli_query($con, $query);
                                                    echo mysqli_error($con);

                                                    
                                                    while ($row = mysqli_fetch_assoc($results)) {
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

                                                    
                                                    
                                                ?>
                                                </ul>
                                                </div>
						<h3>Search Results</h3>
					</article>
				</section>
			</div>
		</div>
	</section>

<?php
    include_once "footer.php";
?>