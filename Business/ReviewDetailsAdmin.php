<?php
if(!defined("__root")) {
    require( $_SERVER['DOCUMENT_ROOT']. "\php_gather\configer.php");
}
include __root . 'DbConnect/connect.php';
include __root . 'controllers/ReviewsController.php';


//require_once "../header.php";
//require_once "database.php";

//require_once "ReviewsController.php";



$post_id="";
$db=connect::dbConnect();

if (isset($_POST['post_id'])) {
    $post_id = $_POST['post_id'];
    //var_dump($post_id);
}


//var_dump($post_id);
    $a = new Admin($db);
    $row= $a->displayalldata($post_id);
if(isset($row)) {


         ?>
        <style>
            #details{
                border: solid black;
                border-radius: 8px;
                background-color: lavender;
                margin-top: 50px;

            }
            #list{
                list-style-type: none;
                margin-bottom: 10px;

            }
        </style>
<ul id="details">
<li id="list">ID:<?php echo  $row->post_id ; ?></li>
<li>DATE:<?php echo $row->date ; ?></li>
 <li>NAME:<?php echo $row->fname;?></li>
        <li>EMAIL:<?php echo $row->email;?></li>
        <li>REVIEW:<?php echo $row->review;?></li>
        <li>Business: <?php echo $row->business_id; ?></li>
        <li>Rating: <?php echo $row->rating; ?></li>

        <li>STATUS:<?php echo $row->status;?></li>
</ul>




 <?php

}   //header("Location: ReviewAdmin.php");

 ?>
<h3><a href="ReviewAdmin.php">Back to reviews</a></h3>


<?php
//require_once "../footer.php";

?>