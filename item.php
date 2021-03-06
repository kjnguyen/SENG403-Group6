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
                <li><a href="admin" >Login</a></li>
            </ul>
        </nav>

<?php
if(!defined("search_utils.php")) {define("search_utils.php", True);}
include_once 'search_utils.php';
$ID = intval($_GET['ID']);
$item_found = True;
if ($ID == NULL) {
     $item_found = False;
}

include "picturesLib.php";

$con = getSQLConnection();
$pictureList = getPictures($con, intval($ID));
mysqli_close($con);
// following part are place-holder for pictures
if($pictureList !== false && !empty($pictureList))
{
echo '
        <!-- faded slider begin -->
        <div id="faded">
            <div class="rap">';
  $i = 0;
  $lastPicHTML;
  foreach($pictureList as $pic)
  {
    $lastPicHTML = '<a href="#"><img src="' . $pic["path"] . '" alt="" width="571" height="398"></a>';
    echo $lastPicHTML;
    if(++$i >= 3) // only 3 pictures for now
    {
      break;
    }
  }
  
  if($i == 1)
  {
    echo $lastPicHTML; // Copy this to prevent error
  }
echo        '</div>
            <ul class="pagination" style="width: 0px;">
                ';
  $i = 0;
  foreach($pictureList as $pic)
  {
    echo '<li>
                      <a href="#" rel="' . $i . '">
                        <img src="' . $pic["path"] . '" alt="" width="93" height="84">
                      </a>
                  </li>';
    
    if(++$i >= 3) // only 3 pictures for now
    {
      break;
    }
  }
    echo '
            </ul>
        </div>
        <!-- faded slider end -->
        </div>
        </header>';
}
else
{
  echo '</div>
  </header>';
  
  echo '<style type="text/css">header {height: 175px;}
  .noimage{background-color: #E4E4E6; color: #000; width: 200px;}</style>';
  
  echo "<div class=\"container_16\">";
  echo '<center><div class="noimage">No images available</div></center></div>';
}
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
                               
                        if(isset($_SESSION['mostRecentSearchResults']))
                        {
                            echo '<p><a href="'.htmlspecialchars($_SESSION['mostRecentSearchResults']).'" >Go back to search result</a></p>';
                        }
                        $item = search_one_item($ID);
                        /*if($item == NULL)
                        {
                            $item_found = False;
                        }*/
                        if(is_null($item))
                        {
                            echo "Item Not Found!";
                        }
                        else
                        {
                            echo '<form name="addCompareItem" method="post"><input type="hidden" name="compareItemID" value="'.$ID.'"/>'
                            . '<button name="addCompareItem" type="submit" value="addCompare">Add this item to comparison list</button></form>';
                            
                            echo "\n<h5>Price: </h5><p>&nbsp;&nbsp; $".$item['price']."</p>\n";
                            echo "<h5>Date Listed: </h5><p>&nbsp;&nbsp;".$item['date_listed']."</p>\n";
                            echo "<h5>Size: </h5><p>&nbsp;&nbsp;".$item['sq_ft']." Sqr Ft. </p>\n";
                            echo "<h5>Floors: </h5><p>&nbsp;&nbsp;".$item['num_floors']."</p>\n";
                            echo "<h5>Bedrooms: </h5><p>&nbsp;&nbsp;".$item['num_bdrms']."</p>\n";
                            echo "<h5>Baths: </h5><p>&nbsp;&nbsp;".$item['num_baths']."</p>\n";
                            echo "<h5>Year Built: </h5><p>&nbsp;&nbsp;".$item['year_built']."</p>\n";
                            echo "<h5>Property Type: </h5><p>&nbsp;&nbsp;".$item['prop_type']."</p>\n";
                            echo "<h5>Building Type: </h5><p>&nbsp;&nbsp;".$item['bldg_type']."</p>\n";
                            echo "<h5>Maintenance Fee: </h5><p>&nbsp;&nbsp;".$item['maintenance_fee']."</p>\n";
                            echo "<h5>Status: </h5><p>&nbsp;&nbsp;".$item['status']."</p>\n";
                            echo "<h5>Address: </h5><p>&nbsp;&nbsp;".$item['address'].'"\n</p>';
                            echo "<h5>Description: </h5><p>&nbsp;&nbsp;".$item['description']."</p>\n";

                            echo '<div id="faded" style="position: relative; width: 100%;">
                                  <ul class="pagination" style="position: relative; top: 0px; left: 0px;">';
                            echo '<label>Realtor Contact Info</label><br/>';
                            echo "Company: ".$item['c_name'].'<br/>';
                            echo "Address: ".$item['c_address'].'<br/>';
                            echo "Manager: ".$item['c_manager_name'].'<br/>';
                            echo "Phone: ".$item['c_phone_no'].'<br/>';
                            
                            
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
    include_once "footer.php";
?>
