<?php

if(!defined("postlisting.php"))
{
    echo '404 Not Found';
     header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found', true, 404);die();
}

define("mysqlcon.php", True);
include_once '../mysqlcon.php';



/**
 * Add one listing
 * @param int $compID
 * @param double $price
 * @param double $sq_ft
 * @param int $num_floors
 * @param int $num_bdrms
 * @param int $year_built
 * @param string $prop_type
 * @param string $bldg_type
 * @param string $district
 * @param string $city
 * @param string $province
 * @param double $maintenance_fee
 * @param string $status
 * @param int $num_baths
 * @param string $address
 * @param string $description
 * @return boolean - True if successful, False if not
 */
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

function check_createListing_permission($current_compID){
    
    if (!isset($_SESSION['Authed_UserID'])){
       // echo "<br>Must be logged in to modify listings.<br>"
        return 0;
    }
    //admin status - permission allowed 
    if ($_SESSION['Authed_Permission'] == 1 ){
        return 1;
    }
    //company status -  if listing belogns to the company permission allowed
    if ($_SESSION['Authed_Permission'] == 2 ){
        $compID = $_SESSION['Authed_UserID'];
    }
    else if ($_SESSION['Authed_Permission'] == 3)
    {
        if(!defined("search_utils.php")) {define("search_utils.php", True);}
        include_once '../search_utils.php';
        $compID = get_company_id($_SESSION['Authed_UserID']);
    }
    else{
        return 0;
    }
    return ($compID == $current_compID);

}
?>