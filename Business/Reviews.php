<?php

 if(!defined("__root")) {
    require( $_SERVER['DOCUMENT_ROOT']. "\php_gather\configer.php");
}
include __root . 'DbConnect/connect.php';
include __root . 'controllers/ReviewsController.php';


//require_once 'database.php';
//require_once "ReviewsController.php";

$db=Connect::dbConnect();


$a=new Admin($db);

$row5=$a->getbusiness();
?>


<table id="table">

    <tbody>
    <?php
    if (isset($row5)){
        foreach($row5 as $r) {
            echo "<tr>";
            echo "<td>$r->businessName</td>";

            echo "<td style='display: inline-flex;'>";

            echo '<a href="ReviewsReadreviews.php?businessId=' . $r->id . '">Read reviews</a>';




            echo "</td>";
            echo "</tr>";



        }
    }


    ?>
</tbody>
</table>