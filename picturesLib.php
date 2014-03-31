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

define("LISTING_IMG_DIR", "/listing/images/");
define("LISTING_THUMB_DIR", "/listing/thumbs/");

/** Saves uploaded pictures to the file system and database. Looks in the $_FILES array.
 * Returns false on error otherwise the list in an array (may be empty) containing associative arrays with
 * id, original name (oname), path and order value. The order of the array is same as the $_FILES array when
 * iterating though it with a foreach loop. Array may contain false values if that particular file failed to save.
 * WARNING: oname is not escaped.
 */
function addPictures(mysqli $con, $ListingID)
{
  if(mysqli_connect_errno($con))
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
    
    array_push($filePaths, saveUploadedPictures($con, $ListingID, $file));
  }
  
  return $filePaths;
}

/** Get a list of paths to the pictures for a listing
 * Requires a mysqli connection object.
 * Requires a Listing ID or an array of Listing IDs
 * Returns false on error otherwise the list in an array (may be empty) containing associative
 * arrays with id, listing ID (listing), original name (oname), path and order value.
 * WARNING: oname is not escaped.
 */
function getPictures(mysqli $con, $ListingID)
{
  if(mysqli_connect_errno($con))
  {
    return false;
  }
  
  $list = array();
  
  if(is_array($ListingID))
  {
    if(count($ListingID) == 0)
    {
      return 0;
    }
    $qqm = str_repeat("?, ", count($ListingID) - 1) . "?";
  }
  else
  {
    $qqm = "?";
  }
  
  $statement = $con->prepare("SELECT ID, listingID, originalName, fileName, position FROM Pictures WHERE listingID IN ("
      . $qqm . ") ORDER BY position ASC");
  
  if(!$statement) // Ensure statement is created
  {
    return false;
  }
  
  if(is_array($ListingID))
  {
    $qtypes = str_repeat("i", count($ListingID));
    $refs = array();
    foreach($ListingID as $key => $value)
    {
      $refs[$key] = &$ListingID[$key];
    }
    array_unshift($refs, $qtypes);
    // This calls $statement->bind_param()
    call_user_func_array(array($statement, "bind_param"), $refs);
  }
  else
  {
    $statement->bind_param("i", $ListingID);
  }
  $statement->execute();
  $statement->bind_result($imgID, $listing, $oname, $partialPath, $order);
  
  while($statement->fetch())
  {
    array_push($list, array("id"=>$imgID, "listing"=>$listing, "oname"=>$oname, "path"=>(LISTING_IMG_DIR . $partialPath), 'order'=>$order));
  }
  
  $statement->close(); // Must be called otherwise the sql connection can't be used
  
  return $list;
}

/* Place holder for get thumbnails of pictures
 * to-do: John will do this later
 */
function getThumnails(mysqli $con, $ListingID)
{
  return getPictures($con, $ListingID);
}

