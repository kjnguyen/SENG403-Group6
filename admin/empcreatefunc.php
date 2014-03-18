<?php

if(!defined("empcreatefunc.php"))
{
    echo '404 Not Found';
     header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found', true, 404);die();
}

//define("mysqlcon.php", True);
//include_once '../mysqlcon.php';

function create_emp_secure($compID, $agent_name, $phone_no, $email, $username, $raw_password) {
    
    $con = getSQLConnection();
    mysqli_select_db($con, 's403_project');
    
    $password = hash('sha512', $raw_password);
    $user_statement = "insert into Employee (ID, compID, name, phone_no, email, permission, username, password) values (?, ?, ?, ?, ?, 3, ?, ?)";

	static $ID = 0;

    if ($stmt = mysqli_prepare($con, $user_statement)) {
        $stmt->bind_param("iissssi", $ID, $compID, $agent_name, $phone_no, $email, $username, $password);
        if (!($stmt->execute())) {goto funcFail;}
        $stmt->close();
		$ID ++;
    }
    else {goto funcFail;}
 
    mysqli_close($con);
		return True;
    funcFail:
		mysqli_close($con);
		return False;
}