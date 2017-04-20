<?php

if(!defined("__root")) {
    require( $_SERVER['DOCUMENT_ROOT']. "\php_gather\configer.php");
}
include __root . 'DbConnect/connect.php';
include __root . 'controllers/ImageGalleryController.php';

//include "../header.php";
//require_once "database.php";
//require_once "ImageGalleryController.php";
$db= Connect::dbConnect();


?>


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


<table id="table" style="margin-top: 10px">
    <thead>
    <tr>
        <th>Event ID</th>
        <th>Event Name</th>
        <th>Actions</th>

    </tr>
    </thead>
    <tbody>
    <?php
    $a=new Admin($db);
    //$row2=$a->getimages();
    //var_dump($row2->event_id);
    $row3=$a->getevents();


    if (isset($row3)){
        foreach($row3 as $r) {
            echo "<tr>";
            echo "<td>$r->id</td>";
            echo "<td>$r->EventName</td>";


            echo "<td style='display: inline-flex;'>";
            echo "<form method='post' action='ImageGalleryImageuploadAdmin.php '>
                                    <input type='hidden' name='id' value='$r->id'/>
                                    <input  type='submit' name='upload' value='upload images'/>
                              </form>";

            echo "</td>";
            echo "</tr>";

        }

    }


    ?>

    </tbody>
</table>
<?php   //include "../footer.php" ;?>