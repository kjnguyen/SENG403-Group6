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
	$user_statement = "insert into User (email, password, permission, username) values (?, ?, 3, ?)";
   
	if ($stmt = mysqli_prepare($con, $user_statement)) {
		$stmt->bind_param('sis', $email, $password, $username);
		if (!($stmt->execute())) {goto funcFail;}
		$ID = $stmt->insert_id;
		$stmt->close();
	}
	else {goto funcFail;}
	
	$emp_statement = "insert into Employee (ID, name, compID, phone_no) values (?, ?, ?, ?,)";
    if ($stmt2 = mysqli_prepare($con, $emp_statement)) {
        $stmt2->bind_param('isis', $ID, $agent_name, $compID, $phone_no);
        if (!($stmt2->execute())) {goto funcFail;}
        $stmt2->close();
    }
    else {goto funcFail;}
 
    mysqli_close($con);
		return True;
    funcFail:
		mysqli_close($con);
		return False;
}