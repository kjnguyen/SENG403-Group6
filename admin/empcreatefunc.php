<?php

if(!defined("empcreate.php"))
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