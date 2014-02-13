<?php
    include_once "header.php";
?>

	<!-- content -->
	<section id="content">
		<div class="container_16">
			<div class="clearfix">
				<section id="mainContent" class="grid_10">
					<article>
						<h2>Xiao's Search Results Page</h2>
                                                <?php
                                                    include_once 'mysqlcon.php';
                                                    $con = getSQLConnection();
                                                    mysqli_select_db($con, 's403_project');
                                                    //mysqli_connect("localhost", "root", "1234", "s403_project");
                                                    echo mysqli_error($con);
                                                    echo "hello, this is displaying from the live Company table <br>";
                                                    $query = "select ID, date_listed, sq_ft, num_bdrms, address, description from Listing";
                                                    $results = mysqli_query($con, $query);
                                                    echo mysqli_error($con);
                                                    while ($row = mysqli_fetch_assoc($results)) {
                                                        echo $row['ID'];
                                                        echo ' | ';
                                                        echo $row['date_listed'];
                                                        echo ' | ';
                                                        echo $row['sq_ft'];
                                                        echo ' | ';
                                                        echo $row['num_bdrms'];
                                                        echo ' | ';
                                                        echo $row['address'];
                                                        echo ' | ';
                                                        echo $row['description'];
                                                        echo '<br>';
                                                    }
                     
                                                    echo mysqli_error($con);
                                                ?>
						<h3>Search Results</h3>
					</article>
				</section>
			</div>
		</div>
	</section>

<?php
    include_once "footer.php";
?>