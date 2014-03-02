<?php
session_start();

define("modify_utils.php", true);
include "modify_utils.php";

include "../picturesLib.php";

// Check token
if($_POST['token'] != $_SESSION['token'])
{
  echo "Bad token";
  die();
}

// Check permissions
if(!check_permission($_SESSION['listing']))
{
  echo "Bad Permissions";
  die();
}

$con = getSQLConnection();

if(mysqli_connect_errno($con))
{
  echo "Bad Server: Failed to connect to MySQL: " . mysqli_connect_error();
  die();
}

if($_POST['cmd'] === "order")
{
  $imgID = intval($_POST['id']);
  
}
elseif($_POST['cmd'] === "remove")
{
  $imgID = intval($_POST['id']);
  
}
elseif($_POST['cmd'] === "upload")
{
  $pictures = addPictures($con, $_SESSION['listing']);
  var_dump($pictures);
}
else
{
  echo "Bad Command";
}
$con->close();
?>