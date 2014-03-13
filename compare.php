<?php

include_once "header.php";


?>
<section id="content">
<div class="container_16">
<div class="clearfix">
<section id="mainContent" class="grid_10" style="position: relative; width: 100%;">
<article style="position: relative; width: 100%;">
<style>
table,th,td
{
border:2px solid red;
border-collapse:collapse;
padding:5px;
}
th,td
{
padding:5px;
}
th
{
text-align:left;
}
table
{
border-spacing:15px;
}
</style>
<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if(!defined("search_utils.php")) {define("search_utils.php", True);}
include_once 'search_utils.php';

$compareItems = array();

if (isset($_GET['compareItem1'])) {$compareItems[] = search_one_item(intval($_GET['compareItem1']));}
if (isset($_GET['compareItem2'])) {$compareItems[] = search_one_item(intval($_GET['compareItem2']));}
if (isset($_GET['compareItem3'])) {$compareItems[] = search_one_item(intval($_GET['compareItem3']));}
if (isset($_GET['compareItem4'])) {$compareItems[] = search_one_item(intval($_GET['compareItem4']));}
if (isset($_GET['compareItem5'])) {$compareItems[] = search_one_item(intval($_GET['compareItem5']));}

$itemCount = count($compareItems);
if ($itemCount == 0) {
    echo 'Nothing to compare!';
    die();
}

$fields_map = array(
    'price' => 'Price($)',
    'date_listed' => 'Lising Date',
    'sq_ft' => 'Area(sqft)',
    'num_floors' => 'Floors',
    'num_bdrms' => 'Bedrooms',
    'num_baths' => 'Baths',
    'year_built' => 'Built in',
    'prop_type' => 'Property Type',
    'bldg_type' => 'Building Type',
    'district' => 'District',
    'maintenance_fee' => 'Maitenance($)',
    'status' => 'Status',
    'address' => 'Address',
    'c_name' => 'Company'
    
);


echo '<table style="width:500px">';
echo '<tr>';
echo '<th>Fields</th>';
for ($i = 0; $i < $itemCount; $i ++) {
    echo '<th>';
    echo '<a href=item.php?ID="'.$compareItems[$i]['ID'].'" rel="0"><img src="images/f_thumb1.png" alt=""></a>';
    echo '</th>';
    unset($compareItems[$i]['ID']);
    unset($compareItems[$i]['description']);
    unset($compareItems[$i]['CompID']);
    unset($compareItems[$i]['cityID']);
    unset($compareItems[$i]['c_address']);
    unset($compareItems[$i]['c_manager_name']);
    unset($compareItems[$i]['c_phone_no']);
}
echo '</tr>';
foreach ($compareItems[0] as $key => $item){
    
    echo '<tr>';
    echo '<td>'.$fields_map[$key].'</td>';
    for ($i = 0; $i < $itemCount; $i ++) {
        echo '<td>';
        echo $compareItems[$i][$key];
        echo '</td>';
    }
    echo '</tr>';
}
echo '<tr>';




echo '</table>';

?>
</article>
</section>
</div>
</div>
</section>
<?php
    include_once "footer.php";
?>