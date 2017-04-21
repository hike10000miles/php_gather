<?php

if(!defined("__root")) {
    require( $_SERVER['DOCUMENT_ROOT']. "\php_gather\configer.php");
}
include __root . 'DbConnect/connect.php';
include __root . 'controllers/ReviewsController.php';

//require_once 'database.php';
//require_once "ReviewsController.php";
//require_once "../header.php";

$value = (isset($_POST["value"])) ? $_POST["value"] :"";

$db=Connect::dbConnect();


$a=new Admin($db);
$review = $a->getalldata();


if (isset($_POST["search"]) && $value != "" )
{
    $ad = new Admin($db);
    $review = $ad->searchdata($_POST["value"]);
} elseif ($value == "" && isset($_POST["search"])) {
    $a=new Admin($db);
    $review = $a->getalldata();
}

$post_id="";
if(isset($_POST['delete'])){
    echo $_POST['post_id'];
    $post_id=$_POST['post_id'];
    $d = new Admin($db);
    $row = $d->todeletedata( $post_id);

    header("Location: ReviewAdmin.php");

}



?>
<<<<<<< HEAD


=======
>>>>>>> kevin
<!DOCTYPE>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
    <?php include(__root."views/components/globalhead.php"); ?>
<<<<<<< HEAD
=======

>>>>>>> kevin
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Business | Gather</title>
</head>
<body>
<?php include(__root."views/components/userheader.php"); ?>
<div class="container">
<<<<<<< HEAD

=======
>>>>>>> kevin
<h2>Review List</h2>
    <button class="btn btn-default" id="back">Go Back To Business</button><br/><br/>
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
        background-color: limegreen;
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


<form method='post' action='ReviewAdmin.php'>

    <input type="text" name='value' placeholder="Search by status">
    <input  type='submit' name='search' value='search' />
</form>




<table id="table">
    <thead>
    <tr>
        <th>ID</th>
        <th>Date</th>
        <th>Reviewer Name</th>
        <th>Review</th>

        <th>Business</th>
        <th>Likes</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if (isset($review)){
        foreach($review as $r) {
            echo "<tr>";
            echo "<td>$r->post_id</td>";
            echo "<td>$r->date</td>";
            echo "<td>$r->fname</td>";

            echo "<td>$r->review</td>";


           // echo "<td>$r->rating</td>";
           $row3 = $a->searchbusinessbyID($r->business_id);
            echo "<td>$row3->businessName </td>";
            echo "<td>$r->likes</td>";
            echo "<td>$r->status</td>";


            echo "<td style='display: inline-flex;'>";
            echo "<form method='post' action='ReviewEditAdmin.php '>
                                    <input type='hidden' name='post_id' value='$r->post_id'/>
                                    <input  type='submit' name='edit' value='Publish'/>
                              </form>";

            echo "<form method='post' action=''>
                                    <input type='hidden' name='post_id' value='$r->post_id'/>
                                    <input  type='submit' name='delete' value='Delete' onClick=\"javascript: return confirm('Do you really want to delete this review?');\"/>
                              </form>";




            echo "<form method='post' action='ReviewDetailsAdmin.php'>
    <input type='hidden' name='post_id' value='$r->post_id'/>
    <input  type='submit' name='details' value='Details' />
</form>";

            echo "</td>";
            echo "</tr>";



        }
    }


    ?>
    </tbody>
</table>
<<<<<<< HEAD



<?php


 include(__root."views/components/footer.php"); ?>
=======
    <?php include(__root."views/components/footer.php"); ?>
>>>>>>> kevin
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src='<?php echo __httpRoot . "assest/"; ?>bootstrap/js/bootstrap.min.js'></script>

<<<<<<< HEAD

</div>
</body>
</html>


=======
</div>
</body>
<script>
    var btn = document.getElementById('back');
    btn.addEventListener('click', function() {
        document.location.href = 'Business.php';
    });
</script>
</html>
>>>>>>> kevin

