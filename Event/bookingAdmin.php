<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../liststyle.css">
    <style>
        body{
            background-color: white;
        }
    </style>
</head>

<?php

include "../../header.php";

require_once "../connect.php";
require_once "../bookingController.php";

$db = Connect::dbConnect();

$mybooking = new Booking($db);
$list = $mybooking->bookingList();



echo "<h1>List of Bookings</h1>";

echo "<table id='rounded-corner'>
<thead>
<tr>
<th scope='col' class='rounded-company'>Title</th>
<!--<th scope='col' class='rounded-company'>UserName</th>-->
<th scope='col' class='rounded-company'>Action</th>
</tr>
</thead>";
foreach ($list as $l)
{
    echo "
                <tbody>
                    <tr>
                        <td><a href='index.php?id=" . $l->id . "'>" . $l->user_name . "</a></td>
                    
                        <td id='rowbtn'><form action=\"deleteBookingAdmin.php\" method=\"post\">
                            <input type=\"hidden\" value='" . $l->id . "' name=\"id\">
                            <input id='btn1' class='button' type=\"submit\" name=\"delete\" value=\"Delete\" onClick=\"javascript: return confirm('Do you really want to delete this?');\"/>
                            </form>
                            
                            </td>
                    </tr>
                </tbody>
          
    ";
}

echo "</table>";
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $details = $mybooking->bookingDetails($id);
}

if(isset($details))
{
    echo "<h2>Booking Details</h2>";
    echo "<b>Time: </b>" . $details->time . "<br/>";
    echo "<b>Number of People: </b>" . $details->num_of_people . "<br/>";
    echo "<b>User name: </b>" . $details->user_name;
}

include "../../footer.php";
?>