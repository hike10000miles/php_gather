<?php
//fake credit card number- 4242 4242 4242 4242
if(!defined("__root")) {
    require( $_SERVER['DOCUMENT_ROOT']. "\php_gather\configer.php");
}
include __root . 'DbConnect/connect.php';
include __root . 'controllers/PaymentsController.php';


//require_once "database.php";
//require_once "PaymentsController.php";


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

    $row=$a->getevents();


    if (isset($row)){
        foreach($row as $r) {
            //echo "<tr>";

            echo "<td>$r->EventName</td>";

            echo "<td>$r->price</td>";


            echo "<td style='display: inline-flex;'>";
            echo "<form method='post' action='StripePaymentForm.php '>
<input type='hidden' name='price' value='$r->price'/>
                                    <input type='hidden' name='id' value='$r->id'/>
                                    <input  type='submit' name='view_images' value='goto pay'/>
                              </form>";

            echo "</td>";
            echo "</tr>";

        }

    }


    ?>

    </tbody>
</table>