/** Deletes a picture from the file system and database.
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
  $statement->bind_result($partialPath);
  
  if(!$statement->fetch()) // If ID and listingID combination not found quit
  {
    $statement->close();
    return false;
  }
  
  $statement->close();
  
  $fullPath = $_SERVER['DOCUMENT_ROOT'] . LISTING_IMG_DIR . $partialPath;
  
  if(is_null($partialPath) || !file_exists($fullPath) || unlink($fullPath)) // Ensure file has been deleted
  {
    // Listing ID is used to ensure we are removing from the correct listing
    $statement = $con->prepare("DELETE FROM Pictures WHERE ID = ?");
    $statement->bind_param("i", $imgID);
    
    if(!$statement->execute())
    {
      $statement->close();
      return false;
    }
  }
  
  $statement->close();
  
  return true;
}

function swapPictureOrder(mysqli $con, $pic1, $pic2)
{
  if(mysqli_connect_errno($con))
  {
    return false;
  }
  else if($pic1 == $pic2)
  {
    return true;
  }
  
  // Lock table
  if($con->query("LOCK TABLES Pictures WRITE;") == false)
  {
    trigger_error("Unable to lock Pictures table.", E_NOTICE);
  }
  
  $statement = $con->prepare("SELECT ID, listingID, position FROM Pictures WHERE ID = ? OR ID = ?");
  $statement->bind_param("ii", $pic1, $pic2);
  $statement->execute();
  $statement->bind_result($imgID, $listingID, $order);
  
  if(!$statement->fetch())
  {
    return false;
  }
  
  $ID1 = $imgID;
  $listing1 = $listingID;
  $pos1 = $order;
  
  if(!$statement->fetch())
  {
    return false;
  }
  
  $ID2 = $imgID;
  $listing2 = $listingID;
  $pos2 = $order;
  
  $statement->close(); // Must be called otherwise the sql connection can't be used
  
  if($listing1 != $listing2) // Should only swap pictures of the same listing
  {
    return false;
  }
  
  // Swap values
  $statement = $con->prepare("UPDATE Pictures SET position=IF(id=?, ?, ?) WHERE ID = ? OR ID = ?");
  $statement->bind_param("iiiii", $ID1, $pos2, $pos2, $ID1, $ID2);
  $exeResult = $statement->execute();
  $statement->close();
  
  // Unlock table
  if($con->query("UNLOCK TABLES;") == false)
  {
    trigger_error("Unable to unlock Pictures table.", E_NOTICE);
  }
  
  return $exeResult;
}

// Originally from https://github.com/Nimrod007/PHP_image_resize/blob/master/smart_resize_image.function.php
// Modified for this project, WORK IN PROGRESS
/**
* easy image resize function
* @param $file - file name to resize
* @param $string - The image data, as a string
* @param $width - new image width
* @param $height - new image height
* @param $proportional - keep image proportional, default is no
* @param $output - name of the new file (include path if needed)
* @param $delete_original - if true the original image will be deleted
* @param $quality - enter 1-100 (100 is best quality) default is 100
* @return boolean|resource
*/
function smart_resize_image($file,
                            $string = null,
                            $width = 0,
                            $height = 0,
                            $proportional = false,
                            $output = 'file',
                            $delete_original = false,
                            $quality = 100)
{
  if($height <= 0 && $width <= 0)
  {
    return false;
  }
  if($file === null && $string === null)
  {
    return false;
  }

  # Setting defaults and meta
  $info = $file !== null ? getimagesize($file) : getimagesizefromstring($string);
  $image = '';
  $final_width = 0;
  $final_height = 0;
  list($width_old, $height_old) = $info;
  $cropHeight = $cropWidth = 0;

  # Calculating proportionality
  if($proportional)
  {
    if($width == 0)
    {
      $factor = $height / $height_old;
    }
    elseif($height == 0)
    {
      $factor = $width / $width_old;
    }
    else
    {
      $factor = min($width / $width_old, $height / $height_old);
    }

    $final_width = round($width_old * $factor);
    $final_height = round($height_old * $factor);
  }
  else
  {
    $final_width = ( $width <= 0 ) ? $width_old : $width;
    $final_height = ( $height <= 0 ) ? $height_old : $height;
    $widthX = $width_old / $width;
    $heightX = $height_old / $height;

    $x = min($widthX, $heightX);
    $cropWidth = ($width_old - $width * $x) / 2;
    $cropHeight = ($height_old - $height * $x) / 2;
  }

  # Loading image to memory according to type
  switch($info[2])
  {
    case IMAGETYPE_JPEG: $file !== null ? $image = imagecreatefromjpeg($file) : $image = imagecreatefromstring($string);
      break;
    case IMAGETYPE_GIF: $file !== null ? $image = imagecreatefromgif($file) : $image = imagecreatefromstring($string);
      break;
    case IMAGETYPE_PNG: $file !== null ? $image = imagecreatefrompng($file) : $image = imagecreatefromstring($string);
      break;
    default: return false;
  }
  
  # This is the resizing/resampling/transparency-preserving magic
  $image_resized = imagecreatetruecolor($final_width, $final_height);
  if(($info[2] == IMAGETYPE_GIF) || ($info[2] == IMAGETYPE_PNG))
  {
    $transparency = imagecolortransparent($image);
    $palletsize = imagecolorstotal($image);

    if($transparency >= 0 && $transparency < $palletsize)
    {
      $transparent_color = imagecolorsforindex($image, $transparency);
      $transparency = imagecolorallocate($image_resized, $transparent_color['red'], $transparent_color['green'], $transparent_color['blue']);
      imagefill($image_resized, 0, 0, $transparency);
      imagecolortransparent($image_resized, $transparency);
    }
    elseif($info[2] == IMAGETYPE_PNG)
    {
      imagealphablending($image_resized, false);
      $color = imagecolorallocatealpha($image_resized, 0, 0, 0, 127);
      imagefill($image_resized, 0, 0, $color);
      imagesavealpha($image_resized, true);
    }
  }
  imagecopyresampled($image_resized, $image, 0, 0, $cropWidth, $cropHeight, $final_width, $final_height, $width_old - 2 * $cropWidth, $height_old - 2 * $cropHeight);


  # Taking care of original, if needed
  if($delete_original)
  {
    @unlink($file);
  }

  # Preparing a method of providing result
  switch(strtolower($output))
  {
    case 'browser':
      $mime = image_type_to_mime_type($info[2]);
      header("Content-type: $mime");
      $output = NULL;
      break;
    case 'file':
      $output = $file;
      break;
    case 'return':
      return $image_resized;
    default:
      break;
  }

  # Writing image according to type to the output destination and image quality
  switch($info[2])
  {
    case IMAGETYPE_GIF: imagegif($image_resized, $output);
      break;
    case IMAGETYPE_JPEG: imagejpeg($image_resized, $output, $quality);
      break;
    case IMAGETYPE_PNG:
      imagepng($image_resized, $output, 9); // Use max compression 
      break;
    default: return false;
  }

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

/** 'PRIVATE' FUNCTION: DO NOT USE
 * Saves uploaded pictures to the file system and database.
 * Returns false on error otherwise an associative arrays with id, original name (oname), path and order value.
 * WARNING: oname is not escaped.
 */
function saveUploadedPictures(mysqli $con, $ListingID, $file)
{
  $returnValue = false;
  
  $allowedExts = array("gif", "jpeg", "jpg", "png");
  $temp = explode(".", $file["name"]);
  $extension = strtolower(end($temp));
  
  @$picSize = getimagesize($file['tmp_name']);
  
  if($picSize !== false
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
    $statement = $con->prepare("INSERT INTO Pictures (listingID, originalName) VALUES (?, ?)");
    $statement->bind_param("is", $ListingID, $file["name"]);

    if(!$statement->execute()) // Ensure statement is executed
    {
      // Unlock table
      if($con->query("UNLOCK TABLES;") == false)
      {
        trigger_error("Unable to unlock Pictures table.", E_WARNING);
      }
      else
      {
        $con->commit(); // Commit the unlock
      }
      
      return false;
    }
    
    $imgID = $statement->insert_id;
    
    $statement->close();
    
    $destination = $ListingID . "/" . $imgID . "." . $extension;
    $destinationFull = $_SERVER['DOCUMENT_ROOT'] . LISTING_IMG_DIR . $destination;

    if(!is_dir($_SERVER['DOCUMENT_ROOT'] . LISTING_IMG_DIR . $ListingID . "/"))
    {
      mkdir($_SERVER['DOCUMENT_ROOT'] . LISTING_IMG_DIR . $ListingID);
    }
    
    if(move_uploaded_file($file["tmp_name"], $destinationFull))
    {
      $max = getMaxPosition($con, $ListingID);

      $position = $max == NULL ? 1 : $max + 1;

      $statement = $con->prepare("UPDATE Pictures SET fileName = ?, position = ? WHERE ID = ?");
      $statement->bind_param("sii", $destination, $position, $imgID);

      if($statement->execute()) // Ensure statement is executed
      {
        $statement->close();
        $con->commit(); // Everything is ok with the file, save sql changes

        $returnValue = array("id"=>$imgID, "oname"=>$file["name"], "path"=>(LISTING_IMG_DIR . $destination), "order"=>$position);
      }
      else
      {
        $statement->close();
        $con->rollback(); // Something went wrong
        unlink($destinationFull);
        $returnValue = false;
      }
    }
    else // Unable to properly save uploaded file
    {
      $con->rollback();
      $returnValue = false;
    }
    
    // Unlock table
    if($con->query("UNLOCK TABLES;") == false)
    {
      trigger_error("Unable to unlock Pictures table.", E_WARNING);
    }
    else
    {
      $con->commit(); // Commit the unlock
    }
  }
  
  return $returnValue;
}
?>