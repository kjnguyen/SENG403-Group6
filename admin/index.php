<?php
    define("INCLUDE_FILE", true);
    include('header.php');
    
    //Do not output anything before this line (Do not use echo or html code)
    //---------------------------------------------------
?>


			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Blank</a>
					</li>
				</ul>
			</div>

			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-picture"></i>Blank</h2>
						<div class="box-icon">
                                                    
                                                  <?php
                                                    define("search_utils.php", True);
                                                    include_once '../search_utils.php';
                                                    
                                                       $company_id = 21;
                                                    
                                                    $user_id= $_SESSION['Authed_UserID'];

                                                    $results_array = search_company_listing($company_id);
                                                    
                                                    if (empty($results_array)) {
                                                        echo "<h1>No Listing</h1>";
                                                    }
                                                    else {
                                                        foreach ($results_array as $row) {
                                                            echo '<li class="" style="width: auto;">';
                                                            echo '<a href="item.php?ID='.$row['ID'].'" rel="0">';
                                                            echo '<img src="images/f_thumb1.png" alt="">';
                                                            echo 'ID:   '.$row['ID'].'<br>';

                                                            echo 'Address:    '.$row['address'].'<br>';

                                                            echo '</a></li>';
                                                        }
                                                    }
    
                                                ?>
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						
					</div>
				</div><!--/span-->
			
			</div><!--/row-->

    
<?php
    include('footer.php');
?>
