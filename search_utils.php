<?php
// This file hosts all the search functions


//Prevent Direct Access, return 404 page not found
if(!defined("search_utils.php"))
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
include_once 'mysqlcon.php';

/**
 * $city and $province is mandatory, will return error if they are not provided
 * 
 * @param type $city
 * @param type $province
 * @param type $min_price
 * @param type $max_price
 * @param type $num_bdrm
 * @param type $district
 * @param type $status
 * 
 */
function search_listing($city, $province, $min_price, $max_price, $num_bdrm, $district, $status) {
    
    $con = getSQLConnection();
    mysqli_select_db($con, 's403_project');
    
    $city_id = get_city_id($city, $province);
    if ($city_id == NULL) {
        echo "ERROR: you must specify a valid city and province, try calgary/alberta";
//        echo "<br> Example URL: <br>";
//        echo "http://www.s403.jack-l.com/search_results.php?city=Calgary&province=Alberta&max_price=200000<br>";
        mysqli_close($con);
        return NULL;
    }
    $condition_args = parse_conditions($city_id, $min_price, $max_price, $num_bdrm, $district, $status);
    $query = 'select ID, date_listed, sq_ft, price, num_bdrms, address, description from Listing'.$condition_args;
//    echo $query;
    $results = mysqli_query($con, $query);
    echo mysqli_error($con);
    $listing_info = array();
    
    while ($row = mysqli_fetch_assoc($results)) {
        $listing_info[] = $row;
    }    
    mysqli_close($con);
    return $listing_info;
}

function search_company_listing($company_id) {
    
    $con = getSQLConnection();
    mysqli_select_db($con, 's403_project');
    

    $query = "select ID, address from Listing where CompID = $company_id";
//    echo $query;
    $results = mysqli_query($con, $query);
    echo mysqli_error($con);
    $listing_info = array();
    
    while ($row = mysqli_fetch_assoc($results)) {
        $listing_info[] = $row;
    }    
    mysqli_close($con);
    return $listing_info;
}

function get_company_id($user_id, $type_id) {
    
}

function get_all_companies() {
    $con = getSQLConnection();
    mysqli_select_db($con, 's403_project');
    $query = "select ID, name, manager_name, phone_no from Company";
        $results = mysqli_query($con, $query);
    echo mysqli_error($con);
    $companies = array();
    
    while ($row = mysqli_fetch_assoc($results)) {
        $companies[] = $row;
    }    
    mysqli_close($con);
    return $companies;
}
/**
 * 
 * @param type $ID
 * @return null
 */
function search_one_item($ID) {
    $con = getSQLConnection();
    mysqli_select_db($con, 's403_project');
    $query = "select l.*, c.name as c_name, c.address as c_address, c.manager_name as c_manager_name, c.phone_no as c_phone_no from Listing as l join Company as c on l.CompID = c.ID where l.ID = $ID";
    $result = mysqli_query($con, $query);
    mysqli_close($con);
    if ($row = mysqli_fetch_assoc($result)){
        return $row;
    }
    else {
        return NULL;
    }
}

/**
 * 
 * @param type $city
 * @param type $province
 * @return null
 */
function get_city_id($city, $province) {
    $con = getSQLConnection();
    mysqli_select_db($con, 's403_project');
    $city_query = sprintf("select ID from City where lower(name)=lower('%s') and lower(province)=lower('%s') LIMIT 1", mysql_real_escape_string($city), mysql_real_escape_string($province));

    $city_result = mysqli_query($con, $city_query);
//    echo mysqli_error($con);
    $city_id=NULL;
    if ($ID_array = mysqli_fetch_assoc($city_result)) {
        $city_id = $ID_array['ID'];
    }

    
    mysqli_close($con);
    return $city_id;
}

/**
 * 
 * @param type $city_id
 * @param type $min_price
 * @param type $max_price
 * @param type $num_bdrm
 * @param type $district
 * @param type $status
 * @return type
 */
function parse_conditions($city_id, $min_price, $max_price, $num_bdrm, $district, $status) {
    $conditions = " where cityID = $city_id and";
    if (is_numeric($min_price)) {$conditions .= " price >= $min_price and";}
    if (is_numeric($max_price)) {$conditions .= " price <= $max_price and";}
    if (is_numeric($num_bdrm)) {$conditions .= " num_bdrms = $num_bdrm and";}
    if ($district != NULL) {$conditions .= sprintf(" lower(district) = lower('%s') and", mysql_real_escape_string($district));}
    if ($status != NULL) {$conditions .= sprintf(" lower(status) = lower('%s') and", mysql_real_escape_string($status));}
    return substr($conditions, 0, -4);
}

/**
 * 
 * @return type
 */
function get_list_of_status() {
    $con = getSQLConnection();
    mysqli_select_db($con, 's403_project');
    $query = "select distinct status from Listing";
    $results = mysqli_query($con, $query);
    echo mysqli_error($con);
    $status = array();
    
    while ($row = mysqli_fetch_assoc($results)) {
        $status[] = $row;
    }
    mysqli_close($con);
    return $status;
}
?>