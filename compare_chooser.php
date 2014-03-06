<?php if(!defined("compare_chooser.php"))
{
    echo '404 Not Found';
     header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found', true, 404);die();
}
?>
<div class="container_16">
<?php
// choose items to compare
session_start();

if (isset($_POST['deleteCompareItem1'])) {unset($_SESSION['compare_item1']);}
if (isset($_POST['deleteCompareItem2'])) {unset($_SESSION['compare_item2']);}
if (isset($_POST['deleteCompareItem3'])) {unset($_SESSION['compare_item3']);}



$item_count = 0;
$item1 = NULL;
$item2 = NULL;
$item3 = NULL;
if (isset($_SESSION['compare_item1'])) {$item1 = $_SESSION['compare_item1']; $item_count ++;}
if (isset($_SESSION['compare_item2'])) {$item2 = $_SESSION['compare_item2']; $item_count ++;}
if (isset($_SESSION['compare_item3'])) {$item3 = $_SESSION['compare_item3']; $item_count ++;}

if (isset($_POST['addCompareItem'])) {
    if ($item_count >= 3) {
        echo '<p><font color="red">Please remove an item before trying to compare another item</font></p>';
        goto skipAdd;
    }
    if (!isset($_POST['compareItemID'])) {goto skipAdd;}
    $item_count ++;
    if (!$item1) {
        $item1 = $_POST['compareItemID'];
        $_SESSION['compare_item1'] = $_POST['compareItemID'];
    }
    else if (!$item2) {
        $item2 = $_POST['compareItemID'];
        $_SESSION['compare_item2'] = $_POST['compareItemID'];
    }
    else if (!$item3) {
        $item3 = $_POST['compareItemID'];
        $_SESSION['compare_item3'] = $_POST['compareItemID'];
    }
}

skipAdd:
echo '<h3>Compare these items</h3>';
if ($item_count == 0) {echo '<p>no items to compare</p>';}
echo '<form name="delete_item" method="post">';
if ($item1) {
    echo '<p>Compare Item#1: '.$item1;
    echo '<button name="deleteCompareItem1" type="submit" value="Search">Remove</button></p>';
}
if ($item2) {
    echo '<p>Compare Item#2: '.$item2;
    echo '<button name="deleteCompareItem2" type="submit" value="Search">Remove</button></p>';
}
if ($item3) {
    echo '<p>Compare Item#3: '.$item3;
    echo '<button name="deleteCompareItem3" type="submit" value="Search">Remove</button></p>';
}
echo '</form>';
echo '<form name="compare_item" action="compare.php" method="get">';
if ($item1) {echo '<input type="hidden" name="compareItem1" value="'.$item1.'"/>';}
if ($item2) {echo '<input type="hidden" name="compareItem2" value="'.$item2.'"/>';}
if ($item3) {echo '<input type="hidden" name="compareItem3" value="'.$item3.'"/>';}
echo '<button type="submit" value="Search" class="button">Compare</button>';
echo '</form>';

?>

</div>