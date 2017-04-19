<?php

require_once "connect.php";
require_once "blogController.php";

$db = Connect::dbConnect();
$myblog = new Blog($db);

if(isset($_POST['delete']))
{
    $id = $_POST['id'];
    $delete = $myblog->deletePost($id);
    if($delete == 1) {
        header("Location: blog.php");
    }
}