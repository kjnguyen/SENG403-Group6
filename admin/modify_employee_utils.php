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


?>


