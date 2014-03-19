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

define("PIC_LIMIT", 3);
?>

<script type="text/javascript">
  var token = "<?php echo $token; ?>";
  var numOfPics = <?php if($pictureList !== false){echo count($pictureList);} else{echo "0";} ?>;
  
  var PIC_LIMIT = <?php echo PIC_LIMIT; ?>;
  
  // This is not currectly used
  function sendRequest(id, command)
  {
    var xmlhttp = new XMLHttpRequest();
    
    //xmlhttp.onreadystatechange=
    
    xmlhttp.open("POST", "pictureHandler.php", true);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    
    xhr.onload = function()
    {
      
    };
    
    var request = "token=" + token + "&id=" + id + "&cmd=" + command;
    
    xmlhttp.send(request);
  }
  
  function removePic(node, id)
  {
    var removeSpan = document.createElement("span");
    removeSpan.className = "label label-important";
    
    var progress = document.createElement("img");
    progress.src = "img/ajax-loaders/ajax-loader-1.gif";
    
    
    var removeText = document.createTextNode(" Removing");
    
    removeSpan.appendChild(progress);
    removeSpan.appendChild(removeText);
    
    node.parentNode.replaceChild(removeSpan, node);
    
    var xmlhttp = new XMLHttpRequest();
    
    //xmlhttp.onreadystatechange=
    
    xmlhttp.open("POST", "pictureHandler.php", true);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    
    xmlhttp.onload = function()
    {
      if(xmlhttp.responseText == "Removed")
      {
        // Remove the row if server say it succeeded
        removeSpan.parentNode.parentNode.parentNode.removeChild(removeSpan.parentNode.parentNode);
        
        if(--numOfPics < PIC_LIMIT)
        {
          var uploadRow = document.getElementById("uploadRow");
          uploadRow.style.display = "";
        }
      }
      else
      {
        removeSpan.innerHTML = "Failed!";
      }
    };
    
    var request = "token=" + token + "&id=" + id + "&cmd=remove";
    
    xmlhttp.send(request);
  }
  
  // This is from http://html5demos.com/dnd-upload, but modified
  function readfiles(files, progress, cell1, cell2)
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
      var result;
      try
      {
        result = JSON.parse(xhr.responseText);
      }
      catch(e) // Catch JSON.parse exceptions
      {
        progress.style.width = "100%";
        cell1.innerHTML = "<div class=\"control-group error\"><span class=\"controls help-inline\">Failed!</span></div>";
        return;
      }
      
      // Uploaded correctly
      if(result instanceof Array && result[0] != false)
      {
        cell1.innerHTML = "<img width=\"93\" height=\"84\" onmouseover=\"enlargePic(this);\" onmouseout=\"shrinkPic(this);\" src=\"" +
                result[0]['path'] + "\"/>";
        //progress.style.width = "100%";
        /*// This does not do what is expected
        cell2.firstChild.dataset.content = "<img src='" + result[0]["path"] + "'/>";
        cell2.firstChild.dataset.rel = "popover";
        cell2.firstChild.dataset.originalTitle = "";*/
        
        progress.parentNode.parentNode.innerHTML = '<a class="btn btn-danger" href="#" onclick="removePic(this, ' +
                result[0]["id"] + ');"><i class="icon-trash icon-white"/></i> Delete\n </a>';
      }
      else
      {
        progress.style.width = "100%";
        progress.parentNode.parentNode.innerHTML = "<div class=\"control-group error\"><span class=\"controls help-inline\">Failed!</span></div>";
        
        if(--numOfPics < PIC_LIMIT)
        {
          var uploadRow = document.getElementById("uploadRow");
          uploadRow.style.display = "";
        }
      }
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
  
  var lastFile = "";
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
    else if(lastFile == fileInput.value)
    {
      picMsg.innerHTML = "<div class=\"control-group error\"><span class=\"controls help-inline\">You have just uploaded this file.</span></div>";
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
    
    lastFile = fileInput.value;
    cell1.innerHTML = "Uploading...";
    cell2.innerHTML = "<span>" + fileInput.value + "</span>";
    cell3.appendChild(progressBox);
    var files = fileInput.files;
    
    cell2.style.verticalAlign = "middle";
    cell3.style.verticalAlign = "middle";
    
    if(++numOfPics >= PIC_LIMIT)
    {
      var uploadRow = document.getElementById("uploadRow");
      uploadRow.style.display = "none";
    }
    
    readfiles(files, progress, cell1, cell2);
    
    // Clear file input
    // fileInput.nextSibling.innerHTML = "No file selected.";
    // fileInput.parentNode.innerHTML = fileInput.parentNode.innerHTML;
  }
  
  function enlargePic(img)
  {
    img.width = 571;
    img.height = 398;
  }
  
  function shrinkPic(img)
  {
    img.width = 93;
    img.height = 84;
  }
</script>

<style type="text/css">
  .picTable
  {
    width: 50%;
  }
  .picButtons
  {
      width: 1%;
      white-space: nowrap;
  }
</style>

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
          <img width="93" height="84" onmouseover="enlargePic(this);" onmouseout="shrinkPic(this);" src="';
        echo $pic["path"];
        echo '"/>';
        echo '
        </td>
        <td style="vertical-align:middle;">';
        echo htmlspecialchars($pic["oname"]);
        echo '</td>
        <td class="picButtons" style="vertical-align:middle;"><a class="btn btn-danger" href="#" onclick="removePic(this, ';
        echo $pic["id"];
        echo ');">
            <i class="icon-trash icon-white"/></i>
            Delete
          </a>
        </td>
      </tr>';
  }
  ?>

    <tr id="uploadRow" <?php if($pictureList !== false && count($pictureList) >= PIC_LIMIT){echo "style=\"display:none;\"";} ?>>
      <td colspan="2">
        Upload New:
        <div class="controls">
          <input class="input-file uniform_on" id="fileInput" type="file">
        </div>
        <h6>Accepted formats: *.jpeg, *.jpg, *.png, *.bmp, *.gif</h6>
      </td>
      <td class="picButtons">
        <br />
        <a class="btn btn-success" href="#" id="picUploadBtn" onclick="uploadPic();"><i class="icon-arrow-up icon-white"/></i>Upload</a>
      </td>
    </tr>
  </table>
  <div id="picMsg"></div>
  <br/>
  <div>
    Currently only 3 pictures can be displayed.
  </div>
</div>
<input type="hidden" name="token" value="<?php echo $token; ?>" />