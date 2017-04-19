<?php

require_once "../user/connect.php";
require_once "../user/suggestController.php";

$db = Connect::dbConnect();
$mysuggest = new Suggest($db);

if(isset($_POST['delete']))
{
    $id = $_POST['id'];
    $delete = $mysuggest->deleteSuggest($id);
    if($delete == 1) {
        header("Location: suggestionAdmin.php");
    }
}