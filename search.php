<!-- Search Form (include in the header -->

<?php

//Prevent Direct Access, return 404 page not found
if(!defined("search.php"))
{
    echo '404 Not Found';
     header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found', true, 404);die();
}
?>

<form name="Search" method="get" action="search_results" id="contacts-form" style="position: absolute; top: -5px; font-size: 85%; border-style: solid; border-color: red; border-width: 2px; padding-left: 10px; padding-right: 10px; padding-top: 5px;">

<fieldset>
    <legend>Input Search Criteria (leave optional fields blank to search all)</legend><br>
        <?php
        if(!defined("search_utils.php")) {define("search_utils.php", True);}
        include_once 'search_utils.php';
        $district = "";
        $min_price = "";
        $max_price = "";
        $num_bdrm = "";
        
        if (isset($_GET['district'])){$district = $_GET['district'];}
        if (isset($_GET['min_price'])){$min_price = $_GET['min_price'];}
        if (isset($_GET['max_price'])){$max_price = $_GET['max_price'];}
        if (isset($_GET['num_bdrm'])){$num_bdrm = $_GET['num_bdrm'];}
        $cities = get_list_of_cities();
        echo '<p>City: <select name="city_id">';
        echo "<option value=\"\">Any</option>";
        if(!empty($cities)) {
            $city_id = ""; 
            if (isset($_GET['city_id'])){$city_id = $_GET['city_id'];}
            foreach ($cities as $c) {
                echo "<option value=\"".$c['ID']."\"";
                if ($c['ID'] == $city_id) {
                    echo " selected=\"selected\"";
                }
                echo ">".$c['name'].' ('.$c['province'].")</option>";
            }
        }
        echo '</select></p>';
        echo "<p>
        <label>District: </label><input type=\"text\" name=\"district\" value=\"".$district."\"/><br>
        <label>Min Price: </label><input type=\"text\" name=\"min_price\" value=\"".$min_price."\"/><br>
        <label>Max Price: </label><input type=\"text\" name=\"max_price\" value=\"".$max_price."\"/><br>
        <label>Number of Bedrooms: </label><input type=\"text\" name=\"num_bdrm\" value=\"".$num_bdrm."\"/><br>
        </p>"
         ?>
    <p>Status:
    <select name="status">
        <?php
        if(!defined("search_utils.php")) {define("search_utils.php", True);}
        include_once 'search_utils.php';
        $status = get_list_of_status();
        echo "<option value=\"\">Any</option>";
        if(!empty($status)) {
            $selected = ""; 
            if (isset($_GET['status']))  {$selected = $_GET['status'];}
            foreach ($status as $s) {
                echo "<option value=\"".$s['status']."\"";
                if ($s['status'] == $selected) {
                    echo " selected=\"selected\"";
                }
                echo ">".$s['status']."</option>";
            }
        }
        ?>
    </select></p>
    <p><button type="reset" value="Reset" class="button">Reset</button> <button type="submit" value="Search" class="button">Search</button></p>
</fieldset>

</form>


