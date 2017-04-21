<?php

include_once "Connect.php";
include_once "DiscountDAO.php";


$mydi = new Connect();
$list = new DiscountDAO();

$pdoconn = $mydi->getDb();

if(isset($_GET['delete'])){
    $id = $_GET['id'];
    $list->deletePromotion($pdoconn, $id);
    header("Location: Admin_PromotionIndex.php");
}

