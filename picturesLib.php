<?php
// Return a fake 404 if page is being accessed directly
if ($_SERVER['PHP_SELF'] == '/' . basename(__FILE__))
{
  header('HTTP/1.0 404 Not Found');
  echo "
<!DOCTYPE HTML PUBLIC \"-//IETF//DTD HTML 2.0//EN\">
<html><head>
<title>404 Not Found</title>
</head><body>
<h1>Not Found</h1>
<p>The requested URL " . $_SERVER['PHP_SELF'] . " was not found on this server.</p>
<p>Additionally, a 404 Not Found error was encountered while trying to use an ErrorDocument to handle the request.</p>
</body></html>
";
  exit();
}

function addPictures(mysqli $con, $ListingID)
{
  if(mysqli_connect_errno($con) || !is_int($ListingID))
  {
    return false;
  }
  
  if(empty($_FILES))
  {
    return array();
  }
  
  $filePaths = array();
  
  // TODO
}


/* Get a list of paths to the pictures for a listing
 * Returns false on error otherwise the list in an array (may be empty)
 */
function getPictures(mysqli $con, $ListingID)
{
  if(mysqli_connect_errno($con))
  {
    return false;
  }
  
  $list = array();
  $pos = 0;
  
  $statement = $con->prepare("SELECT fileName FROM Pictures WHERE listingID = ?;");
  
  if(!$statement) // Ensure statement is created
  {
    return false;
  }
  
  $statement->bind_param("i", $ListingID);
  $statement->execute();
  $statement->bind_result($filePath);
  
  while($statement->fetch())
  {
    $list[$pos++] = $filePath;
  }
  
  $statement->close(); // Must be called otherwise the sql connection can't be used
  
  return $list;
}

?>