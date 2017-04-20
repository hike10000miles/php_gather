<?php

if(!defined("__root")) {
require( $_SERVER['DOCUMENT_ROOT']. "\php_gather\configer.php");
}
include __root . 'DbConnect/connect.php';
include __root . 'controllers/ReviewsController.php';



//require_once 'database.php';
//require_once "ReviewsController.php";

$db=Connect::dbConnect();


$a=new Admin($db);
$row9=$a->getrating();

//var_dump($row9);

if(isset($_POST['delete'])){
    echo $_POST['id'];
    $id=$_POST['id'];
    $a = new Admin($db);
    $row10 = $a->deleterating( $id);

    header("Location: RatingAdmin.php");

}



?>


<h2>Review List</h2>

<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even){background-color: #f2f2f2}

    th {
        background-color: #4CAF50;
        color: white;
    }

</style>

<style>
    input[type=text] {
        width: 130px;
        box-sizing: border-box;
        border: 2px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
        background-color: white;

        background-position: 10px 10px;
        background-repeat: no-repeat;
        padding: 12px 20px 12px 40px;
        -webkit-transition: width 0.4s ease-in-out;
        transition: width 0.4s ease-in-out;
    }

    input[type=text]:focus {
        width: 50%;
    }
</style>

<table id="table">
    <thead>
    <tr>
        <th>ID</th>

        <th>USER ID</th>
        <th>Date</th>
        <th>Business</th>
        <th>Rating</th>
        <th>Actions</th>


    </tr>
    </thead>
    <tbody>
    <?php
    if (isset($row9)){
        foreach($row9 as $r) {
            echo "<tr>";
            echo "<td>$r->id</td>";
            echo "<td>$r->user_id</td>";
            echo "<td>$r->date</td>";
            $row3 = $a->searchbusinessbyID($r->business_id);
            echo "<td>$row3->businessName</td>";

            echo "<td>$r->rating</td>";
            echo "</td>";


            echo "<td style='display: inline-flex;'>";
            echo "<form method='post' action=''>
                                    <input type='hidden' name='id' value='$r->id'/>
                                    <input  type='submit' name='delete' value='Delete' onClick=\"javascript: return confirm('Do you really want to delete this rating?');\"/>
                              </form>";
            echo "</td>";


        }
    }


    ?>
    </tbody>
</table>





