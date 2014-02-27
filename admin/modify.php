<?php
    define("INCLUDE_FILE", true);
    include('header.php');
    
    //Do not output anything before this line (Do not use echo or html code)
    //---------------------------------------------------
?>

<?php 
        define("modify_utils.php", True);
        include_once 'modify_utils.php';
        $ID = $_POST['ID'];
        if (!$ID) {
             $ID = $_GET['ID'];
         }
        $permission = check_permission($ID);
        if ($permission != 1){
                printf("<script>location.href='bad_permission.php'</script>");
        }
?>
<div>
        <ul class="breadcrumb">
                <li>
                        <a href="#">Home</a> <span class="divider">/</span>
                </li>
                <li>
                        <a href="#">Blank</a>
                </li>
        </ul>
</div>

<div class="row-fluid sortable">
        <div class="box span12">
                <div class="box-header well" data-original-title>
                        <h2><i class="icon-picture"></i>Modify Listing</h2>

                </div>
                <div class="box-content">
                        <form name="Modify" method="post" action="modify_results.php" enctype="multipart/form-data" class="form-horizontal" >
                                <fieldset>

							
<?php
define("search_utils.php", True);
include_once '../search_utils.php';
$ID = $_POST['ID'];
if (!$ID) {
$ID = $_GET['ID'];
}
$item = search_one_item($ID);
       // echo "
      // <p><label>ID number(required): </label><input type=\"text\" name=\"ID\" value=\"".$_GET['ID']."\"/></a></p>
      // <p><label>Company ID: </label><input type=\"text\" name=\"CompID\" value=\"".$_GET['CompID']."\"/></p>
//	
// ID and CompID should not be modifiable
      echo '
<div class="control-group"><label class="control-label" for="focusedInput">ID: </label><div class="controls"> <input class="input-xlarge disabled" id="disabledInput" value="'.$ID.'" disabled/></div></div>
<div class="control-group"><label class="control-label" for="focusedInput">Company ID: </label><div class="controls"><input class="input-xlarge disabled" id="disabledInput" value="'.$_POST['CompID'].'" disabled/></div></div>
<div class="control-group"><label class="control-label" for="focusedInput">Price: </label><div class="controls"><input type="text" name="price" value="'.$item['price'].'"/></div></div>
<div class="control-group"><label class="control-label" for="focusedInput">Square Feet: </label><div class="controls"><input type="text" name="sq_ft" value="'.$item['sq_ft'].'"/></div></div>
<div class="control-group"><label class="control-label" for="focusedInput">Number of Floors: </label><div class="controls"><input type="text" name="num_floors" value="'.$item['num_floors'].'"/></div></div>
<div class="control-group"><label class="control-label" for="focusedInput">Number of Bedrooms: </label><div class="controls"><input type="text" name="num_bdrms" value="'.$item['num_bdrms'].'"/></div></div>
<div class="control-group"><label class="control-label" for="focusedInput">Number of Bathrooms: </label><div class="controls"><input type="text" name="num_baths" value="'.$item['num_baths'].'"/></div></div>
<div class="control-group"><label class="control-label" for="focusedInput">Year Built: </label><div class="controls"><input type="text" name="year_built" value="'.$item['year_built'].'"/></div></div>
<div class="control-group"><label class="control-label" for="focusedInput">Property Type: </label><div class="controls"><input type="text" name="prop_type" value="'.$item['prop_type'].'"/></div></div>
<div class="control-group"><label class="control-label" for="focusedInput">Building Type: </label><div class="controls"><input type="text" name="bldg_type" value="'.$item['bldg_type'].'"/></div></div>
<div class="control-group"><label class="control-label" for="focusedInput">District: </label><div class="controls"><input type="text" name="district" value="'.$item['district'].'"/></div></div>
<div class="control-group"><label class="control-label" for="focusedInput">Maintenance: </label><div class="controls"><input type="text" name="maintenance_fee" value="'.$item['maintenance_fee'].'"/></div></div>
<div class="control-group"><label class="control-label" for="focusedInput">Address: </label><div class="controls"><input type="text" name="address" value="'.$item['address'].'"/></div></div>
<div class="control-group"><label class="control-label" for="focusedInput">Description: </label><div class="controls"><textarea type="textarea" name="description" rows="3" style="width: 500px; height: 197px;">'.$item['description'].'</textarea></div></div>
';
 
echo '
<input type="hidden" name="ID" value="'.$ID.'"/>
<input type="hidden" name="CompID" value="'.$_POST['CompID'].'"/>
';
?>
<p><label>Status: </label>
<select name="status">
<?php
define("modify_utils.php", True);
include_once 'modify_utils.php';
$status = modify_list_of_status();
if(!empty($status)) {
    $selected = $item['status'];
    foreach ($status as $s) {
        echo "<option value=\"".$s['status']."\"";
        if ($s['status'] == $selected) {
            echo " selected=\"selected\"";
        }
        echo ">".$s['status']."</option>";
    }
}
?>
</select></p>										    
                    <?php include_once './pictures.php'; ?>
                    <div class="form-actions">
                        <button class="btn btn-primary" type="submit" value="Modify" class="button">Modify</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>


    
<?php
    include('footer.php');
?>
