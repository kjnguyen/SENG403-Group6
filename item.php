<?php
    //Start session
    session_start();
?>

<!-- Item page
to-do: find a better way to handle this - I only need part of the header-->

<!DOCTYPE html>
<html lang="en">
<head>
	<title></title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="template/css/reset.css" type="text/css" media="all">
	<link rel="stylesheet" href="template/css/grid.css" type="text/css" media="all">
	<link rel="stylesheet" href="template/css/style.css" type="text/css" media="all">
	<script type="text/javascript" src="template/js/jquery-1.4.2.min.js" ></script>
	<script type="text/javascript" src="template/js/cufon-yui.js"></script>
	<script type="text/javascript" src="template/js/Myriad_Pro_italic_400-Myriad_Pro_italic_600.font.js"></script>
	<script type="text/javascript" src="template/js/cufon-replace.js"></script>	
	<script type="text/javascript" src="template/js/jquery.faded.js"></script>
	<script type="text/javascript" src="template/js/script.js"></script>
	<!--[if lt IE 7]>
		<link rel="stylesheet" href="template/css/ie/ie6.css" type="text/css" media="screen">
		<script type="text/javascript" src="template/js/ie_png.js"></script>
		<script type="text/javascript">
				ie_png.fix('.png, .logo, .extra-banner');
		</script>
	<![endif]-->
	<!--[if lt IE 9]>
		<script type="text/javascript" src="template/js/html5.js"></script>
	<![endif]-->
</head>

<body>
<header>
    <div class="container_16">
        <div class="logo">
            <h1><a href="index.php"><strong>Real</strong> Estate</a></h1>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
            </ul>
        </nav>
<?php
define("search_utils.php", True);
include_once 'search_utils.php';
$ID = $_GET['ID'];
$item_found = True;
if ($ID == NULL) {
     $item_found = False;
}
else {
    $item = search_one_item($ID);
    if ($item == NULL) {
        $item_found = False;
    }
}
// following part are place-holder for pictures
echo '
        <!-- faded slider begin -->
        <div id="faded">
            <div class="rap">
                <a href="#"><img src="images/big-img1.jpg" alt="" width="571" height="398"></a>
                <a href="#"><img src="images/big-img2.jpg" alt="" width="571" height="398"></a>
                <a href="#"><img src="images/big-img3.jpg" alt="" width="571" height="398"></a>
            </div>
            <ul class="pagination">
                <li>
                    <a href="#" rel="0">
                        <img src="images/f_thumb1.png" alt="">
                                    Pictures Place-Holder
                    </a>
                </li>
                <li>
                    <a href="#" rel="1">
                        <img src="images/f_thumb2.png" alt="">
                                    Pictures Place-Holder
                    </a>
                </li>
                <li>
                    <a href="#" rel="2">
                        <img src="images/f_thumb3.png" alt="">
                                    Pictures Place-Holder
                    </a>
                </li>
            </ul>
        </div>
        <!-- faded slider end -->
    </div>
</header>
    
<section id="content">
    <div class="container_16">
        <div class="clearfix">
            <section id="mainContent" class="grid_10" style="position: relative; width: 100%;">
                <article style="position: relative; width: 100%;">
                        <h2>Item Details</h2>
                        <a href=”#” onClick=”Javascript:history.back();”>GO back (do not click this, javascript is not working, just click the browser "BACK" button</a><br>
';
                                                       
                        if (!$item_found) {
                            echo "Item Not Found!";
                        }
                        else {
                            echo 'Price: $'.$item['price'].'</br>';
                            echo "Date Listed: ".$item['date_listed'].'</br>';
                            echo "Size: ".$item['sq_ft'].' Sqr Ft. </br>';
                            echo "Floors: ".$item['num_floors'].'</br>';
                            echo "Bedrooms: ".$item['num_bdrms'].'</br>';
                            echo "Baths: ".$item['num_baths'].'</br>';
                            echo "Year Built: ".$item['year_built'].'</br>';
                            echo "Property Type: ".$item['prop_type'].'</br>';
                            echo "Building Type: ".$item['bldg_type'].'</br>';
                            echo "Maintenance Fee: ".$item['maintenance_fee'].'</br>';
                            echo "Status: ".$item['status'].'</br>';
                            echo "Address: ".$item['address'].'</br>';
                            echo "Description: ".$item['description'].'</br>';
                            
                            echo '<div id="faded" style="position: relative; width: 100%;">
                                  <ul class="pagination" style="position: relative; top: 0px; left: 0px;">';
                            echo '<label>Realtor Contact Info</label><br>';
                            echo "Company: ".$item['c_name'].'</br>';
                            echo "Address: ".$item['c_address'].'</br>';
                            echo "Manager: ".$item['c_manager_name'].'</br>';
                            echo "Phone: ".$item['c_phone_no'].'</br>';
                            echo '</ul></div>';

                        }
                        




                        ?>


                </article>
            </section>
        </div>
    </div>
</section>
<?php


?>

<?php
    include_once "footer.php";
?>
