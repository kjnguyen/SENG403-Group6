<?php

    define("postlisting.php", True);
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
        
        if ($compID == NULL) {
            echo "Permission denied";
            
            die();
        }
        else {
            postlisting($compID, $price, $sq_ft, $num_floors,$num_bdrms, $year_built, 
            $prop_type, $bldg_type, $district, $city, $province,
            $maintenance_fee, $status, $num_baths, $address, $description);
            header("Location: index.php");
            exit();
        }
    }

?>