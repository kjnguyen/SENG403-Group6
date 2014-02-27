<?php
    define("INCLUDE_FILE", true);
    include('header.php');
    
    //Do not output anything before this line (Do not use echo or html code)
    //---------------------------------------------------
?>

<!-- *****************************************************************************-->
<div>
    <ul class="breadcrumb">
        <li>
            <a href="#">Home</a> <span class="divider">/</span>
        </li>
        <li>
            <a href="#">Blank</a>
        </li>
    </ul>
</div>
 <?php

    define("modify_utils.php", True);
    include_once 'modify_utils.php';


    $id = $_POST['ID'];
    $CompID = $_POST['CompID'];
    $price = $_POST['price'];
    $sq_ft = $_POST['sq_ft'];                         
    $num_floors = $_POST['num_floors'];
    $num_bdrms = $_POST['num_bdrms'];
    $num_baths = $_POST['num_baths'];
    $year_built = $_POST['year_built'];
    $prop_type = $_POST['prop_type'];
    $bldg_type = $_POST['bldg_type'];
    $district = $_POST['district'];
    $maintenance_fee = $_POST['maintenance_fee'];
    $status = $_POST['status'];  
    $address = $_POST['address'];
    $description = $_POST['description'];

    $success = True;
    if ($error_msg = is_modify_invalid($id, $price, $sq_ft, $num_floors, 
            $num_bdrms, $num_baths, $year_built, $prop_type, $bldg_type, 
            $maintenance_fee, $status, $address)) {
        echo '<div class="alert alert-error">ERROR: <br>'.$error_msg.'</div>';
        $success = False;
        goto EXEFinished; 
    }

  /*  mysql_connect("$host","$user", "$pass")or die("cannot connect");  
    mysql_select_db("$db")or die("cannot select DB");  */


    $results_array = modify_values($id,$CompID, $price, $sq_ft, $num_floors, 
            $num_bdrms, $num_baths, $year_built, $prop_type, $bldg_type, 
            $district, $maintenance_fee, $status, $address, $description);
    if($results_array){
        echo "Error: An $results_array<br>";
    }	

    echo '<div class="alert alert alert-success">';
    echo 'Listing successfully modified';
    echo '</div>';

    include_once './pictureUploader.php';
EXEFinished:
    if ($success) {
        echo '<a href="index.php" class="btn btn-info">Go Back</a>';
    }
    else {
        echo
        '<script>
        function goBack()
          {
          window.history.back()
          }
        </script>
        <button class="btn btn-info" onclick="goBack()">Go Back</button>
        ';
    }

    /**
     * Input validation function
     * @param type $id
     * @param type $price
     * @param type $sq_ft
     * @param type $num_floors
     * @param type $num_bdrms
     * @param type $num_baths
     * @param type $year_built
     * @param type $prop_type
     * @param type $bldg_type
     * @param type $maintenance_fee
     * @param type $status
     * @param type $address
     * @return string|null
     */
    function is_modify_invalid($id, $price, $sq_ft, $num_floors, 
            $num_bdrms, $num_baths, $year_built, $prop_type, $bldg_type, 
            $maintenance_fee, $status, $address) {
        $valid = True;
        $error_msg = "";
        if(!$ID){
            $valid = False;
            $error_msg .= "* Missing Listing ID<br>";
        }
        if(!$price){
            $valid = False;
            $error_msg .= "* Price is required<br>";
        }
        else {
            if (!is_numeric($price)) {
                $valid = False;
                $error_msg .= "* Price must be numeric<br>";
            }
        }
        if(!$sq_ft){
            $valid = False;
            $error_msg .= "Size is required<br>";
        }
        else {
            if (!is_numeric($sq_ft)) {
                $valid = False;
                $error_msg .= "* Size must be numeric<br>";
            }
        }
        if($num_floors){
            $i = intval($num_floors);
            if ("$i" != "$num_floors") {
                $valid = False;
                $error_msg .= "* Floors number must be integer<br>";
            }

        }

        if($num_bdrms){
            $i = intval($num_bdrms);
            if ("$i" != "$num_bdrms") {
                $valid = False;
                $error_msg .= "* Bedrooms number must be integer<br>";
            }
        }
        if($num_baths){
            $i = intval($num_baths);
            if ("$i" != "$num_baths") {
                $valid = False;
                $error_msg .= "* Baths number must be integer<br>";
            }
        }

        if($year_built){
            $i = intval($year_built);
            if ("$i" != "$year_built") {
                $valid = False;
                $error_msg .= "* $year_built is not a valid year<br>";
            }
        }

        if(!$prop_type){
            $valid = False;
            $error_msg .= "Property type is required";
        }
        if(!$bldg_type){
            $valid = False;
            $error_msg .= "Building type is required";
        }
        if($maintenance_fee){
            if (!is_numeric($maintenance_fee)) {
                $valid = False;
                $error_msg .= "* Maintenance fee must be numeric<br>";
            }
        }
        if(!$status){
            $valid = False;
            $error_msg .= "Status is required";
        }
        if(!$address){
            $valid = False;
            $error_msg .= "Address/location is required";
        }


        if (!$valid) {
            return $error_msg;
        }
        return NULL;


    }
?>




<?php
    include_once "footer.php";
?>
