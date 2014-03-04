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

    if(!defined("postlisting.php")) {define("postlisting.php", True);}
    include_once 'postlistingfunc.php';
    
    if($_POST['process_add_listing'] == 'true') {
        $compID = $_POST['compID'];
        $price = $_POST['price'];
        $sq_ft = $_POST['sq_ft'];
        $num_floors = $_POST['num_floors'];
        $num_bdrms = $_POST['num_bdrms'];
        $year_built = $_POST['year_built'];
        $prop_type = $_POST['prop_type'];
        $bldg_type = $_POST['bldg_type'];
        $district = $_POST['district'];
        $city = $_POST['city'];
        $province = $_POST['province'];
        $maintenance_fee = $_POST['maintenance_fee'];
        $status = $_POST['status'];
        $num_baths = $_POST['num_baths'];
        $address = $_POST['address'];
        $description = $_POST['description'];
        
//        echo $compID;
//        echo $price;
//        echo $sq_ft;
//        echo $num_floors;
//        echo $num_bdrms;
//        echo $year_built;
//        echo $prop_type;
//        echo $bldg_type;
//        echo $district;
//        echo $city;
//        echo $province;
//        echo $maintenance_fee;
//        echo $status;
//        echo $num_baths;
//        echo $address;
//        echo $description;
        $success = True;
        if ($compID == NULL) {
            echo "Permission denied";
            $success = False;
            goto EXEFinished; 
        }
        if ($error_msg = is_create_invalid($compID, $price, $sq_ft, $num_floors,$num_bdrms, $year_built, 
                        $prop_type, $bldg_type, $city, $province,
                        $maintenance_fee, $status, $num_baths, $address)) {
            echo '<div class="alert alert-error">ERROR: <br>'.$error_msg.'</div>';
            $success = False;
            goto EXEFinished; 
        }
        
        
        $success = postlisting_secure($compID, $price, $sq_ft, $num_floors,$num_bdrms, $year_built, 
        $prop_type, $bldg_type, $district, $city, $province,
        $maintenance_fee, $status, $num_baths, $address, $description);
        if (!$success) {
            echo '<div class="alert alert-error">ERROR: <br> Database operation failed</div>';
            goto EXEFinished;
        }
        echo '<div class="alert alert alert-success">';
        echo 'Listing successfully created';
        echo '</div>';

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

    }
    
    function is_create_invalid($compID, $price, $sq_ft, $num_floors,$num_bdrms, $year_built, 
            $prop_type, $bldg_type, $city, $province,
            $maintenance_fee, $status, $num_baths, $address){
        $valid = True;
        $error_msg = "";
        if(!$compID){
            $valid = False;
            $error_msg .= "* Missing Company ID<br>";
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
            $error_msg .= "* Size is required<br>";
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
            $error_msg .= "* Property type is required<br>";
        }
        if(!$bldg_type){
            $valid = False;
            $error_msg .= "* Building type is required<br>";
        }
        if(!$city){
            $valid = False;
            $error_msg .= "* City/Town is required<br>";
        }
        if(!$province){
            $valid = False;
            $error_msg .= "* Province/State is required<br>";
        }
        if($maintenance_fee){
            if (!is_numeric($maintenance_fee)) {
                $valid = False;
                $error_msg .= "* Maintenance fee must be numeric<br>";
            }
        }
        if(!$status){
            $valid = False;
            $error_msg .= "* Status is required<br>";
        }
        if(!$address){
            $valid = False;
            $error_msg .= "* Address/location is required<br>";
        }


        if (!$valid) {
            return $error_msg;
        }
        return NULL;
    }

?>