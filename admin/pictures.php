<?php 
require_once "../mysqlcon.php";
require "../picturesLib.php";

$con = getSQLConnection();

//$ListingID = 0; // NEED LISTING ID
$_SESSION['listing'] = $ID;

if(!mysqli_errno($con))
{
  $pictureList = getPictures($con, $_SESSION['listing']);
}

$_SESSION["token"] = $token = uniqid(rand(), true);
?>

<script type="text/javascript">
  var token = "<?php echo $token; ?>";
  
  function sendRequest(id, command)
  {
    var xmlhttp = new XMLHttpRequest();
    
    //xmlhttp.onreadystatechange=
    
    xmlhttp.open("POST", "pictureHandler.php", true);
    
    var request = "token=" + token + "&id=" + id + "&cmd=" + command;
    
    xmlhttp.send(request);
  }
  
  function removePic(node, id)
  {
    var removeSpan = document.createElement("span");
    removeSpan.className = "label label-important";
    
    var progress = document.createElement("img");
    progress.src = "img/ajax-loaders/ajax-loader-1.gif";
    //progress.width = 75;
    //progress.height = 19;
    
    var removeText = document.createTextNode(" Removing");
    
    removeSpan.appendChild(progress);
    removeSpan.appendChild(removeText);
    
    node.parentNode.replaceChild(removeSpan, node);
    
    sendRequest(id, "remove");
  }
  
</script>

<style type="text/css">
  .picTable
  {
    width: 35%;
  }
  .picButtons
  {
      width: 1%;
      white-space: nowrap;
  }
</style>
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
  <table class="table table-bordered picTable">
  <?php 
  
  foreach($pictureList as $pic)
  {
    if($pic === false)
    {
      continue;
    }
    //$pic = array("id"=>3, "oname"=>"house.png", "path"=>"1.png", "order"=>1);

    echo '
      <tr>
        <td class="picButtons">
          <a class="btn" href="#" onclick="orderPic(this, ';
        echo $pic["id"];
        echo ');"><i class="icon-chevron-down"/></i></a>
          <a class="btn" href="#" onclick="orderPic(this, ';
        echo $pic["id"];
        echo ');"><i class="icon-chevron-up"/></i></a>
        </td>
        <td>';
        echo '<span data-rel="popover" data-content="<img src=\'';
        echo ".." . $pic["path"];
        echo "\'/>\" >";
        echo htmlspecialchars($pic["oname"]);
        echo '</span></td>
        <td class="picButtons"><a class="btn btn-danger" href="#" onclick="removePic(this, ';
        echo $pic["id"];
        echo ');">
            <i class="icon-trash icon-white"/></i>
            Delete
          </a>
        </td>
      </tr>';
  }
  ?>
    <tr>
      <td colspan="2">
        Upload New:
        <div class="controls">
          <input class="input-file uniform_on" id="fileInput" type="file" name="file">
        </div>
      </td>
      <td class="picButtons">
        <br />
        <a class="btn btn-success" href="#"><i class="icon-arrow-up icon-white"/></i>Upload</a>
      </td>
    </tr>
  </table>
  
</div>
<input type="hidden" name="token" value="<?php echo $token; ?>" />