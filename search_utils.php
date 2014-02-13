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
        echo "<br> Example URL: <br>";
        echo "http://www.s403.jack-l.com/search_results.php?city=Calgary&province=Alberta&max_price=200000<br>";
        mysqli_close($con);
        return NULL;
    }
    $condition_args = parse_conditions($city_id, $min_price, $max_price, $num_bdrm, $district, $status);
    $query = 'select ID, date_listed, sq_ft, num_bdrms, address, description from Listing'.$condition_args;
    echo $query;
    $results = mysqli_query($con, $query);
    echo mysqli_error($con);
    $listing_info = array();
    
    while ($row = mysqli_fetch_assoc($results)) {
        $listing_info[] = $row;
    }    
    mysqli_close($con);
    return $listing_info;
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
    $city_query = "select ID from City where lower(name)=lower('$city') and lower(province)=lower('$province') LIMIT 1";

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
    if (is_int($num_bdrm)) {$conditions .= " num_bdrms = $num_bdrm and";}
    if ($district != NULL) {$conditions .= " lower(district) = lower('$district') and";}
    if ($status != NULL) {$conditions .= " lower(status) = lower('$status') and";}
    return substr($conditions, 0, -4);
}
?>