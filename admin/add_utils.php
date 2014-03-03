<?php
//Prevent Direct Access, return 404 page not found
if(!defined("add_utils.php"))
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

function add_company($name, $address, $description, $manager_name, $phone_no, $email, $raw_password, $username) {
    
    $con = getSQLConnection();
    mysqli_select_db($con, 's403_project');
    
    $password = hash('sha512', $raw_password);
    $user_statement = sprintf("insert into User (email, password, permission, username) values ('%s', '$password', 2, '$username')", mysqli_real_escape_string($con, $email));
    mysqli_query($con, $user_statement);
    echo mysqli_error($con);
    $ID = mysqli_insert_id($con);
    
    $company_statement = sprintf("insert into Company (ID, name, address, description, manager_name, phone_no) "
            . "values ($ID, '%s', '%s', '%s', '%s', '%s')", mysqli_real_escape_string($con, $name), mysqli_real_escape_string($con, $address)
            , mysqli_real_escape_string($con, $description), mysqli_real_escape_string($con, $manager_name), mysqli_real_escape_string($con, $phone_no));
    mysqli_query($con, $company_statement);
    echo mysqli_error($con);
    mysqli_close($con);
//    echo $query;
    return True;
}

function email_unique($email) {
    $con = getSQLConnection();
    mysqli_select_db($con, 's403_project');
    $query = "select * from User where email = '$email' limit 1";
    $result = mysqli_query($con, $query);
    mysqli_close($con);
    if(mysqli_fetch_array($result)) {
        return False;
    }
    return True;
}

function username_unique($username) {
    $con = getSQLConnection();
    mysqli_select_db($con, 's403_project');
    $query = "select * from User where username = '$username' limit 1";
    $result = mysqli_query($con, $query);
    mysqli_close($con);
    if(mysqli_fetch_array($result)) {
        return False;
    }
    return True;
}
?>
