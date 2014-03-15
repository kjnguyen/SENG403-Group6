<?php
    define("INCLUDE_FILE", true);
    include('header.php');
    
    //Do not output anything before this line (Do not use echo or html code)
    //---------------------------------------------------
?>


<div>
    <ul class="breadcrumb">
        <li>
          <a href="index.php"><b>Home</b></a>
        </li>
    </ul>
</div>
<div class="row-fluid sortable ui-sortable">		
        <div class="box span12">
                <div class="box-header well" data-original-title="">
                 <?php
                    if(!defined("search_utils.php")) {define("search_utils.php", True);}
                    include_once '../search_utils.php';


                    $user_id= $_SESSION['Authed_UserID'];
                    $type_id = $_SESSION['Authed_Permission'];
                    // 1-admin, 2-company, 3-employee
                    

                    
                    echo '<h2><i class="icon-list-alt"></i>';
                     if ($type_id == 1) {
                         echo 'Companies';
                     }
                     else if ($type_id == 2) {
                        $company_id = $user_id;
                        echo 'Your Listings';
                     }
                     else if ($type_id == 3) {
                        echo "Your Listings";
                        $company_id = get_company_id($user_id);
                     }
   
                    echo '</h2>

                </div>';
                                        
                    echo '
                <div class="box-content">
                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper" role="grid"><div class="row-fluid"><div class="span6"></div><div class="span6"></div></div><table class="table table-striped table-bordered bootstrap-datatable datatable dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info">
                <thead>
                  <tr role="row">';
                    if ($type_id == 1) {
                          echo '
                      <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="ID: activate to sort column descending" style="width: 132px;">ID</th>
                      <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 252px;">Name</th>
                      <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Manager: activate to sort column ascending" style="width: 252px;">Manager</th>
                      <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Phone: activate to sort column ascending" style="width: 202px;">Phone</th>
                      <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="width: 50px;">Actions</th>

                      ';
                     }
                     else if ($type_id == 2 || $type_id == 3) {
                        echo '
                      <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="ID: activate to sort column descending" style="width: 132px;">ID</th>
                      <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Address: activate to sort column ascending" style="width: 518px;">Address</th>
                      <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="width: 252px;">Actions</th>
                      ';
                     }

                   
                    echo '
                  </tr>
                </thead>   

                  <tbody role="alert" aria-live="polite" aria-relevant="all">
                  ';
                    if ($type_id == 1) {
                        $results_array = get_all_companies();
                        if (empty($results_array)) {
                            echo "<h1>No Companies</h1>";
                        }
                        else {
                            foreach ($results_array as $row) {
                                echo '<tr class="odd">';
                                echo '<td class=" sorting_1">'.$row['ID'].'</td>';
                                echo '<td class="center ">'.$row['name'].'</td>';
                                echo '<td class="center ">'.$row['manager_name'].'</td>';
                                echo '<td class="center ">'.$row['phone_no'].'</td>';
                                echo '<td class="center " >';
                                echo '
                                    <form name="modify_employee" method="post" action="modify_employee.php"">';
                                echo '<input type="hidden", name="ID", value="'.$row['ID'].'">';
                                echo '
                                <button type="submit" name="process_modify" value="modify" class="btn btn-small btn-primary" title="Click on Edit to see full details and modify any value" data-rel="tooltip">Edit</button>

                                <button type="submit" name="process_delete" value="delete" class="btn btn-small btn-danger">delete</button>
                                </form>
                                ';
                                echo '</tr>';

                            }
                        }
                     }
                     else if ($type_id == 2 || $type_id == 3) {
                        $results_array = search_company_listing($company_id);
                        if (empty($results_array)) {
                            echo "<h1>No Listing</h1>";
                        }
                        else {
                            foreach ($results_array as $row) {
                                $item = search_one_item($row['ID']);
                                echo '<tr class="odd" >';

                                echo '<td class=" sorting_1" title="'.$item['description'].'" data-rel="tooltip">'.$row['ID'].'</td>';
                                echo '<td class="center " title="'.$item['description'].'" data-rel="tooltip">'.$row['address'].'</td>';
                                echo '<td class="center " >';
                                echo '
                                    <form name="modify_listing" method="post" action="modify.php"">';
                                echo '<input type="hidden", name="ID", value="'.$row['ID'].'">';
                                echo '<input type="hidden", name="CompID", value="'.$company_id.'">';
                                echo '
                                    <button type="submit" name="process_modify" value="modify" class="btn btn-small btn-primary" title="Click on Edit to see full details and modify any value" data-rel="tooltip">Edit</button>

                                    <button type="submit" name="process_delete" value="delete" class="btn btn-small btn-danger">delete</button>
                                    </form>
                                    ';
                                echo '</tr>';

                            }
                        }
                     }

                    

                    ?>

                                </tbody></table>            
                </div>
        </div><!--/span-->

</div>

<?php
// show Employees if user is company
if ($type_id == 2) {
   
echo '                   
<div class="row-fluid sortable ui-sortable">		
        <div class="box span12">
                <div class="box-header well" data-original-title="">';

                    if(!defined("search_utils.php")) {define("search_utils.php", True);}
                    include_once '../search_utils.php';                
                    echo '<h2><i class="icon-user"></i>';
                    echo 'Employees';
                    echo '</h2></div>';
                                        
                    echo '
                <div class="box-content">
                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper" role="grid"><div class="row-fluid"><div class="span6"></div><div class="span6"></div></div><table class="table table-striped table-bordered bootstrap-datatable datatable dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info">
                <thead>
                  <tr role="row">

                  <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="ID: activate to sort column descending" style="width: 132px;">ID</th>
                  <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 200px;">Name</th>
                  <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Username: activate to sort column ascending" style="width: 200px;">Username</th>
                  <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending" style="width: 200px;">Email</th>
                  <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Phone: activate to sort column ascending" style="width: 150px;">Phone</th>
                 <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="width: 50px;">Actions</th>
                   
                  </tr>
                </thead>   

                  <tbody role="alert" aria-live="polite" aria-relevant="all">
                  ';
                    
                    $results_array = search_company_employee($company_id);
                    if (empty($results_array)) {
                        echo "<h1>No Employees</h1>";
                    }
                    else {
                        foreach ($results_array as $row) {
                            echo '<tr class="odd" >';

                            echo '<td class=" sorting_1" >'.$row['ID'].'</td>';
                            echo '<td class="center " >'.$row['name'].'</td>';
                            echo '<td class="center " >'.$row['username'].'</td>';
                            echo '<td class="center " >'.$row['email'].'</td>';
                            echo '<td class="center " >'.$row['phone_no'].'</td>';
                            echo '<td class="center " >';
                            echo '
                                <form name="modify_employee" method="post" action="modify_employee.php"">';
                            echo '<input type="hidden", name="ID", value="'.$row['ID'].'">';
                            echo '<input type="hidden", name="compID", value="'.$company_id.'">';
                            echo '
                                <button type="submit" name="process_modify" value="modify" class="btn btn-small btn-primary" title="Click on Edit to see full details and modify any value" data-rel="tooltip">Edit</button>

                                <button type="submit" name="process_delete" value="delete" class="btn btn-small btn-danger">delete</button>
                                </form>
                                ';
                            echo '</tr>';

                        }
                    }
                     echo '

                                </tbody></table>            
                </div>
        </div><!--/span-->

</div>';
}
?>

</div>
<?php
    include('footer.php');
?>
