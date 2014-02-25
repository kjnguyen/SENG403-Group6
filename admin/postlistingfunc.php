<?php

if(!defined("postlisting.php"))
{
    echo '404 Not Found';
     header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found', true, 404);die();
}

define("mysqlcon.php", True);
include_once 'mysqlcon.php';

function postlisting($compID, 
        $price, 
        $sq_ft, 
        $num_floors, 
        $num_bdrms, 
        $year_built, 
        $prop_type, 
        $bldg_type, 
        $district, 
        $city, 
        $province,
        $maintenance_fee, 
        $status, 
        $num_baths, 
        $address, 
        $description){

    $con = getSQLConnection();

    mysqli_select_db($con, 's403_project');
    $cityID = 0;
    // if city/province exist, use the cityID; if not, create new city/province entry first
    $city_query = "select ID from City where lower(name)=lower('$city') and lower(province)=lower('$province') LIMIT 1";

    $city_result = mysqli_query($con, $city_query);
//    echo mysqli_error($con);
    if ($ID_array = mysqli_fetch_assoc($city_result)) {
        $cityID = $ID_array['ID'];
    }
    if ($cityID == 0) {
        $new_city = "insert into City (name, province, country) values ('$city', '$province', 'Canada')";
        msqli_query($con, $new_city);
        $cityID = mysqli_insert_id($con);
    }

    $sql = "INSERT INTO Listing (CompID, price, sq_ft, num_floors, num_bdrms, year_built, prop_type, bldg_type, district, cityID, maintenance_fee, status, num_baths, address, description) VALUES ($compID, $price, $sq_ft, $num_floors, $num_bdrms, $year_built, '$prop_type', '$bldg_type', '$district', $cityID, $maintenance_fee, '$status', $num_baths, '$address', '$description')";
    $result = mysqli_query($con, $sql);


}
?>