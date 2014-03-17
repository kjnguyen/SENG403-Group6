<?php

if(!defined("empcreatefunc.php"))
{
    echo '404 Not Found';
     header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found', true, 404);die();
}

define("mysqlcon.php", True);
include_once 'mysqlcon.php';


function createemployee($compID, $agent_name, $phone_no, $email, $permission, $username, $password){

$con = getSQLConnection();
mysqli_select_db($con, 's403_project');

static $empID = 0;

$sql = "INSERT into Employee (empID, compID, agent_name, phone_no, email, permission, username, password) VALUES ($empID, $compID, $agent_name, $phone_no, $email, $permission, $username, $password)";
$result = mysqli_query($con, $sql);

$empID ++;

}

function create_emp_secure($compID, $agent_name, $phone_no, $email, $username, $raw_password) {
    
    $con = getSQLConnection();
    mysqli_select_db($con, 's403_project');
    
	static $empID = 0;
	
    $password = hash('sha512', $raw_password);
    $user_statement = "insert into Employee (empID, compID, agent_name, phone_no, email, permission, username, password) values (?, ?, ?, ?, ?, 3, ?, ?)";
    if ($stmt = mysqli_prepare($con, $user_statement)) {
        $stmt->bind_param('sssssss', $empID, $compID, $agent_name, $phone_no, $email, $username, $password);
        if (!($stmt->execute())) {goto funcFail;}
        $stmt->close();
		$empID ++;
    }
    else {goto funcFail;}
 
    mysqli_close($con);
    return True;
    funcFail:
    mysqli_close($con);
    return False;
}