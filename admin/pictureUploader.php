<?php
// This a quick picture upload handler

require_once "../mysqlcon.php";
require "../picturesLib.php";

$con = getSQLConnection();

$uploadResult = addPictures($con, intval($id));

if($uploadResult === false)
{
  echo "<br />Error uploading file.";
}
else if(!empty($uploadResult) && $uploadResult[0] !== false)
{
  echo "<br />Picture uploaded successfully.";
}

?>

