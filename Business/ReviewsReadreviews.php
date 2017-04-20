
<?php

    if(!defined("__root")) {
        require( $_SERVER['DOCUMENT_ROOT']. "\php_gather\configer.php");
    }
    include __root . 'DbConnect/connect.php';
    include __root . 'controllers/ReviewsController.php';
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Business | Gather</title>
</head>
<body>
<?php include(__root."views/components/userheader.php"); ?>
<div class="container">


<?php
//include '../header.php';
//require_once "database.php";
//require_once "ReviewsController.php";

$db= Connect::dbConnect();

$error_text=$fname=$review=$email_error="";

$a= new Admin($db);

//$row = $a->getalldata();

if (isset($_GET['businessId'])) {
    $businessId = $_GET['businessId'];
    $row6 = $a->displayreviewsbybusinessid($businessId);


 ?>

<h2>Most Recent Customer Reviews</h2>
<?php
foreach ($row6 as $r) {
    if (($r->status == 'approved') || ($r->status == 'Approved')) {


        ?>
        <style>#name {
                list-style-type: none;
            }</style>

        <ul id="display">


            <li id="name"><b> Review By: <?php echo $r->fname; ?></b></li>

            <li id="name"><?php echo $r->date; ?> </li>
            <li id="list3"> <?php echo $r->review; ?></li>


        </ul>


        <form action=" " method="post">
        <input type="hidden" value="<?php echo $r->post_id; ?>" name="post_id">
        <input type="submit" id="like" value="like" name="like"/><span id="num_likes"><?php

                $row = $a->displayalldata($r->post_id);
                echo " " . $row->likes . " people liked";

        ?></span>


            </form>
        <?php
        }
    }
} ?>





<?php

if(isset($_POST['like'])) {

    $row4 = $a->getlikes($_POST['post_id']);





}

