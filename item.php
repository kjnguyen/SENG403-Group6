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
            <h1><a href="index.php"><strong>4J</strong> Estates</a></h1>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
            </ul>
        </nav>

<?php
if(!defined("search_utils.php")) {define("search_utils.php", True);}
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

include "picturesLib.php";

$con = getSQLConnection();
$pictureList = getPictures($con, intval($ID));
mysqli_close($con);
// following part are place-holder for pictures
echo '
        <!-- faded slider begin -->
        <div id="faded">
            <div class="rap">';
if($pictureList !== false && !empty($pictureList))
{
  foreach($pictureList as $pic)
  {
    echo '<a href="#"><img src="' . $pic["path"] . '" alt="" width="571" height="398"></a>';
  }
}
else
{
   echo '       <a href="#"><img src="images/big-img1.jpg" alt="" width="571" height="398"></a>
                <a href="#"><img src="images/big-img2.jpg" alt="" width="571" height="398"></a>
                <a href="#"><img src="images/big-img3.jpg" alt="" width="571" height="398"></a>';
}
echo        '</div>
            <ul class="pagination">
                ';
if($pictureList !== false && !empty($pictureList))
{
  $i = 0;
  foreach($pictureList as $pic)
  {
    echo '<li>
                      <a href="#" rel="' . $i . '">
                        <img src="' . $pic["path"] . '" alt="" width="93" height="84">
                                      Picture '. ($i+1) . '
                      </a>
                  </li>';
    $i++;
  }
  
}
else
{
  echo '    <li>
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
                </li>';
}
    echo '
            </ul>
        </div>
        <!-- faded slider end -->
    </div>
</header>
';
    if(!defined("compare_chooser.php")) {define("compare_chooser.php", True);}
    include 'compare_chooser.php';
    echo '
<section id="content">
    <div class="container_16">
        <div class="clearfix">
            <section id="mainContent" class="grid_10" style="position: relative; width: 100%;">
                <article style="position: relative; width: 100%;">
                        <h2>Item Details</h2>

';
                               
                        
                                       
                        if (!$item_found) {
                            echo "Item Not Found!";
                        }
                        else {
                            echo '<p><form name="addCompareItem" method="post"><input type="hidden" name="compareItemID" value="'.$item['ID'].'"/>'
                            . '<button name="addCompareItem" type="submit" value="addCompare">Add this item to comparison list</button></form></p>';
                            echo '<p><h4>Price: </h4>&nbsp&nbsp $'.$item['price'].'</p>';
                            echo "<p><h4>Date Listed: </h4>&nbsp&nbsp".$item['date_listed'].'</p>';
                            echo "<p><h4>Size: </h4>&nbsp&nbsp".$item['sq_ft'].' Sqr Ft. </p>';
                            echo "<p><h4>Floors: </h4>&nbsp&nbsp".$item['num_floors'].'</p>';
                            echo "<p><h4>Bedrooms: </h4>&nbsp&nbsp".$item['num_bdrms'].'</p>';
                            echo "<p><h4>Baths: </h4>&nbsp&nbsp".$item['num_baths'].'</p>';
                            echo "<p><h4>Year Built: </h4>&nbsp&nbsp".$item['year_built'].'</p>';
                            echo "<p><h4>Property Type: </h4>&nbsp&nbsp".$item['prop_type'].'</p>';
                            echo "<p><h4>Building Type: </h4>&nbsp&nbsp".$item['bldg_type'].'</p>';
                            echo "<p><h4>Maintenance Fee: </h4>&nbsp&nbsp".$item['maintenance_fee'].'</p>';
                            echo "<p><h4>Status: </h4>&nbsp&nbsp".$item['status'].'</p>';
                            echo "<p><h4>Address: </h4>&nbsp&nbsp".$item['address'].'</p>';
                            echo "<p><h4>Description: </h4>&nbsp&nbsp".$item['description'].'</p>';
                            echo '<script>
                                    function goBack()
                                      {
                                      window.history.back()
                                      }
                                    </script>
                                    <button onclick="goBack()">Go Back</button><br>';
                            echo '<div id="faded" style="position: relative; width: 100%;">
                                  <ul class="pagination" style="position: relative; top: 0px; left: 0px;">';
                            echo '<label>Realtor Contact Info</label><br>';
                            echo "Company: ".$item['c_name'].'</br>';
                            echo "Address: ".$item['c_address'].'</br>';
                            echo "Manager: ".$item['c_manager_name'].'</br>';
                            echo "Phone: ".$item['c_phone_no'].'</br>';
                            
                            
                            //Lines added by Jack L for MSG system
                            echo "<br /><br />";
                            include_once "msg_cmp.php";
                            Show_Msg_Form();
                            //End of lines added by Jack L
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
