<!-- Search Form -->

<?php

//Prevent Direct Access, return 404 page not found
if(!defined("search.php"))
{
    echo '404 Not Found';
     header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found', true, 404);die();
}
?>

<form name="Search" method="get" action="search_results" id="contacts-form" style="position: absolute; top: 0px; font-size: 80%;">

<fieldset>
    <legend>Input Search Criteria (leave optional fields blank to search all)</legend><br>
        <?php
        echo "
        <p><label>Province (full name) (Required): </label><input type=\"text\" name=\"province\" value=\"".$_GET['province']."\"/></a></p>
        <p><label>City (Required): </label><input type=\"text\" name=\"city\" value=\"".$_GET['city']."\"/></p>
        <p><label>District: </label><input type=\"text\" name=\"district\" value=\"".$_GET['district']."\"/></p>
        <p><label>Min Price: </label><input type=\"text\" name=\"min_price\" value=\"".$_GET['min_price']."\"/></p>
        <p><label>Max Price: </label><input type=\"text\" name=\"max_price\" value=\"".$_GET['max_price']."\"/></li>
        <p><label>Number of Bedrooms: </label><input type=\"text\" name=\"num_bdrm\" value=\"".$_GET['num_bdrm']."\"/></p>
         "
         ?>
    <p>Status:
    <select name="status">
        <?php
        define("search_utils.php", True);
        include_once 'search_utils.php';
        $status = get_list_of_status();
        echo "<option value=\"\">Any</option>";
        if(!empty($status)) {
            $selected = $_GET['status'];
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


