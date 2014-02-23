<?php
require_once "mysqlcon.php";
require "picturesLib.php";

$con = getSQLConnection();

// Check sql connection
if(mysqli_connect_errno($con))
{
  header("HTTP/1.0 500 Internal Server Error");
  echo "
  <!DOCTYPE HTML PUBLIC \"-//IETF//DTD HTML 2.0//EN\">
  <html><head>
  <title>500 Internal Server Error</title>
  </head><body>
  <h1>Internal Server Error</h1>
  </body></html>
  ";
}

if(!array_key_exists("listing", $_GET) || empty($_GET["listing"]))
{
  echo "Error: No listing selected.";
  exit();
}

$listingID = intval($_GET["listing"]);

$pictureList = getPictures($con, $listingID);
?>

<html>
  <head>
    <title>Pictures for Listing <?php echo $listingID ?></title>
  </head>
  
  <body>
    <h1>Pictures for Listing <?php echo $listingID ?></h1>
    
    <?php
    if(empty($pictureList))
    {
      echo "No pictures available for this listing.";
    }
    else
    {
      foreach($pictureList as $pic)
      {
        echo "<img src=\"" . $pic["path"] . "\"><br/>";
      }
    }
    ?>
  </body>
</html>