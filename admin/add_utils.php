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


/**
 * Add a company (protected against sql injection)
 * 
 * @param string $name
 * @param string $address
 * @param string $description
 * @param string $manager_name
 * @param string $phone_no
 * @param string $email
 * @param string $raw_password
 * @param string $username
 * @return boolean - True if successful, False if not
 */
function add_company_secure($name, $address, $description, $manager_name, $phone_no, $email, $raw_password, $username, $db = 's403_project') {
    
    $con = getSQLConnection();
    mysqli_select_db($con, $db);
    
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

/**
 * Is there a user with same email in the database already?
 * 
 * @param string $email
 * @return boolean
 */
function email_unique($email, $db = 's403_project') {
    $con = getSQLConnection();
    mysqli_select_db($con, $db);
    $query = "select * from User where email = '$email' limit 1";
    $result = mysqli_query($con, $query);
    mysqli_close($con);
    if(mysqli_fetch_array($result)) {
        return False;
    }
    return True;
}

/**
 * Is there a user with the same username in the database already?
 * @param string $username
 * @return boolean
 */
function username_unique($username, $db = 's403_project') {
    $con = getSQLConnection();
    mysqli_select_db($con, $db);
    $query = "select * from User where username = '$username' limit 1";
    $result = mysqli_query($con, $query);
    mysqli_close($con);
    if(mysqli_fetch_array($result)) {
        return False;
    }
    return True;
}


?>
