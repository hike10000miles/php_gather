<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="liststyle.css">

</head>
<?php

require_once "../header.php";

require_once "connect.php";
require_once "booking.php";

$db = Connect::dbConnect();

$mybooking = new Booking($db);
$list = $mybooking->listEvents();

echo "<h2 id='list'>Events Listing</h2>";
echo "<table id='rounded-corner'>
        <thead>
            <tr>
                <th scope='col' class='rounded-company'>Title</th>
                <th scope='col' class='rounded-company'>Action</th>
            </tr>
        </thead>
        <tbody>";



foreach ($list as $l) {
    echo "
    <tr>
    <td>
        <a href='index.php?id=" . $l->id . "'>" . $l->name . "</a>
    </td>
    <td>
        <form action=\"bookEvents.php\" method=\"post\">
        <input type=\"hidden\" value='" . $l->id . "' name=\"id\">
        <input id='btn1' class='button' type=\"submit\" name=\"book\" value=\"Book\"/>
        </form>
    </td>
    </tr>
    ";
}
echo "</tbody></table>";

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $details = $mybooking->eventDetails($id);
}

if(isset($details))
{
    echo "<h2>Event Details</h2>";
    echo "<b>Event Name: </b>" . $details->name . "<br/>";
    echo "<b>Description: </b>" . $details->description . "<br/>";
    // echo "<b>Description: </b>" . $details->capacity . "<br/>";
}

require_once "../footer.php";
?>