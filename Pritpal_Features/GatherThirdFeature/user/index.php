<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
        window.onload = function () {

        var outTwo =document.getElementById('output');
        outTwo.style.display = "none";
        var msg = document.getElementById('title');
        msg.onclick = process;
        function process(){
            var outOne = document.getElementById('output');
            outOne.style.display = "block";
        }
        }
    </script>
</head>
<body>

<?php

require_once "../connect.php";
require_once "../blogController.php";

$db = Connect::dbConnect();

$myblog = new Blog($db);
$list = $myblog->listBlog();


$message = "";
echo"
<h1>Hello World!</h1>";
foreach ($list as $l) {
    echo "
        <div class=\"container-fluid\">

    <div class=\"row\" style=\" border: 2px solid black; margin-bottom: 2em; background-color: #ebf5fb;\">
        <div class=\"col-sm-4\" style=\"padding: 2em;\">
        <img src='../uploads/" . $l->image ."' width='250px' height='250px'/>
        
</div>
        <div class=\"col-sm-8\" style=\"\">
        <h2>
        <a href='index.php?id=" . $l->id . "'>" . $l->title . "</a></h2>" . $l->content . "<br/>
        
        </div>
    </div>
    
    <div>
    <form action=\"comment.php\" method=\"post\">
    <input type=\"hidden\" value='" . $l->id . "' name=\"id\">
    <input id='btn2' class='button' type=\"submit\" name=\"reply\" value=\"Comment\">
    </form>
    </div>
</div>
        ";
}


if(isset($_GET['id'])){
    $id = $_GET['id'];
    $details = $myblog->blogDetails($id);
}

if(isset($details))
{
    echo "<h2>Post Details</h2>";
    echo "<b>Post Title: </b>" . $details->title . "<br/>";
    echo "<b>Content: </b>" . $details->content . "<br/>";


    // echo "<b>Description: </b>" . $details->capacity . "<br/>";
}
