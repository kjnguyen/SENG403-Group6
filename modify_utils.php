<?php

//Prevent Direct Access, return 404 page not found
if(!defined("modify_utils.php"))
{
    echo '404 Not Found';
     header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found', true, 404);die();
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
define("mysqlcon.php", True);
include_once 'mysqlcon.php';

//Modify the selected values of the listing with ID=$id 
//TODO Check what happens if criteria are left blank 
function modify_values($id, $CompID, $price, $sq_ft, $num_floors,
        $num_bdrm, $num_baths, $year_built, $prop_type, $bldg_type,
        $district, $maintenance, $status, $address, $description) {
  
    $con = getSQLConnection();
    mysqli_select_db($con, 's403_project');
    
    $sql = "UPDATE listing SET CompID='$CompID', price='$price', sq_ft='$sq_ft', num_floors='$num_floors', "
            . "num_bdrm='$num_bdrm', num_baths='$num_baths', year_built='$year_built', prop_type='$prop_type',"
            . "bldg_type='$bldg_type', district='$district', maintenance='$maintenance', status='$status',"
            . "address='$address', description='$description' WHERE ID='$id'" ;
   $result = mysqli_query($con, $sql);
   if(!$result){
       trigger_error("Modification error!");
   }
   else {
       echo"Modification successful\n";
   }
   mysqli_close($con);

}  
//Delete listing with passed in id number
function delete_listing($id){
    $con = getSQLConnection();
    mysqli_select_db($con, 's403_project');
    
    $sql = "DELETE FROM listing WHERE ID=$id";
    $result = mysql_query($sql);
    if(!$result){
       trigger_error("Deletion error!");
    }
    else {
       echo"Deletion successful\n";
    }
    
    mysqli_close($con);
}

function get_list_of_status() {
    $con = getSQLConnection();
    mysqli_select_db($con, 's403_project');
    $query = "select distinct status from Listing";
    $results = mysqli_query($con, $query);
    echo mysqli_error($con);
    $status = array();
    
    while ($row = mysqli_fetch_assoc($results)) {
        $status[] = $row;
    }
    mysqli_close($con);
    return $status;
}


?>