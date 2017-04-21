<?php
if(!defined("__root")) {
    require( $_SERVER['DOCUMENT_ROOT']. "\php_gather\configer.php");
}
include __root . 'DbConnect/connect.php';
include __root . 'controllers/ReviewsController.php';
//include '../header.php';
//require_once "database.php";
//require_once "ReviewsController.php";

$db= Connect::dbConnect();
session_start();
$error_text=$fname=$review=$email_error=""; ?>

<?php
$a= new Admin($db);

session_start();

$business = $_SESSION['businessid'];

?>

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
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Business | Gather</title>
</head>
<body>
<?php include(__root."views/components/userheader.php"); ?>
<div class="container">


<h2>Write a review here</h2>

<form name="customer_reviews" id="submit_form">
<fieldset name="review">

            <div>
                <label for="fname">Your Name:</label>
                <input type="text" id="fname" name="fname" placeholder="Type your full name"/><span id="name_text"><?php echo $error_text;?></span>

            </div>



            <div>
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" placeholder="abc@gmail.com"/><span id="email_text"><?php echo $email_error;?></span>
            </div>


            <div>
                <label for="review">Review:</label>
                <textarea id="review" name="review" rows="4" cols="50"></textarea><span id="review_text"><?php echo $error_text; ?></span>

            </div>
    <div>
        <input type="submit" id="submit_review" value="submit" name="submit"/>
    </div>


<div id="review_response">

</div>

</fieldset>

</form>

    <script>
        $('#submit_review').click(function(e)
        {

            e.preventDefault();

            $.ajax({
                url: 'review_response.php',
                type:'POST',
                data:
                    {
                        'fname': $('#fname').val(),
                        'email': $('#email').val(),
                        'review':$('#review').val(),
                        'BID':'<?php echo $business; ?>'
                    },
                success: function(res)
                {
                   // alert('Review submitted');
                    if (res.code == 200) {
                        $('#review_response').html("Your review is submitted.Thank You!");
                    } else {
                        $('#review_response').html("Invalid Input");
                    }

                }
            });
        });

    </script>
<?php include(__root."views/components/footer.php"); ?>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src='<?php echo __httpRoot . "assest/"; ?>bootstrap/js/bootstrap.min.js'></script>
</div>
</body>
</html>
