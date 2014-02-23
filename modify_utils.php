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
   
   if(!$id){
       return $message = "ID is required";
   }  
   
   //Trying to do all in one update but was not working so instead broke each section into an indivudal update
   
    /*$sql = "UPDATE Listing SET CompID='$CompID', price='$price', sq_ft='$sq_ft', num_floors='$num_floors', "
            . "num_bdrm='$num_bdrm', num_baths='$num_baths', year_built='$year_built', prop_type='$prop_type',"
            . "bldg_type='$bldg_type', district='$district', maintenance='$maintenance', status='$status',"
            . "address='$address', description='$description' WHERE ID='$id'" ;*/
   if($price){
   $sql = "UPDATE Listing SET price='$price' WHERE ID='$id'";        
   $result = mysqli_query($con, $sql);
   }
    if($CompID){
   $sql = "UPDATE Listing SET CompID='$CompID' WHERE ID='$id'";        
   $result = mysqli_query($con, $sql);
   }
    if($sq_ft){
   $sql = "UPDATE Listing SET sq_ft='$sq_ft' WHERE ID='$id'";        
   $result = mysqli_query($con, $sql);
   }   
    if($num_floors){
   $sql = "UPDATE Listing SET num_floors='$num_floors' WHERE ID='$id'";        
   $result = mysqli_query($con, $sql);
   }
    if($num_bdrm){
   $sql = "UPDATE Listing SET num_bdrm='$num_bdrm' WHERE ID='$id'";        
   $result = mysqli_query($con, $sql);
   }   
    if($num_baths){
   $sql = "UPDATE Listing SET num_baths='$num_baths' WHERE ID='$id'";        
   $result = mysqli_query($con, $sql);
   }   
    if($year_built){
   $sql = "UPDATE Listing SET year_built='$year_built' WHERE ID='$id'";        
   $result = mysqli_query($con, $sql);
   }   
    if($prop_type){
   $sql = "UPDATE Listing SET prop_type='$prop_type' WHERE ID='$id'";        
   $result = mysqli_query($con, $sql);
   }   
    if($bldg_type){
   $sql = "UPDATE Listing SET bldg_type='$bldg_type' WHERE ID='$id'";        
   $result = mysqli_query($con, $sql);
   }   
    if($district){
   $sql = "UPDATE Listing SET district='$district' WHERE ID='$id'";        
   $result = mysqli_query($con, $sql);
   } 
    if($maintenance){
   $sql = "UPDATE Listing SET maintenance='$maintenance' WHERE ID='$id'";        
   $result = mysqli_query($con, $sql);
   }
    if($status){
   $sql = "UPDATE Listing SET status='$status' WHERE ID='$id'";        
   $result = mysqli_query($con, $sql);
   }  
    if($address){
   $sql = "UPDATE Listing SET address='$address' WHERE ID='$id'";        
   $result = mysqli_query($con, $sql);
   }
    if($description){
   $sql = "UPDATE Listing SET description='$description' WHERE ID='$id'";        
   $result = mysqli_query($con, $sql);
   }   
   
   mysqli_close($con);

}  
/*
function parse_conditions($CompID, $price, $sq_ft, $num_floors,
        $num_bdrm, $num_baths, $year_built, $prop_type, $bldg_type,
        $district, $maintenance, $status, $address, $description) {
    $conditions = " where cityID = $city_id and";
    if (is_numeric($min_price)) {$conditions .= " price >= $min_price and";}
    if (is_numeric($max_price)) {$conditions .= " price <= $max_price and";}
    if (is_numeric($num_bdrm)) {$conditions .= " num_bdrms = $num_bdrm and";}
    if ($district != NULL) {$conditions .= " lower(district) = lower('$district') and";}
    if ($status != NULL) {$conditions .= " lower(status) = lower('$status') and";}
    return substr($conditions, 0, -4);
}*/


//Delete listing with passed in id number
function delete_listing($id){
    $con = getSQLConnection();
    mysqli_select_db($con, 's403_project');
    
    $sql = "DELETE FROM Listing WHERE ID=$id";
    $result = mysql_query($sql);

    
    mysqli_close($con);
}


function modify_list_of_status() {
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

// TO FIX: currently sorting results by CompID instead of ID
function get_list_of_id() {
    $con = getSQLConnection();
    mysqli_select_db($con, 's403_project');
    $query = "select distinct ID from Listing";
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
