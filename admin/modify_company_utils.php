<?php

//Prevent Direct Access, return 404 page not found
if(!defined("modify_employee_utils.php"))
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
 * Modify one employee specified by $id (protected against sql injection)
 * @param int $id
 * @param type $name
 * @param type $phone_no
 * @param type $email
 * @param type $username
 * @param type $password
 * @return string|null
 * @return boolean - True if successful, False if not
 */
function modify_values_secure_emp($id, $name, $phone_no) {
    
    $con = getSQLConnection();
    
    mysqli_select_db($con, 's403_project');
   
    if(!$id){goto funcError;}  
      
    $sql = "UPDATE Employee SET name=?, phone_no=? WHERE ID=?";
    if ($stmt = mysqli_prepare($con, $sql)) {
        $stmt->bind_param('ssi', $name, $phone_no, $id);
        if(!($stmt->execute())) {goto funcError;}
        $stmt->close();
    }
    else {goto funcError;}

// email=?, username=?, password=?
//$email, $username, $password
    mysqli_close($con);

    return True;
    funcError:
    mysqli_close($con);
    return False;
} 


function modify_values_secure_user($id, $email, $username, $password) {
    
    $con = getSQLConnection();
    
    mysqli_select_db($con, 's403_project');
   
    if(!$id){goto funcError;}  
      
    $sql = "UPDATE User SET email=?, username=?, password=? WHERE ID=?";
    
    if ($stmt = mysqli_prepare($con, $sql)) {
        $stmt->bind_param('sssi', $email, $username, $password, $id);
        if(!($stmt->execute())) {goto funcError;}
        $stmt->close();
    }
    else {goto funcError;}

// email=?, username=?, password=?
//$email, $username, $password
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
       // echo "<br>Must be logged in to modify employee.<br>"
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

function search_one_item($ID) {
    $con = getSQLConnection();
    mysqli_select_db($con, 's403_project');
    $query = "select * FROM Employee join User on Employee.ID = User.ID WHERE Employee.ID = $ID";
    $result = mysqli_query($con, $query);
    mysqli_close($con);
    if ($row = mysqli_fetch_assoc($result)){
        return $row;
    }
    else {
        return NULL;
    }
}


?>