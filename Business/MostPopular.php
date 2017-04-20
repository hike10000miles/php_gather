<?php
if(!defined("__root")) {
    require( $_SERVER['DOCUMENT_ROOT']. "\php_gather\configer.php");
}
include __root . 'DbConnect/connect.php';
include __root . 'controllers/MostPopularController.php';

//include "../header.php";

//require_once "database.php";
//require_once "MostPopularController.php";
?>

<h2 style="font-size: 45px">Most Popular Business</h2>

<p style="font-size: 30px" style="font-style: italic" >List of our most popular business according to our customer ratings and reviews.</p>
<?php
$db= Connect::dbConnect();

$a=new Ratings($db);

$row=$a->getmostpopular();

 foreach ($row as $r) {  ?>

    <ul>
        <li id="heading" style="font-size: 40px"><?php echo $r->businessName; ?></li>
        <li id="rating" style="font-size: 40px"><?php echo $r->Average_Rating ."(Out of 5)" ; ?>
            <img src="<?php echo __httpRoot . "assest/"?>images/blankn.png"/>
            <img src="<?php echo __httpRoot . "assest/"?>images/blankn.png"/>
            <img src="<?php echo __httpRoot . "assest/"?>images/blankn.png"/>
            <img src="<?php echo __httpRoot . "assest/"?>images/blankn.png"/>
            <img src="<?php echo __httpRoot . "assest/"?>images/blankn.png"/>
        </li>
    </ul>

     <style>
         ul{
             list-style: none;
         }
         #heading{
             font-size: 50px;
         }
     </style>
<?php } ?>
<?php //include "../footer.php"; ?>






