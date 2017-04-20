<?php
if(!defined("__root")) {
    require( $_SERVER['DOCUMENT_ROOT']. "\php_gather\configer.php");
}
include __root . 'DbConnect/connect.php';
include __root . 'controllers/PaymentsController.php';



require_once('./StripePaymentconfig.php');
//require_once "PaymentsController.php";

$db=Connect::dbConnect();


$a=new Admin($db);

session_start();
$_SESSION['totalCost'] = $_POST['price'];
$_SESSION['eventid']=$_POST['id'];
//echo $_SESSION['eventid'];

echo "<h3>"."You are ready to pay $". $_SESSION['totalCost']."</h3>"."<br>";

echo "<h3>"."Click here to go "."</h3>";



?>






<form action="StripePaymentcharge.php" method="post">





    <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            data-key="<?php echo $stripe['publishable_key']; ?>"
            data-description="Access for a year"
            data-amount="<?php echo (100* $_SESSION['totalCost']) ; ?>"
            data-locale="auto"></script>
</form>