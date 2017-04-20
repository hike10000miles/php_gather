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

$a=new Admin($db);
?>

<table id="table">
    <thead>
    <tr>

        <th>Event Name</th>


    </tr>
    </thead>
    <tbody>

<?php

    $row3=$a->getevents();


    if (isset($row3)){
        foreach($row3 as $r) {
            //echo "<tr>";

            echo "<td>$r->EventName</td>";


            echo "<td style='display: inline-flex;'>";
            echo "<form method='post' action='ImageGalleryView_images.php '>
                                    <input type='hidden' name='id' value='$r->id'/>
                                    <input  type='submit' name='view_images' value='view images'/>
                              </form>";

            echo "</td>";
            echo "</tr>";

        }

    }


    ?>

</tbody>
</table>

<?php // include "../footer.php"; ?>
