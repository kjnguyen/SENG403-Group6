<?php 
require_once "../mysqlcon.php";
require "../picturesLib.php";

$con = getSQLConnection();

//$ListingID = 0; // NEED LISTING ID

if(!mysqli_errno($con))
{
  $pictureList = getPictures($con, $ID);
}

$_SESSION["token"] = $token = uniqid(rand(), true);
?>

<script type="text/javascript">
  var token = "<?php echo $token; ?>";
  
  function sendRequest(var id, var command)
  {
    var xmlhttp = new XMLHttpRequest();
    
    //xmlhttp.onreadystatechange=
    
    xmlhttp.open("POST", "pictureUploader.php", true);
    
    var request = "token=" + token + "&id=" + id + "&cmd=" + command;
    
    xmlhttp.send(request);
  }
  
  function removePic(var id)
  {
    
  }
  
  
</script>
<!--
<div class="control-group">
  <label class="control-label" for="fileInput">Add Picture</label>
  <div class="controls">
    <input class="input-file uniform_on" id="fileInput" type="file" name="file">
  </div>
</div>
<input type="hidden" name="token" value="<?php echo $token; ?>" /> -->

<div class="control-group">
  <legend>Edit Pictures</legend>
  <table class="table table-striped" width="35%">
  <?php echo "
    <tr>
      <td>";
      echo "Test Picture";
      echo '</td>
      <td><a class="btn btn-danger" href="#">
          <i class="icon-trash icon-white"></i> 
          Delete
        </a>
      </td>
    </tr>';
  ?>
    <tr>
      <td colspan="2">
        <div class="controls">
          <input class="input-file uniform_on" id="fileInput" type="file" name="file">
        </div>
      </td>
    </tr>
  </table>
  
</div>
<input type="hidden" name="token" value="<?php echo $token; ?>" />