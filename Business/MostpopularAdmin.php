<?php
if(!defined("__root")) {
    require( $_SERVER['DOCUMENT_ROOT']. "\php_gather\configer.php");
}
include __root . 'DbConnect/connect.php';
include __root . 'controllers/MostPopularController.php';

//require_once "MostPopularController.php";
//require_once "database.php";

$db= Connect::dbConnect();
$a=new Admin($db);
$row=$a->getmostpopular();



?>


<h2>Most Popular List</h2>

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

<table id="table">
    <thead>
    <tr>

        <th>Most Popular Business</th>

        <th>Average Rating</th>


    </tr>
    </thead>
    <tbody>
    <?php
    if (isset($row)){
        foreach($row as $r) {
            echo "<tr>";

            echo "<td>$r->businessName</td>";
            echo "<td>$r->Average_Rating</td>";

            echo "</td>";
            echo "</tr>";



        }
    }


    ?>
    </tbody>
</table>

