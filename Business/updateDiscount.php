<?php

include_once "Connect.php";
include_once "DiscountDAO.php";


$mydi = new Connect();
$list = new DiscountDAO();

$pdoconn = $mydi->getDb();

if(isset($_GET['update'])) {
    $id = $_GET['id'];
    $listall = $list->getDiscount($pdoconn, $id);
}

if(isset($_GET['upd'])){

    $id = $_GET['aid'];
    $title = $_GET['title'];
    $discount = $_GET['discount'];
    $businessid = $_GET['eventid'];
    $datestart = $_GET['starttime'];
    $expiry = $_GET['expiry'];

    $list->updatePromotion($pdoconn, $title, $discount,$businessid, $datestart, $expiry, $id);
    header("Location: Admin_PromotionIndex.php");
}

$business = $list->getBusinessName($pdoconn);
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
<h3>Update Promotion</h3>
<form action="updatePromotion.php" method="get">
    <input type="hidden" name="aid" value="<?php echo $id ?>" />
    <label>Title: </label><input type="text" name="title" value="<?php echo $listall['title']; ?>"/><br /><br />
    <label>Discount: </label><input type="text" name="discount" value="<?php echo $listall['discount']; ?>"/><br /><br />
    <label>Event Name: </label><select name="eventid">
        <?php
        foreach($events as $item){
            echo "<option value=".$item['id'].">".$item['name']."</option>";
        }
        ?>
    </select><br /><br />
    <label>Date Start: </label><input type="date" name="starttime" value="<?php echo $listall['datestart']; ?>"/><br /><br />
    <label>Expiry: </label><input type="date" name="expiry" value="<?php echo $listall['expiry']; ?>"/><br /><br />
    <input type="submit" value="Update Promotion" name="upd" />
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