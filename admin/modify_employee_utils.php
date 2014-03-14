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
 * Delete a listing (protected against sql injection)
 * @param int $id
 * @return boolean - True if successful, False if not
 */
function delete_employee_secure($id){
    $con = getSQLConnection();
    
    $sql = "DELETE FROM Employee WHERE ID=?";
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
    //company status -  if employee belogns to the company permission allowed
    if ($_SESSION['Authed_Permission'] == 2 ){
        $compID = $_SESSION['Authed_UserID'];
    }
    else if ($_SESSION['Authed_Permission'] == 3)
    {
        if(!defined("search_utils.php")) {define("search_utils.php", True);}
        include_once '../search_utils.php';
        $compID = get_company_id($_SESSION['Authed_UserID']);
    }
    else{
        return 0;
    }
    $query = "SELECT CompID from Employee WHERE ID='$id'";
    $result = mysqli_query($con, $query);
    if ($row = mysqli_fetch_assoc($result)) {
         $number = $row['CompID'];
     }
    if ($compID == $number ){
        return 1;
    }
    else{
        return 0;
    }
    mysqli_close($con);
}


?>


