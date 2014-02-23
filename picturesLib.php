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

/* Saves uploaded pictures to the file system and database. Looks in the $_FILES array.
 * Returns false on error otherwise the list in an array (may be empty) containing associative arrays with
 * id, path and order value. The order of the array is same as the $_FILES array when iterating though it with
 * a foreach loop. Array may contain false values if that particular file failed to save.
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
      // Lock table
      if($con->query("LOCK TABLES Pictures WRITE;") == false)
      {
        trigger_error("Unable to lock Pictures table.", E_NOTICE);
      }
      else
      {
        $con->commit(); // Commit the lock
      }
      
      // Allocate a new id for the picture
      $statement = $con->prepare("INSERT INTO Pictures (listingID) VALUES (?)");
      $statement->bind_param("i", $ListingID);
      
      if(!$statement->execute()) // Ensure statement is executed
      {
        array_push($filePaths, false);
        continue;
      }
      
      $imgID = $statement->insert_id;
      
      $statement->close();
      
      $destination = $ListingID . "/" . $imgID . "." . $extension;
      
      if(move_uploaded_file($file["tmp_name"], $destination))
      {
        $max = getMaxPosition($con, $ListingID);
        
        $position = $max == NULL ? 1 : $max + 1;
        
        $statement = $con->prepare("UPDATE Pictures SET fileName = ?, position = ? WHERE ID = ?");
        $statement->bind_param("sii", $destination, $position, $imgID);
        
        if(!$statement->execute()) // Ensure statement is executed
        {
          $statement->close();
          $con->commit(); // Everything is ok with the file, save sql changes
          
          array_push($filePaths, array("id"=>$imgID, "path"=>(IMG_UPLOAD_DIR . $destination), "order"=>$position));
        }
        else
        {
          $statement->close();
          $con->rollback(); // Something went wrong
          unlink($_SERVER['DOCUMENT_ROOT'] . IMG_UPLOAD_DIR . $destination);
          array_push($filePaths, false);
        }
      }
      else // Unable to properly save uploaded file
      {
        $con->rollback();
        array_push($filePaths, false);
      }
      
      // Unlock table
      if($con->query("UNLOCK TABLES;") == false)
      {
        trigger_error("Unable to unlock Pictures table.", E_NOTICE);
      }
      else
      {
        $con->commit(); // Commit the unlock
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
 * Returns false on error otherwise the list in an array (may be empty) containing associative
 * arrays with id, path and order value.
 */
function getPictures(mysqli $con, $ListingID)
{
  if(mysqli_connect_errno($con))
  {
    return false;
  }
  
  $list = array();
  
  $statement = $con->prepare("SELECT ID, fileName, position FROM Pictures WHERE listingID = ?");
  
  if(!$statement) // Ensure statement is created
  {
    return false;
  }
  
  $statement->bind_param("i", $ListingID);
  $statement->execute();
  $statement->bind_result($imgID, $partialPath, $order);
  
  while($statement->fetch())
  {
    array_push($list, array("id"=>$imgID, "path"=>(IMG_UPLOAD_DIR . $partialPath), 'order'=>$order));
  }
  
  $statement->close(); // Must be called otherwise the sql connection can't be used
  
  return $list;
}

/* Deletes a picture from the file system and database.
 * Returns TRUE on success or FALSE on failure.
 */
function removePicture(mysqli $con, $ListingID, $imgID)
{
  if(mysqli_connect_errno($con))
  {
    return false;
  }
  
  // Listing ID is used to ensure we are removing from the correct listing
  $statement = $con->prepare("SELECT fileName FROM Pictures WHERE ID = ? AND listingID = ?");
  
  if(!$statement) // Ensure statement is created
  {
    return false;
  }
  
  $statement->bind_param("ii", $imgID, $ListingID);
  $statement->execute();
  $statement->bind_result($imgID, $partialPath);
  
  if(!$statement->fetch()) // If ID and listingID combination not found quit
  {
    $statement->close();
    return false;
  }
  
  $statement->close();
  
  $fullPath = $_SERVER['DOCUMENT_ROOT'] . IMG_UPLOAD_DIR . $partialPath;
  
  if(!file_exists($fullPath) || unlink($fullPath)) // Ensure file has been deleted
  {
    // Listing ID is used to ensure we are removing from the correct listing
    $statement = $con->prepare("DELETE FROM Pictures WHERE ID = ?");
    $statement->bind_param("i", $imgID);
    
    if($statement->execute())
    {
      $statement->close();
      return false;
    }
  }
  
  $statement->close();
  
  return true;
}

///////////// Private functions /////////////////////

/* Gets the maximum position of the pictures for a listing. Does no error checking.
 * Returns NULL if there is no maximum otherwise returns the maximum.
 */
function getMaxPosition(mysqli $con, $listingID)
{
  $statement = $con->prepare("SELECT MAX(position) FROM Pictures WHERE listingID = ?");
  $statement->bind_param("i", $listingID);
  $statement->execute();
  $statement->bind_result($max_r);
  
  if(!$statement->fetch())
  {
    trigger_error("Unable to fetch max.", E_WARNING);
  }
  
  $max = $max_r;
  
  $statement->close();
  
  return $max;
}
?>