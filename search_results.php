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
                                                <?php
                                                    include_once 'mysqlcon.php';
                                                    $con = getSQLConnection();
                                                    mysqli_select_db($con, 's403_project');
                                                    //mysqli_connect("localhost", "root", "1234", "s403_project");
                                                    echo mysqli_error($con);
                                                    echo "hello, this is displaying all the listings<br>";
                                                    $query = "select ID, date_listed, sq_ft, num_bdrms, address, description from Listing";
                                                    $results = mysqli_query($con, $query);
                                                    echo mysqli_error($con);
                                                    
//                                                    echo '<div class="box span12">
//                                                            <div class="box-header well" data-original-title="">
//                                                            <h2><i class="icon-user"></i> Listings</h2>
//                                                            <div class="box-icon">
//                                                            <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
//                                                            <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
//                                                            <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
//                                                            </div>
//                                                            </div>
//                                                            <div class="box-content">
//                                                            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper" role="grid"><div class="row-fluid"><div class="span6"><div id="DataTables_Table_0_length" class="dataTables_length"><label><select size="1" name="DataTables_Table_0_length" aria-controls="DataTables_Table_0"><option value="10" selected="selected">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> records per page</label></div></div><div class="span6"><div class="dataTables_filter" id="DataTables_Table_0_filter"><label>Search: <input type="text" aria-controls="DataTables_Table_0"></label></div></div></div><table class="table table-striped table-bordered bootstrap-datatable datatable dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info">';
//                                                            
//                                                            // table headings
//                                                            echo '
//                                                            <thead>
//                                                            <tr role="row">
//                                                            <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="ID: activate to sort column descending" style="width: 147px;">ID</th>
//                                                            <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Sqr Ft.: activate to sort column ascending" style="width: 275px;">Sqr Ft.</th>
//                                                            <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Bedrooms: activate to sort column ascending" style="width: 147px;">Bedrooms</th>
//                                                            <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Date Listed: activate to sort column ascending" style="width: 350px;">Date Listed</th>
//                                                            <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Address: activate to sort column ascending" style="width: 561px;">Address</th>
//                                                            </tr>
//                                                            </thead>';
//                                                            
//                                                            echo '
//
//                                                            <tbody role="alert" aria-live="polite" aria-relevant="all">';
//                                                            
//                                                            
//                                                            
//                                                            while ($row = mysqli_fetch_assoc($results)) {
//                                                                echo '<tr class="odd">';
//                                                                echo '<td class=" sorting_1">'.$row['ID'].'</td>';
//                                                                echo '<td class="center ">'.$row['sq_ft'].'</td>';                                                                
//                                                                echo '<td class="center ">'.$row['num_bdrms'].'</td>';
//                                                                echo '<td class="center ">'.$row['date_listed'].'</td>';
//                                                                echo '<td class="center ">'.$row['address'].'</td>';
//                                                                echo '</tr>';
//                                                            }
//
//                                                            
//
//                                                            echo '
//                                                            </tbody>
//                                                            </table>
//                                                            <div class="row-fluid"><div class="span12"><div class="dataTables_info" id="DataTables_Table_0_info">Showing 1 to 10 of 32 entries</div></div><div class="span12 center"><div class="dataTables_paginate paging_bootstrap pagination"><ul><li class="prev disabled"><a href="#">← Previous</a></li><li class="active"><a href="#">1</a></li><li><a href="#">2</a></li><li><a href="#">3</a></li><li><a href="#">4</a></li><li class="next"><a href="#">Next → </a></li></ul></div></div></div></div>
//                                                            </div>
//                                                            </div>';
                                                    
                                                    
                                                    echo '<div id="faded" style="position: relative; width: 100%;">';
//                                                    echo '
//                                                        <div class="rap" style="position: relative;">
//                                                                <a href="#" style="position: absolute; top: 0px; left: 0px; z-index: 0; display: none;">
//                                                                    <img src="images/big-img1.jpg" alt="" width="571" height="398"></a>
//                                                                <a href="#" style="position: absolute; top: 0px; left: 0px; z-index: 0;">
//                                                                    <img src="images/big-img2.jpg" alt="" width="571" height="398"></a>
//                                                                <a href="#" style="position: absolute; top: 0px; left: 0px; z-index: 0; display: none;">
//                                                                    <img src="images/big-img3.jpg" alt="" width="571" height="398"></a>
//                                                        </div>';
                                                    echo '<ul class="pagination" style="position: relative; top: 0px; left: 0px;">';
//                                                    
                                                    while ($row = mysqli_fetch_assoc($results)) {
                                                        echo '<li class="" style="width: auto;">';
                                                        echo '<a href="#" rel="0">';
                                                        echo '<img src="images/f_thumb1.png" alt="">';
                                                        echo '<td class=" sorting_1">'.$row['ID'].'</td>';
                                                        echo '<td class="center ">'.$row['sq_ft'].'</td>';                                                                
                                                        echo '<td class="center ">'.$row['num_bdrms'].'</td>';
                                                        echo '<td class="center ">'.$row['date_listed'].'</td>';
                                                        echo '<td class="center ">'.$row['address'].'</td>';
                                                        echo '</a></li>';
                                                    }
//                                                                <li class="" style="width: auto;">
//                                                                        <a href="#" rel="0">
//                                                                                <img src="images/f_thumb1.png" alt="">
//                                                                                <span class="left">
//                                                                                        Villa<br>
//                                                                                        2007 year<br>
//                                                                                        5000 sq.ft
//                                                                                </span>
//                                                                                <span class="right">
//                                                                                        Brick, glass<br>
//                                                                                        3 beds<br>
//                                                                                        2 baths
//                                                                                </span>
//                                                                        </a>
//                                                                </li>
//                                                                <li class="current" style="width: auto;">
//                                                                        <a href="#" rel="1">
//                                                                                <img src="images/f_thumb2.png" alt="">
//                                                                                <span class="left">
//                                                                                        Villa<br>
//                                                                                        2009 year<br>
//                                                                                        3500 sq.ft
//                                                                                </span>
//                                                                                <span class="right">
//                                                                                        Brick, glass<br>
//                                                                                        5 beds<br>
//                                                                                        3 baths
//                                                                                </span>
//                                                                        </a>
//                                                                </li>
//                                                                <li class="" style="width: auto;">
//                                                                        <a href="#" rel="2">
//                                                                                <img src="images/f_thumb3.png" alt="">
//                                                                                <span class="left">
//                                                                                        Villa<br>
//                                                                                        2010 year<br>
//                                                                                        4200 sq.ft
//                                                                                </span>
//                                                                                <span class="right">
//                                                                                        Brick, glass<br>
//                                                                                        4 beds<br>
//                                                                                        3 baths
//                                                                                </span>
//                                                                        </a>
//                                                                </li>
                                                        echo '</ul></div>';
                                                    
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