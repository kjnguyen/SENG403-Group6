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
//    echo mysqli_error($con);
    $listing_info = array();
    
    while ($row = mysqli_fetch_assoc($results)) {
        $listing_info[] = $row;
    }    
    mysqli_close($con);
    return $listing_info;
}

/**
 * Get all listings created by a specific company
 * @param type $company_id
 * @return array of ['ID', 'address']
 */
function search_company_listing($company_id) {
    
    $con = getSQLConnection();
    mysqli_select_db($con, 's403_project');
    

    $query = "select ID, address from Listing where CompID = $company_id";
//    echo $query;
    $results = mysqli_query($con, $query);
//    echo mysqli_error($con);
    $listing_info = array();
    
    while ($row = mysqli_fetch_assoc($results)) {
        $listing_info[] = $row;
    }    
    mysqli_close($con);
    return $listing_info;
}

function search_company_employee($company_id) {
    $con = getSQLConnection();
    mysqli_select_db($con, 's403_project');
    

    $query = "select e.ID, name, phone_no, email, username from Employee as e join User as u on e.ID = u.ID where compID = $company_id";
//    echo $query;
    $results = mysqli_query($con, $query);
//    echo mysqli_error($con);
    $employees = array();
    
    while ($row = mysqli_fetch_assoc($results)) {
        $employees[] = $row;
    }    
    mysqli_close($con);
    return $employees;
}

/**
 * Get the company id for an employee (assuming user has correct permission)
 * 
 * @param int $user_id
 * @return $compID if successful
 */
function get_company_id($user_id) {
    $con = getSQLConnection();
    mysqli_select_db($con, 's403_project');
    
    $query = "select compID from Employee where ID = $user_id LIMIT 1";
    $results = mysqli_query($con, $query);
    if ($row = mysqli_fetch_assoc($results)) {
        $compID = $row['compID'];
        return $compID;
    }
    else {
        return NULL;
    }
}

/**
 * Get all companies
 * @return array of ['ID', 'name', 'manager_name', 'phone_no']
 */
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
 * Get all details (including its company info) of one item
 * @param type $ID
 * @return array of ['...all columns of listing...', 'c_name', 'c_address', 'c_manager_name', 'c_phone_no']
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
 * Get city's ID
 * @param string $city
 * @param string $province
 * @return int cityID
 */
function get_city_id($city, $province) {
    $con = getSQLConnection();
    mysqli_select_db($con, 's403_project');
    if (!isset($city) || !isset($province)) {goto funcFinished;}
    $city_query = sprintf("select ID from City where lower(name)=lower('%s') and lower(province)=lower('%s') LIMIT 1", 
            $city, $province);
    $city_result = mysqli_query($con, $city_query);
    mysqli_close($con);
//    echo mysqli_error($con);
    if ($ID_array = mysqli_fetch_assoc($city_result)) {
        return $ID_array['ID'];
    } 
    funcFinished:
    return NULL;
}

/**
 * Generate dynamic conditions for select statement 
 * @param int $city_id
 * @param double $min_price
 * @param double $max_price
 * @param int $num_bdrm
 * @param string $district
 * @param string $status
 * @return string
 */
function parse_conditions($city_id, $min_price, $max_price, $num_bdrm, $district, $status) {
    $conditions = " where cityID = $city_id and";
    if (is_numeric($min_price)) {$conditions .= " price >= $min_price and";}
    if (is_numeric($max_price)) {$conditions .= " price <= $max_price and";}
    if (is_numeric($num_bdrm)) {$conditions .= " num_bdrms = $num_bdrm and";}
    if (isset($district) && $district != '') {$conditions .= sprintf(" lower(district) = lower('%s') and", $district);}
    if (isset($status) && $status != '') {$conditions .= sprintf(" lower(status) = lower('%s') and", $status);}
    return substr($conditions, 0, -4);
}

/**
 * Get a list of all possible status of listings
 * @return array of ['status']
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