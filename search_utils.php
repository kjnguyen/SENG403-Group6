<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
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
 */
function search_listing($city, $province, $min_price, $max_price, $num_bdrm, $district, $status) {
    
    $con = getSQLConnection();
    mysqli_select_db($con, 's403_project');
    
    $city_id = get_city_id($city, $province);
    if ($city_id == NULL) {
        echo "ERROR: you must specify city and province before searching";
        mysqli_close($con);
        return NULL;
    }
    $condition_args = parse_conditions($city_id, $min_price, $max_price, $num_bdrm, $district, $status);
    $query = 'select ID, date_listed, sq_ft, num_bdrms, address, description from Listing'.$condition_args;
    $results = mysqli_query($con, $query);
    $listing_info = array();
    
    while ($row = mysqli_fetch_assoc($results)) {
        $listing_info[] = $row;
    }
    
    
    
    
    mysqli_close($con);
    return $row;
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
    $city_query = sprintf("select ID from city where name='%s' and province='%s' LIMIT 1", mysqli_real_escape_string($city), mysqli_real_escape_string($province));
    $city_result = mysqli_query($con, $city_query);
    $city_id=0;
    if (!($city_id = mysqli_fetch_assoc($city_result))) {
        $city_id=NULL;
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
    $conditions = " where city_id = $city_id and";
    if (is_numeric($min_price)) {$conditions .= " price >= $min_price and";}
    if (is_numeric($max_price)) {$conditions .= " price <= $max_price and";}
    if (is_int($num_bdrm)) {$conditions .= " num_bdrms = $num_bdrm and";}
    if ($district != NULL) {$conditions .= sprintf(" district = '%s' and", mysqli_real_escape_string($district));}
    if ($status != NULL) {$conditions .= sprintf(" status = '%s' and", mysqli_real_escape_string($status));}
    return substr($conditions, 0, -4);
}
?>