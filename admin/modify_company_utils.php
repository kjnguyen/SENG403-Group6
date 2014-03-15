<?php

//Prevent Direct Access, return 404 page not found
if(!defined("modify_company_utils.php"))
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
 * Modify one company specified by $id (protected against sql injection)
 * @param int $id
 * @param type $name
 * @param type $phone_no
 * @param type $address
 * @param type $manager_name
 * @param type $description
 * @return string|null
 * @return boolean - True if successful, False if not
 */
function modify_values_secure($id, $name, $address, $manager_name, $phone_no, $description) {
    
    $con = getSQLConnection();
    
    mysqli_select_db($con, 's403_project');
   
    if(!$id){goto funcError;}  
      
    $sql = "UPDATE Company SET name=?, address=?, manager_name=?, phone_no=? WHERE ID=?";
    //, address=?, manager_name=?, phone_no=?, decription=?
    echo $sql;
    if ($stmt = mysqli_prepare($con, $sql)) {
        $stmt->bind_param('ssssi', $name, $address, $manager_name, $phone_no, $id);
        // $address, $manager_name, $phone_no, $description,
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
 * Delete a company (protected against sql injection)
 * @param int $id
 * @return boolean - True if successful, False if not
 */
function delete_company_secure($id){
    $con = getSQLConnection();
    
    $sql = "DELETE FROM Company WHERE ID=?";
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

//Check permission of user to see if they are allowed to edit comapny
//Returns 0 if permission denied and 1 otherwise
//input- listing id number, output-1 or 0
function check_permission($id){
    $con = getSQLConnection(true);
    
    if (!isset($_SESSION['Authed_UserID'])){
       // echo "<br>Must be logged in to modify company.<br>"
        return 0;
    }
    //admin status - permission allowed 
    if ($_SESSION['Authed_Permission'] == 1 ){
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
    $query = "select * FROM Company WHERE ID = $ID";
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
