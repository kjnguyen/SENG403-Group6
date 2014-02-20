<!-- Search Form -->

<?php

//Prevent Direct Access, return 404 page not found
if(!defined("modify.php"))
{
    echo '404 Not Found';
     header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found', true, 404);die();
}
?>

<form name="Modify" method="get" action="modify_results.php" id="contacts-form" style="position: absolute; top: 0px; font-size: 80%;">

<fieldset>
    <legend>Modify Criteria</legend><br>
        <?php
        echo "
        <p><label>ID number(required): </label><input type=\"text\" name=\"ID\" value=\"".$_GET['ID']."\"/></a></p>
        <p><label>Company ID: </label><input type=\"text\" name=\"CompID\" value=\"".$_GET['CompID']."\"/></p>
        <p><label>Price: </label><input type=\"text\" name=\"price\" value=\"".$_GET['price']."\"/></p> 
        <p><label>Square Feet: </label><input type=\"text\" name=\"sq_ft\" value=\"".$_GET['sq_ft']."\"/></p>
        <p><label>Number of Floors: </label><input type=\"text\" name=\"num_floors\" value=\"".$_GET['num_floors']."\"/></p>   
        <p><label>Number of Bedrooms: </label><input type=\"text\" name=\"num_bdrm\" value=\"".$_GET['num_bdrm']."\"/></p>
        <p><label>Number of Bathrooms: </label><input type=\"text\" name=\"num_baths\" value=\"".$_GET['num_baths']."\"/></p>
        <p><label>Year Built: </label><input type=\"text\" name=\"year_built\" value=\"".$_GET['year_built']."\"/></p>
        <p><label>Property Type: </label><input type=\"text\" name=\"prop_type\" value=\"".$_GET['prop_type']."\"/></p> 
        <p><label>Building Type: </label><input type=\"text\" name=\"bldg_type\" value=\"".$_GET['bldg_type']."\"/></p>    
        <p><label>District: </label><input type=\"text\" name=\"district\" value=\"".$_GET['district']."\"/></p>
        <p><label>Maintenance: </label><input type=\"text\" maintenance=\"city\" value=\"".$_GET['maintenance']."\"/></p> 
        <p><label>Address: </label><input type=\"text\" name=\"address\" value=\"".$_GET['address']."\"/></p>    
        <p><label>Description: </label><input type=\"text\" name=\"description\" value=\"".$_GET['description']."\"/></p>    

         "
         ?>
    <p>Status:
    <select name="status">
        <?php
        define("modify_utils.php", True);
        include_once 'modify_utils.php';
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