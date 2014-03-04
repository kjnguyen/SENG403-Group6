<?php

if(!defined("postlisting.php"))
{
    echo '404 Not Found';
     header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found', true, 404);die();
}

define("mysqlcon.php", True);
include_once '../mysqlcon.php';


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
    echo mysqli_error($con);
    if ($ID_array = mysqli_fetch_assoc($city_result)) {
        $cityID = $ID_array['ID'];
    }
    if ($cityID == 0) {
        $new_city = sprintf("insert into City (name, province, country) values ('%s', '%s', 'Canada')", mysqli_real_escape_string($con, $city), mysqli_real_escape_string($con, $province));
        mysqli_query($con, $new_city);
        echo mysqli_error($con);
        $cityID = mysqli_insert_id($con);
    }

    $sql = sprintf("INSERT INTO Listing (CompID, price, sq_ft, num_floors, num_bdrms, "
            . "year_built, prop_type, bldg_type, district, cityID, maintenance_fee, status, num_baths, address, description) "
            . "VALUES ($compID, $price, $sq_ft, $num_floors, $num_bdrms, $year_built, '$prop_type', '$bldg_type', '$district', "
            . "$cityID, $maintenance_fee, '$status', $num_baths, '%s', '%s')", mysqli_real_escape_string($con, $address), mysqli_real_escape_string($con, $description));
    echo mysqli_query($con);
    mysqli_query($con, $sql);


}

function postlisting_secure($compID, 
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
    $city_query = sprintf("select ID from City where lower(name)=lower('%s') and lower(province)=lower('%s') LIMIT 1", 
            mysqli_real_escape_string($con, $city), mysqli_real_escape_string($con, $province));

    $city_result = mysqli_query($con, $city_query);
    echo mysqli_error($con);
    if ($ID_array = mysqli_fetch_assoc($city_result)) {
        $cityID = $ID_array['ID'];
    }
    if ($cityID == 0) {
        $new_city = "insert into City (name, province, country) values (?, ?, 'Canada')";
        if ($stmt = mysqli_prepare($con, $new_city)) {
            $stmt->bind_param('ss', $city, $province);
            if(!($stmt->execute())) {goto funcError;}
            $cityID = $stmt->insert_id;
            $stmt->close();
        }
        else {goto funcError;}
    }

    $sql = "INSERT INTO Listing (CompID, price, sq_ft, num_floors, num_bdrms, year_built, prop_type, bldg_type, district, cityID, maintenance_fee, status, num_baths, address, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    if ($stmt2 = mysqli_prepare($con, $sql)) {
        $stmt2->bind_param('iddiiisssidsiss', $compID,  $price, $sq_ft, $num_floors, $num_bdrms, $year_built, $prop_type, $bldg_type, $district, $cityID,
                $maintenance_fee, $status, $num_baths, $address, $description);
        if(!($stmt2->execute())) {goto funcError;}
        $stmt2->close();
    }
    else {goto funcError;}
    return True;
    funcError:
    mysqli_close($con);
    return False;

}
?>