<?php

include_once "Connect.php";
include_once "DiscountDAO.php";


$mydi = new Connect();
$list = new DiscountDAO();

$pdoconn = $mydi->getDb();

if(isset($_GET['add'])){

    $eventid = $_GET['eventid'];
    $title = $_GET['title'];
    $discount = $_GET['discount'];
    $startdate = $_GET['startdate'];
    $expiry = $_GET['expiry'];

    $list->addPromotion($pdoconn,$eventid, $title, $discount, $startdate, $expiry);
    header("Location: Admin_PromotionIndex.php");
}

$events = $list->getEventName($pdoconn);
?>

<!DOCTYPE>
<html lang="en">
<head>
    <?php include("../bootstrap/css/globalhead.php"); ?>
    <title>Discounts</title>
</head>
<body>
<div class="container">
    <?php include("../bootstrap/css/header.php"); ?>
    <h3>Add Promotion For Event</h3>
<form action="addPromotion.php" method="get">
    <label> Event Name: </label><select name="eventid">
        <?php
        foreach($events as $event){
            echo "<option value=".$event['id'].">".$event['id']."</option>";
        }
        ?>
    </select><br/><br/>
    <label>Title: </label><input type="text" name="title" /><br/><br />
    <label>Discount: </label><input type="text" name="discount" /><br/><br />
    <label>DateStart: </label><input type="date" name="startdate" /><br/><br />
    <label>Expiry: </label><input type="date" name="expiry" /><br/><br />
    <input type="submit" value="Add Promotion" name="add" />
</form>
    <button id="back">Go Back To List</button>
    <br/><br/>

    <?php include("../bootstrap/css/footer.php"); ?>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<script>
    var btn = document.getElementById('back');
    btn.addEventListener('click', function() {
        document.location.href = 'Admin_PromotionIndex.php';
    });
</script>
</body>
</html>