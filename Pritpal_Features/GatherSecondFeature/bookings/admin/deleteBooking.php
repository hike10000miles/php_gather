<?php


require_once "../connect.php";
require_once "../booking.php";

$db = Connect::dbConnect();
$mybooking = new Booking($db);

if(isset($_POST['delete']))
{
    $id = $_POST['id'];
    $delete = $mybooking->deleteBooking($id);
    if($delete == 1) {
        header("Location: index.php");
    }
}