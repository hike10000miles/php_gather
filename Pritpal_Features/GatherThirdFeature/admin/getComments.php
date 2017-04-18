<?php

require_once "connect.php";
require_once "blog.php";

$db = Connect::dbConnect();


if(isset($_POST['comment'])){
    $id=$_POST['id'];
    $myblog = new Blog($db);
    $com = $myblog->getComment($id);
    var_dump($com);
//    if($com == 1) {
//        header("Location: index.php");
//        echo $com->username;
//    }
}
if(isset($com)){
    echo $com->username;
    echo "Hello";
}
