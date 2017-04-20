<?php

if(!defined("__root")) {
    require( $_SERVER['DOCUMENT_ROOT']. "\php_gather\configer.php");
}
include __root . 'DbConnect/connect.php';
include __root . 'controllers/DiscountController.php';


$db = Connect::dbConnect();
$list = new DiscountDAO();


if(isset($_GET['add'])){

    $eventid = $_GET['eventid'];
    $title = $_GET['title'];
    $discount = $_GET['discount'];
    $startdate = $_GET['startdate'];
    $expiry = $_GET['expiry'];

    $list->addPromotion($db,$eventid, $title, $discount, $startdate, $expiry);
    header("Location: Discounts.php");
}

$events = $list->getEventName($db);
?>

<!DOCTYPE>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
    <?php include(__root."views/components/globalhead.php"); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Business Discounts | Gather</title>
</head>
<body>
<?php include(__root."views/components/userheader.php"); ?>
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