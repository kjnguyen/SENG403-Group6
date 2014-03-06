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
include_once '../mysqlcon.php';


/**
 * Modify one listing specified by $id (protected against sql injection)
 * 
 * 
 * @param int $id
 * @param double $price
 * @param double $sq_ft
 * @param int $num_floors
 * @param int $num_bdrms
 * @param int $num_baths
 * @param int $year_built
 * @param string $prop_type
 * @param string $bldg_type
 * @param string $district
 * @param double $maintenance_fee
 * @param string $status
 * @param string $address
 * @param string $description
 * @return boolean - True if successful, False if not
 */
function modify_values_secure($id, $price, $sq_ft, $num_floors,
        $num_bdrms, $num_baths, $year_built, $prop_type, $bldg_type,
        $district, $maintenance_fee, $status, $address, $description) {
    
    $con = getSQLConnection();
    
    mysqli_select_db($con, 's403_project');
   
    if(!$id){goto funcError;}  
      
    $sql = "UPDATE Listing SET price=?, sq_ft=?, num_floors=?, num_bdrms=?, num_baths=?, year_built=?, prop_type=?,bldg_type=?, district=?, maintenance_fee=?, status=?, address=?, description=? WHERE ID=?";
    
    if ($stmt = mysqli_prepare($con, $sql)) {
        $stmt->bind_param('ddiiiisssdsssi', $price, $sq_ft, $num_floors, $num_bdrms, $num_baths, $year_built, $prop_type, $bldg_type, $district, 
                $maintenance_fee, $status, $address, $description, $id);
        if(!($stmt->execute())) {goto funcError;}
        $stmt->close();
    }
    else {goto funcError;}

    mysqli_close($con);

    return True;
    funcError:
    mysqli_close($con);
    return False;
} 


/**
 * Delete a listing (protected against sql injection)
 * @param int $id
 * @return boolean - True if successful, False if not
 */
function delete_listing_secure($id){
    $con = getSQLConnection();
    
    $sql = "DELETE FROM Listing WHERE ID=?";
    if ($stmt = mysqli_prepare($con, $sql)) {
        $stmt->bind_param('i', $id);
        if(!($stmt->execute())) {goto funcError1;}
        $stmt->close();
    }
    else {goto funcError1;}

    
    mysqli_close($con);
    return True;
    funcError1:
    mysqli_close($con);
    return False;
}


function modify_list_of_status() {
    $con = getSQLConnection(true);
    
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
    $con = getSQLConnection(true);
    
    $query = "select distinct ID from Listing ORDER BY ID";
    $results = mysqli_query($con, $query);
    echo mysqli_error($con);
    $status = array();
    
    while ($row = mysqli_fetch_assoc($results)) {
        $status[] = $row;
    }
    mysqli_close($con);
    return $status;
}
/*
//checks if user has any permissions
function check_permission_initial(){
    if (!isset($_SESSION['Authed_UserID']){
       // echo "<br>Must be logged in to modify listings.<br>"
        return 0;
    }
    //have any permissions
    if ($_SESSION['Authed_Permission'] == 1 || $_SESSION['Authed_Permission'] == 2 || $_SESSION['Authed_Permission'] == 3){
        return 1;
    }
    else{
        return 0;
    }
}*/

//Check permission of user to see if they are allowed to edit selected listing based on its id
//Returns 0 if permission denied and 1 otherwise
//input- listing id number, output-1 or 0

function check_permission($id){
    $con = getSQLConnection(true);
    
    if (!isset($_SESSION['Authed_UserID'])){
       // echo "<br>Must be logged in to modify listings.<br>"
        return 0;
    }
    //admin status - permission allowed 
    if ($_SESSION['Authed_Permission'] == 1 ){
        return 1;
    }
    //company status -  if listing belogns to the company permission allowed
    if ($_SESSION['Authed_Permission'] == 2 ){
           $query = "SELECT CompID from Listing WHERE ID='$id'";
           $result = mysqli_query($con, $query);
           if ($row = mysqli_fetch_assoc($result)) {
                $number = $row['CompID'];
            }
           if ($_SESSION['Authed_UserID'] == $number ){
               return 1;
           }
           else{
               return 0;
           }
    }
    else{
        return 0;
    }
        //employee status -  if listing belogns to the employee permission allowed
        
        //TODO Currently unsure what to check compare for permissions
   /* if ($_SESSION['Authed_Permission'] == 3 ){
           $query = "SELECT CompID from Listing WHERE ID='$id'";
           $result = mysqli_query($con, $query);
           
           if ($_SESSION[''] ==  )
    }*/
   
    mysqli_close($con);
}

?>
