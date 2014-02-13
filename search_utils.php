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
    
    
    
    mysqli_close($con);
}

function get_city_id($city, $province) {
    $con = getSQLConnection();
    mysqli_select_db($con, 's403_project');
    $city_query = sprintf("select ID from city where name='%s' and province='%s' LIMIT 1", mysqli_real_escape_string($city), mysqli_real_escape_string($province));
    $city_result = mysqli_query($con, $city_query);
    $city_id=0;
    if (!($city_id = mysqli_fetch_assoc($city_result))) {
        $city_id=0;
    }
    mysqli_close($con);
    return $city_id;
}

function parse_conditions($min_price, $max_price, $num_bdrm, $district, $status) {
    $conditions = "";
    if ($min_price != NULL) $condition .= "price ";
}
?>