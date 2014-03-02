<?php 
require_once "../mysqlcon.php";
require "../picturesLib.php";

$con = getSQLConnection();

//$ListingID = 0; // NEED LISTING ID
$_SESSION['listing'] = intval($ID);

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
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    
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
  
  // This is from http://html5demos.com/dnd-upload, but modified
  function readfiles(files, progress)
  {
    if(files.length === 0)
      return false;
    
    var formData = new FormData();
    
    formData.append("token", token); // add the token
    formData.append("cmd", "upload"); // add the command
    
    for (var i = 0; i < files.length; i++)
    {
      formData.append('file' + i, files[i]);
      //previewfile(files[i]);
    }
    
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'pictureHandler.php');
    xhr.onload = function()
    {
      //progress.value = progress.innerHTML = 100;
      progress.style.width = "100%";
      c1.innerHTML = "Done!";
    };

    //if (tests.progress)
    {
      xhr.upload.onprogress = function (event)
      {
        if (event.lengthComputable)
        {
          var complete = (event.loaded / event.total * 100 | 0);
          //progress.value = progress.innerHTML = complete;
          progress.style.width = complete + "%";
        }
      }
    }

    xhr.send(formData);
  }
  var c1 = 1;
  function uploadPic()
  {
    var fileInput = document.getElementById("fileInput");
    var picMsg = document.getElementById("picMsg");
    
    picMsg.innerHTML = "";
    
    if(fileInput.value == "")
    {
      picMsg.innerHTML = "<div class=\"control-group error\"><span class=\"controls help-inline\">Please choose a file.</span></div>";
      return false;
    }
    
    var table = document.getElementById("picTable");
    var uploadBtn = document.getElementById("picUploadBtn");
    //var rows = picTable.getElementsByTagName("tr");
    
    var row = table.insertRow(uploadBtn.parentNode.parentNode.rowIndex);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    
    var progressBox = document.createElement("div");
    progressBox.className = "progress progress-striped progress-success active";
    var progress = document.createElement("div");
    progress.className = "bar";
    progress.style.width = '0%';
    progressBox.appendChild(progress);
    
    cell1.innerHTML = "Uploading...";
    cell2.innerHTML = fileInput.value;
    cell3.appendChild(progressBox);
    c1 = cell1;
    var files = fileInput.files;
    
    readfiles(files, progress);
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
  <table class="table table-bordered picTable" id="picTable">
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
        echo $pic["path"];
        echo "'/>\" >";
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
          <input class="input-file uniform_on" id="fileInput" type="file">
        </div>
      </td>
      <td class="picButtons">
        <br />
        <a class="btn btn-success" href="#" id="picUploadBtn" onclick="uploadPic();"><i class="icon-arrow-up icon-white"/></i>Upload</a>
      </td>
    </tr>
  </table>
  <div id="picMsg"></div>
  <div>Reordering is not supported yet.</div>
</div>
<input type="hidden" name="token" value="<?php echo $token; ?>" />