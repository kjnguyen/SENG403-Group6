<?php

include_once "header.php";


?>
<section id="content">
<div class="container_16">
<div class="clearfix">
<section id="mainContent" class="grid_10" style="position: relative; width: 100%;">
<article style="position: relative; width: 100%;">
<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if(!defined("search_utils.php")) {define("search_utils.php", True);}
include_once 'search_utils.php';

$compareItems = array();

if (isset($_GET['compareItem1'])) {$compareItems[] = search_one_item(intval($_GET['compareItem1']));}
if (isset($_GET['compareItem2'])) {$compareItems[] = search_one_item(intval($_GET['compareItem2']));}
if (isset($_GET['compareItem3'])) {$compareItems[] = search_one_item(intval($_GET['compareItem3']));}
if (isset($_GET['compareItem4'])) {$compareItems[] = search_one_item(intval($_GET['compareItem4']));}
if (isset($_GET['compareItem5'])) {$compareItems[] = search_one_item(intval($_GET['compareItem5']));}

$itemCount = count($compareItems);
if ($itemCount == 0) {
    echo 'Nothing to compare!';
    die();
}




echo '<table>';

foreach ($compareItems[0] as $key => $item){
    echo '<tr>';
    for ($i = 0; $i < $itemCount; $i ++) {
        echo '<td>';
        echo $compareItems[$i][$key];
        echo '</td>';
    }
    echo '</tr>';
}
echo '<tr>';




echo '</table>';

?>
</article>
</section>
</div>
</div>
</section>
<?php
    include_once "footer.php";
?>