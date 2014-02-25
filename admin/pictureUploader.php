<?php
// This a quick picture upload handler

require_once "../mysqlcon.php";
require "../picturesLib.php";

$con = getSQLConnection();

$uploadResult = addPictures($con, $ListingID);

if($uploadResult === false)
{
  echo "Error uploading file.";
}
else if(!empty($uploadResult) && $uploadResult[0] !== false)
{
  echo "Picture uploaded successfully.";
}

?>

