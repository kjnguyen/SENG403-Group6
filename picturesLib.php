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

define("IMG_UPLOAD_DIR", "/listing/images/");

/* Saves uploaded pictures to the file system and database
 * Returns false on error otherwise the list in an array (may be empty), order is same as the $_FILES
 * array when iterating though it with a foreach loop. Array may contain false values if that particular
 * file failed to save.
 */
function addPictures(mysqli $con, $ListingID)
{
  if(mysqli_connect_errno($con) || !is_int($ListingID))
  {
    return false;
  }
  
  if(!$con->autocommit(true))
  {
    trigger_error("Unable to turn off autocommit.", E_NOTICE);
  }
  
  // TODO Return false if listing does not exist
  
  if(empty($_FILES))
  {
    return array();
  }
  
  $filePaths = array();
  
  foreach($_FILES as $file)
  {
    if($file["error"] || !is_uploaded_file($file["tmp_name"]))
    {
      continue;
    }
    
    $allowedExts = array("gif", "jpeg", "jpg", "png", "bmp");
    $temp = explode(".", $file["name"]);
    $extension = end($temp);
    
    if ((($file["type"] == "image/gif")
    || ($file["type"] == "image/jpeg")
    || ($file["type"] == "image/jpg")
    || ($file["type"] == "image/pjpeg")
    || ($file["type"] == "image/x-png")
    || ($file["type"] == "image/png"))
    //&& ($file["size"] < 20000) // Size limit
    && in_array($extension, $allowedExts))
    {
      // Allocate a new id for the picture
      $statement = $con->prepare("INSERT INTO Pictures (listingID) VALUES (?)");
      $statement->bind_param("i", $ListingID);
      
      if(!$statement->execute()) // Ensure statement is executed
      {
        return false;
      }
      
      $imgID = $statement->insert_id;
      
      $statement->close();
      
      $destination = $ListingID . "/" . $imgID . "." . $extension;
      
      if(move_uploaded_file($file["tmp_name"], $destination))
      {
        $statement = $con->prepare("UPDATE Pictures SET fileName = ? WHERE ID = ?");
        $statement->bind_param("si", $destination, $imgID);
        
        if(!$statement->execute()) // Ensure statement is executed
        {
          $statement->close();
          $con->commit(); // Everything is ok with the file, save sql changes
          
          array_push($filePaths, (IMG_UPLOAD_DIR . $destination));
        }
        else
        {
          $statement->close();
          $con->rollback(); // 
          unlink($_SERVER['DOCUMENT_ROOT'] . IMG_UPLOAD_DIR . $destination);
          array_push($filePaths, false);
        }
      }
      else // Unable to properly save uploaded file
      {
        $con->rollback();
        array_push($filePaths, false);
      }
      
    }
    else
    {
      array_push($filePaths, false);
    }
  }
  
  return $filePaths;
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
  
  $statement = $con->prepare("SELECT fileName FROM Pictures WHERE listingID = ?");
  
  if(!$statement) // Ensure statement is created
  {
    return false;
  }
  
  $statement->bind_param("i", $ListingID);
  $statement->execute();
  $statement->bind_result($filePath);
  
  while($statement->fetch())
  {
    array_push($list, (IMG_UPLOAD_DIR . $filePath));
  }
  
  $statement->close(); // Must be called otherwise the sql connection can't be used
  
  return $list;
}

?>