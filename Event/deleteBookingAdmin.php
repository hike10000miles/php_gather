<?php


require_once "../connect.php";
require_once "../bookingController.php";

$db = Connect::dbConnect();
$mybooking = new Booking($db);

if(isset($_POST['delete']))
{
    $id = $_POST['id'];
    $delete = $mybooking->deleteBooking($id);
    if($delete == 1) {
        header("Location: bookingAdmin.php");
    }
}