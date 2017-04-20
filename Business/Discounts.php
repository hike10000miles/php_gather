<?php
if(!defined("__root")) {
    require( $_SERVER['DOCUMENT_ROOT']. "\php_gather\configer.php");
}
include __root . 'DbConnect/connect.php';
include __root . 'controllers/DiscountController.php';


$db = Connect::dbConnect();

$discountcontroller = new DiscountDAO();

session_start();

$_SESSION['businessid'] = 3;

$listdiscounts = $discountcontroller->getDiscountListbyBusiness($db,$_SESSION['businessid']);


if(isset($_GET['id'])){
    $id = $_GET['id'];
    $discounts = $dataAO->getDiscount($db,$id);
}

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
    <?php include(__root."views/components/header.php"); ?>
<div class="container">
    <?php include("../bootstrap/css/header.php"); ?>
<h1>Manage Promotions</h1>
    <form action="addPromotion.php" method="get">
        <input type="submit" value="Add Promotion" name="ADD"><br /><br />
    </form>
    <div class="table-responsive">
    <table class="table">
        <tr>
            <th>Title</th>
            <th>Discount(%)</th>
            <th>Event Name</th>
            <th>Start Date</th>
            <th>Expiry Date</th>
            <th></th>
            <th></th>
        </tr>
        <?php foreach($listdiscounts as $listdis): ?>
        <tr>
            <td><?php echo $listdis['title']; ?></td>
            <td><?php echo $listdis['discount']; ?></td>
            <td><?php echo $listdis['name']; ?></td>
            <td><?php echo $listdis['datestart']; ?></td>
            <td><?php echo $listdis['expiry']; ?></td>
            <td>
                <!--add new foreach for just promotions table-->
                <form action="updatePromotion.php" method="get">
                    <input type="hidden" value="<?php echo $listdis['id'];?>" name=id>
                    <input type="submit" value="Update" name="update">
                </form>
            </td>
            <td>
                <form action="deletePromotion.php" method="get">
                    <input type="hidden" value="<?php echo $listdis['id'];?>" name=id>
                    <input type="submit" value="Delete" name="delete">
                </form>
            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    </div>
    <?php include("../bootstrap/css/footer.php"); ?>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
