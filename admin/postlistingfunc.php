<?php

if(!defined("postlisting.php"))
{
    echo '404 Not Found';
     header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found', true, 404);die();
}

define("mysqlcon.php", True);
include_once 'mysqlcon.php';

function postlisting( $compID, 
        $price, 
        $sq_ft, 
        $num_floors, 
        $num_bdrms, 
        $year_built, 
        $prop_type, 
        $bldg_type, 
        $district, 
        $city, 
        $maintenance_fee, 
        $status, 
        $num_baths, 
        $address, 
        $description){

    $con = getSQLConnection();

    mysqli_select_db($con, 's403_project');


    $sql = "INSERT INTO Listing (compID, price, sq_ft, num_floors, num_bdrms, year_built, prop_type, bldg_type, district, city, maintenance_fee, status, num_baths, address, description) VALUES ($compID, $price, $sq_ft, $num_floors, $num_bdrms, $year_built, $prop_type, $bldg_type, $district, $city, $maintenance_fee, $status, $num_baths, $address, $description)";
    $result = mysqli_query($con, $sql);


}
?>