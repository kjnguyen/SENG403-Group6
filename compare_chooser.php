<?php if(!defined("compare_chooser.php"))
{
    echo '404 Not Found';
     header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found', true, 404);die();
}
?>
<div class="container_16">
<?php
// choose items to compare
if(session_id() == '') {
    session_start();
}
// remove a comparison item
if (isset($_POST['deleteCompareItem0'])) {unset($_SESSION['compare_item0']);}
if (isset($_POST['deleteCompareItem1'])) {unset($_SESSION['compare_item1']);}
if (isset($_POST['deleteCompareItem2'])) {unset($_SESSION['compare_item2']);}
if (isset($_POST['deleteCompareItem3'])) {unset($_SESSION['compare_item3']);}
if (isset($_POST['deleteCompareItem4'])) {unset($_SESSION['compare_item4']);}



// add a comparision item

$items = array();
if (isset($_SESSION['compare_item0'])) {$items[] = intval($_SESSION['compare_item0']);}
if (isset($_SESSION['compare_item1'])) {$items[] = intval($_SESSION['compare_item1']);}
if (isset($_SESSION['compare_item2'])) {$items[] = intval($_SESSION['compare_item2']);}
if (isset($_SESSION['compare_item3'])) {$items[] = intval($_SESSION['compare_item3']);}
if (isset($_SESSION['compare_item4'])) {$items[] = intval($_SESSION['compare_item4']);}

if (isset($_POST['addCompareItem'])) {
    // first make sure there are 4 or less items
    if (count($items) >= 5) {
        echo '<p><font color="red">Please remove an item before trying to compare another item</font></p>';
        goto skipAdd;
    }
    // then make sure there are no repeats
    if (!isset($_POST['compareItemID'])) {goto skipAdd;}
    foreach ($items as $item1) {
        if ($item1 == intval($_POST['compareItemID'])) {goto skipAdd;}
    }
    $items[] = intval($_POST['compareItemID']);
    foreach ($items as $key=>$item2) {
        $_SESSION["compare_item$key"] = $item2;
    }
}

skipAdd:
echo '<h3>Compare these items</h3>';
if (count($items) == 0) {echo '<p>no items to compare</p>';}
echo '<form name="delete_item" method="post">';
foreach ($items as $key=>$item3) {
    echo '<p>Compare Item: '.$item3;
    echo '<button name="'."deleteCompareItem$key".'" type="submit">Remove</button></p>';
    $_SESSION["compare_item$key"] = $item3;
}

echo '</form>';
echo '<form name="compare_item" action="compare.php" method="get">';
foreach ($items as $key=>$item) {
    echo '<input type="hidden" name="'."compareItem$key".'" value="'.$item.'"/>';
}
echo '<button type="submit" class="button">Compare</button>';
echo '</form>';

?>

</div>