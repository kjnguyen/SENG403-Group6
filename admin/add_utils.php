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
//    echo mysqli_error($con);
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

function add_company_secure($name, $address, $description, $manager_name, $phone_no, $email, $raw_password, $username) {
    
    $con = getSQLConnection();
    mysqli_select_db($con, 's403_project');
    
    $password = hash('sha512', $raw_password);
    $user_statement = "insert into User (email, password, permission, username) values (?, ?, 2, ?)";
    if ($stmt = mysqli_prepare($con, $user_statement)) {
        $stmt->bind_param('sss', $email, $password, $username);
        if (!($stmt->execute())) {goto funcFail;}
        $ID = $stmt->insert_id;
        $stmt->close();
    }
    else {goto funcFail;}
    $company_statement = "insert into Company (ID, name, address, description, manager_name, phone_no) values (?, ?, ?, ?, ?, ?)";
    if ($stmt2 = mysqli_prepare($con, $company_statement))
    {
        $stmt2->bind_param('isssss', $ID, $name, $address, $description, $manager_name, $phone_no);
        if (!($stmt2->execute())){goto funcFail;}
        $stmt2->close();
    }
    else {goto funcFail;}
    mysqli_close($con);
    return True;
    funcFail:
    mysqli_close($con);
    return False;
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
