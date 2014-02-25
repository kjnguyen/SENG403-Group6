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
//include_once 'mysqlcon.php';

//Modify the selected values of the listing with ID=$id 
function modify_values($id, $CompID, $price, $sq_ft, $num_floors,
        $num_bdrms, $num_baths, $year_built, $prop_type, $bldg_type,
        $district, $maintenance_fee, $status, $address, $description) {
            
    $con = mysqli_connect("mysql.jack-l.com", "seng403", "WeHave4Js", "s403_project");

  if($exitOnError && mysqli_connect_errno($con))
  {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
  }
  
   // $con = getSQLConnection();
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
    if($num_bdrms){
   $sql = "UPDATE Listing SET num_bdrms='$num_bdrms' WHERE ID='$id'";        
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
    if($maintenance_fee){
   $sql = "UPDATE Listing SET maintenance_fee='$maintenance_fee' WHERE ID='$id'";        
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


//Delete listing with passed in id number
function delete_listing($id){
    $con = getSQLConnection();
    mysqli_select_db($con, 's403_project');
    
    $sql = "DELETE FROM Listing WHERE ID=$id";
    $result = mysql_query($sql);

    
    mysqli_close($con);
}


function modify_list_of_status() {
    //$con = getSQLConnection();
     $con = mysqli_connect("mysql.jack-l.com", "seng403", "WeHave4Js", "s403_project");

  if($exitOnError && mysqli_connect_errno($con))
  {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
  }
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
   // $con = getSQLConnection();
    $con = mysqli_connect("mysql.jack-l.com", "seng403", "WeHave4Js", "s403_project");

  if($exitOnError && mysqli_connect_errno($con))
  {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
  }
   
    mysqli_select_db($con, 's403_project');
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
   // $con = getSQLConnection();
   $con = mysqli_connect("mysql.jack-l.com", "seng403", "WeHave4Js", "s403_project");

  if($exitOnError && mysqli_connect_errno($con))
  {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
  }
    mysqli_select_db($con, 's403_project');
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