?>
<link rel="stylesheet" type="text/css" href="style.css">
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>


    <?php
   // require_once "rating.php";

    ?>

    <form action="" name="ratings" id="ratings">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script>

            $(document).ready(function(){

                    var clicked_val=0;

                    $('#1_star').hover(function () {
                        $('#1_star').attr('src','<?php echo __httpRoot . "assest/"?>images/starn.png');
                        $('#2_star').attr('src','<?php echo __httpRoot . "assest/"?>images/blankn.png');
                        $('#3_star').attr('src','<?php echo __httpRoot . "assest/"?>images/blankn.png');
                        $('#4_star').attr('src','<?php echo __httpRoot . "assest/"?>images/blankn.png');
                        $('#5_star').attr('src','<?php echo __httpRoot . "assest/"?>images/blankn.png');

                    })  ;


                    $('#1_star').click(function () {

                        clicked_val=1;


                    });


                    $('#2_star').hover(function () {
                        $('#1_star').attr('src','<?php echo __httpRoot . "assest/"?>images/starn.png');
                        $('#2_star').attr('src','<?php echo __httpRoot . "assest/"?>images/starn.png');
                        $('#3_star').attr('src','<?php echo __httpRoot . "assest/"?>images/blankn.png');
                        $('#4_star').attr('src','<?php echo __httpRoot . "assest/"?>images/blankn.png');
                        $('#5_star').attr('src','<?php echo __httpRoot . "assest/"?>images/blankn.png');


                    })  ;


                    $('#2_star').click(function () {

                        clicked_val=2;


                    });


                    $('#3_star').hover(function () {
                        $('#1_star').attr('src','<?php echo __httpRoot . "assest/"?>images/starn.png');
                        $('#2_star').attr('src','<?php echo __httpRoot . "assest/"?>images/starn.png');
                        $('#3_star').attr('src','<?php echo __httpRoot . "assest/"?>images/starn.png');
                        $('#4_star').attr('src','<?php echo __httpRoot . "assest/"?>images/blankn.png');
                        $('#5_star').attr('src','<?php echo __httpRoot . "assest/"?>images/blankn.png');


                    })  ;

                    $('#3_star').click(function () {

                        clicked_val=3;


                    });


                    $('#4_star').hover(function () {
                        $('#1_star').attr('src','<?php echo __httpRoot . "assest/"?>images/starn.png');
                        $('#2_star').attr('src','<?php echo __httpRoot . "assest/"?>images/starn.png');
                        $('#3_star').attr('src','<?php echo __httpRoot . "assest/"?>images/starn.png');
                        $('#4_star').attr('src','<?php echo __httpRoot . "assest/"?>images/starn.png');
                        $('#5_star').attr('src','<?php echo __httpRoot . "assest/"?>images/blankn.png');


                    })  ;

                    $('#4_star').click(function () {

                        clicked_val=4;


                    });



                    $('#5_star').hover(function () {
                        $('#1_star').attr('src','<?php echo __httpRoot . "assest/"?>images/starn.png');
                        $('#2_star').attr('src','<?php echo __httpRoot . "assest/"?>images/starn.png');
                        $('#3_star').attr('src','<?php echo __httpRoot . "assest/"?>images/starn.png');
                        $('#4_star').attr('src','<?php echo __httpRoot . "assest/"?>images/starn.png');
                        $('#5_star').attr('src','<?php echo __httpRoot . "assest/"?>images/starn.png');


                    })  ;


                    $('#5_star').click(function () {

                        clicked_val=5;


                    });


                    $('.rating_stars').mouseout(function(){

                        if(clicked_val=== 0 || clicked_val > 5)
                        {

                            $('#1_star').attr('src', '<?php echo __httpRoot . "assest/"?>images/blankn.png');
                            $('#2_star').attr('src', '<?php echo __httpRoot . "assest/"?>images/blankn.png');
                            $('#3_star').attr('src', '<?php echo __httpRoot . "assest/"?>images/blankn.png');
                            $('#4_star').attr('src', '<?php echo __httpRoot . "assest/"?>images/blankn.png');
                            $('#5_star').attr('src', '<?php echo __httpRoot . "assest/"?>images/blankn.png');
                        }

                        else if(clicked_val==1)
                        {
                            $('#1_star').attr('src','<?php echo __httpRoot . "assest/"?>images/starn.png');
                            $('#2_star').attr('src','<?php echo __httpRoot . "assest/"?>images/blankn.png');
                            $('#3_star').attr('src','<?php echo __httpRoot . "assest/"?>images/blankn.png');
                            $('#4_star').attr('src','<?php echo __httpRoot . "assest/"?>images/blankn.png');
                            $('#5_star').attr('src','<?php echo __httpRoot . "assest/"?>images/blankn.png');
                        }
                        else if(clicked_val==2)
                        {
                            $('#1_star').attr('src','<?php echo __httpRoot . "assest/"?>images/starn.png');
                            $('#2_star').attr('src','<?php echo __httpRoot . "assest/"?>images/starn.png');
                            $('#3_star').attr('src','<?php echo __httpRoot . "assest/"?>images/blankn.png');
                            $('#4_star').attr('src','<?php echo __httpRoot . "assest/"?>images/blankn.png');
                            $('#5_star').attr('src','<?php echo __httpRoot . "assest/"?>images/blankn.png');
                        }
                        else if(clicked_val==3)
                        {
                            $('#1_star').attr('src','<?php echo __httpRoot . "assest/"?>images/starn.png');
                            $('#2_star').attr('src','<?php echo __httpRoot . "assest/"?>images/starn.png');
                            $('#3_star').attr('src','<?php echo __httpRoot . "assest/"?>images/starn.png');
                            $('#4_star').attr('src','<?php echo __httpRoot . "assest/"?>images/blankn.png');
                            $('#5_star').attr('src','<?php echo __httpRoot . "assest/"?>images/blankn.png');
                        }
                        else if(clicked_val==4)
                        {
                            $('#1_star').attr('src','<?php echo __httpRoot . "assest/"?>images/starn.png');
                            $('#2_star').attr('src','<?php echo __httpRoot . "assest/"?>images/starn.png');
                            $('#3_star').attr('src','<?php echo __httpRoot . "assest/"?>images/starn.png');
                            $('#4_star').attr('src','<?php echo __httpRoot . "assest/"?>images/starn.png');
                            $('#5_star').attr('src','<?php echo __httpRoot . "assest/"?>images/blankn.png');
                        }
                        else if(clicked_val==5)
                        {
                            $('#1_star').attr('src','<?php echo __httpRoot . "assest/"?>images/starn.png');
                            $('#2_star').attr('src','<?php echo __httpRoot . "assest/"?>images/starn.png');
                            $('#3_star').attr('src','<?php echo __httpRoot . "assest/"?>images/starn.png');
                            $('#4_star').attr('src','<?php echo __httpRoot . "assest/"?>images/starn.png');
                            $('#5_star').attr('src','<?php echo __httpRoot . "assest/"?>images/starn.png');

                        }

                    });

                    $('#submit_rating').click(function () {

                        if(clicked_val === 0 || clicked_val > 5)
                        {
                            $('#response').html('Please give a rating');
                        }
                        else
                        {
                            $.ajax({

                                type:'POST',
                                cache:false,
                                url:'rating_response.php',
                                data:{'clicked_val':clicked_val, 'BId' :  <?php echo $businessId ; ?>},
                                success:function (response) {
                                    //alert(response);
                                    $('#response').html("Your rating will be " + response);
                                    $('#rating').val(response);
                                }


                            });
                        }

                    });

                }
            );

        </script>







        <div class="rating_container">
            <div class="rating_stars" style="padding: 10px"  style="margin-left: 35px">
                <img src="<?php echo __httpRoot . "assest/"?>images/blankn.png" id="1_star" style="margin-right: 10px " />
                <img src="<?php echo __httpRoot . "assest/"?>images/blankn.png" id="2_star"/>
                <img src="<?php echo __httpRoot . "assest/"?>images/blankn.png" id="3_star"/>
                <img src="<?php echo __httpRoot . "assest/"?>images/blankn.png" id="4_star"/>
                <img src="<?php echo __httpRoot . "assest/"?>images/blankn.png" id="5_star"/>

            </div>
        </div>
        <div>
            <input type="hidden" id="rating" name="rating" value="<?php echo (isset($_POST['clicked_val'])) ? $_POST['clicked_val'  ] : 0; ?>"/>
            <input type="button" value="submit rating" id="submit_rating" name="ratingvalue"/>
        </div>
        <div id="response">


        </div>



    </form>

<h2 xmlns="http://www.w3.org/1999/html">Write a review here</h2>

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

    <script type="text/javascript" src="validation.js"></script>
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
                        'BID':'<?php echo $businessId; ?>'
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

<?php


 include(__root."views/components/footer.php"); ?>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src='<?php echo __httpRoot . "assest/"; ?>bootstrap/js/bootstrap.min.js'></script>
</div>


</body>
</html>
