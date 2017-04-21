<?php
session_start();
 if(!defined("__root")) {
    require( $_SERVER['DOCUMENT_ROOT']. "\php_gather\configer.php");
}
include __root . 'DbConnect/connect.php';
include __root . 'controllers/Business.php';
include __root . 'controllers/EventController.php';
include __root . 'controllers/ReviewsController.php';
include __root . 'controllers/MostPopularController.php';

$db = Connect::dbConnect();
$businessview = new BusinessDAO();
$eventController = new EventConnect($db);
$reviewController = new Admin($db);
$rating = new Ratings($db);

if(!isset($_SESSION['LoggedIn']['UserId'])) {
    header("Location: " . __httpRoot);
    exit;
}
/*$reviews = $reviewController->*/


if (isset($_SESSION['LoggedIn']['BusinessId'])) {
    $businessId = $_SESSION['LoggedIn']['BusinessId'];
}

if(isset($_POST['like'])) {
    $row4 = $reviewController->getlikes($_POST['post_id']);
}

if(isset($_GET['id'])){
    $businessId = $_GET['id'];
} else {
    $businessId = $_SESSION['LoggedIn']['BusinessId'];
}
$businessdetails = $businessview->getBusinessInfo($db,$businessId);
$events = $eventController->getEventList($businessId);
$reviews = $reviewController->displayreviewsbybusinessid($businessId);
$ratings = $rating->getmostpopularbyId($businessId);
$totalreview = $reviewController->getCountReviews($businessId);

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

    <?php foreach($businessdetails as $bd): ?>
    <div class="row">
        <div class="col-md-3">
                <h1 class=""><?php echo $bd['businessName']; ?></h1>
                <i style="color:green" class="fa fa-check-square"></i> Still In Business
                <div class="ratings">
                    <span>
                        <?php foreach($ratings as $star) :
                            echo $star->Average_Rating; ?>(Out of 5) <span class="glyphicon glyphicon-star"></span>
                        <?php endforeach; ?>
                    </span>
                    <span><?php foreach($totalreview as $tr): echo $tr['totalreview']; endforeach; ?> Reviews</span><br/><br/>
                </div>
                <?php if(($_SESSION['LoggedIn']['UserRole'] == 'normal')): ?>
                    <div>
                        <a href="<?php echo __httpRoot . "Business/addReviews.php?id=" .$businessId; ?>" class="btn btn-danger" role="button">Leave A Review</a><br /><br/>
                        <a href="<?php echo __httpRoot . "Business/suggestionForm.php?id=" .$businessId; ?>" class="btn btn-info" role="button">Make Suggestion</a>
                    </div>
                <?php endif; ?>
                <?php if(($_SESSION['LoggedIn']['UserRole']== 'business')&&(!isset($_GET['id']))) :?>
                     <div>
                        <a href="<?php echo __httpRoot . "Business/updateBusiness.php?id=" .$businessId; ?>" class="btn btn-info">Update User Profile</a></span><br /><br />
                        <a href="<?php echo __httpRoot . "Business/Discounts.php?id=" .$businessId; ?>" class="btn btn-info">Manage Discount</a></span>
                    </div>
                <?php endif; ?>
        </div>
        <div class="col-md-9">
            <img title="profile image" class="img-responsive" src="http://lorempixel.com/850/250/nightlife">
        </div>
    </div>
    <div class="row" style="margin-top:1em;">
        <div class="col-sm-3">
            <!--left col-->
            <ul class="list-group">
                <li class="list-group-item text-muted" contenteditable="false">Business Info</li>
                <li class="list-group-item text-right"><span class="pull-left"><strong class="">Joined</strong></span> 2.13.2014</li>
                <li class="list-group-item text-right"><span class="pull-left"><strong class="">Capacity:</strong></span><?php echo $bd['businessCapacity']; ?></li>
            </ul>
            <ul class="list-group">
                <li class="list-group-item text-muted">Location <i class="fa fa-address-book-o fa-1x"></i></li>
                <li class="list-group-item text-left"><strong class=""><?php echo $bd['StreetName']; ?></strong></li>
                <li class="list-group-item text-left"><strong class=""><?php echo $bd['City']; ?>, <?php echo $bd['Province']; ?></strong></li>
                <li class="list-group-item text-left"><strong><?php echo $bd['PostalCode']; ?></strong></li>
                <li class="list-group-item text-left"><strong ><?php echo $bd['Country']; ?></strong></li>
             </ul>

            <div class="panel panel-default">
                <div class="panel-heading">Website <i class="fa fa-link fa-1x"></i>

                </div>
                <div class="panel-body"><a href="#" class="">yourwebsite.com</a>

                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Social Media</div>
                <div class="panel-body">
                    <i class="fa fa-facebook fa-2x"></i>
                    <i class="fa fa-github fa-2x"></i>
                    <i class="fa fa-twitter fa-2x"></i>
                    <i class="fa fa-pinterest fa-2x"></i>
                    <i class="fa fa-google-plus fa-2x"></i>
                </div>
            </div>
        </div>

        <!-----------------------------------------BUSINESS MAIN (KEVIN)------------------------------------>
        <div class="col-sm-9" contenteditable="false" >
            <div class="panel panel-default">
                <div class="panel-heading"><?php echo $bd['businessName']; ?> Description</div>
                <div class="panel-body"><?php echo $bd['businessDescription']; ?></div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" contenteditable="false">Events<span class="pull-right">
                <?php if(($_SESSION['LoggedIn']['UserRole']== 'business')&&(!isset($_GET['id']))): ?>
                    <a href='<?php echo __httpRoot . "Event\Create.php";?>' >Add Event</a>
                    <a href="<?php echo __httpRoot . "Business/SuggestionAdmin.php?id=" .$businessId; ?>">Manage Suggestions</a></span>
                <?php endif; ?>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <!-----------------------------------------EVENTS (CHEN)------------------------------------>
                        <?php foreach($events as $event): ?>
                            <div class="col-sm-4 fixheight">
                                <div class="thumbnail">
                                    <img alt="300x200" src="http://lorempixel.com/300/150/technics">
                                    <div class="caption">
                                        <h4 class="pull-right">$24.99</h4>
                                        <h4><a href='<?php echo __httpRoot . "Event/Event.php?id=" . $event->getEventId(); ?>'><?php echo $event->getName(); ?></a></h4>
                                        <p><?php echo $event->getDescription(); ?></p>
                                    </div>
                                </div>
                            </div>

                        <?php endforeach; ?>
                             </div>
                         </div>
                    </div>
            <!-----------------------------------------4. REVIEWS (SIJI)------------------------------------>
            <div class="panel panel-default">

                <div class="panel-heading">
                    Review<span class="pull-right">
                    <?php if(($_SESSION['LoggedIn']['UserRole']== 'business')&&(!isset($_GET['id']))): ?>
                        <a href="<?php echo __httpRoot . "Business/ReviewAdmin.php?id=" .$businessId; ?>">
                        Manage Reviews
                        </a>
                    <?php endif; ?>
                    <?php if(($_SESSION['LoggedIn']['UserRole']== 'normal')): ?>
                        <a href="<?php echo __httpRoot . "Business/addReviews.php?id=" .$businessId; ?>">
                        Add Review
                        </a></span>
                    <?php endif; ?>
                </div>
                <div class="panel-body">
                    <!-----------4.1 USER REVIEW ------>
                    <div class="row">
                        <?php foreach ($reviews as $r) :
                        if (($r->status == 'approved') || ($r->status == 'Approved')): ?>
                            <style>li {
                                    list-style-type: none;
                                }</style>
                                <div class="col-md-12">

                                    <ul id="display">
                                        <li id="name"><b> Review By: <?php echo $r->fname; ?></b></li>
                                        <li id="name"><?php echo $r->date; ?> </li>
                                        <li id="list3"><em><?php echo $r->review; ?></em></li>
                                    </ul>


                                <form action=" " method="POST">
                                    <input type="hidden" value="<?php echo $r->post_id; ?>" name="post_id">
                                    <input class="btn btn-default" type="submit" id="like" value="like" name="like"/><span id="num_likes">
                                        <?php $row = $reviewController->displayalldata($r->post_id);
                                        echo " " . $row->likes . " people liked"; ?></span>
                                </form>
                                <hr />
                                </div>

                                    <?php endif;
                                        endforeach;?>
                        </div>
                    <!----4.2 Rating -------->
                    <?php if(($_SESSION['LoggedIn']['UserRole']== 'normal')): ?>
                    <form action="" name="ratings" id="ratings">
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
                                                data:{'clicked_val':clicked_val, 'BId' :  <?php echo $businessId; ?>},
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
                    <?php endif; ?>
                    <!--------------->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    <?php include(__root."views/components/footer.php"); ?>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src='<?php echo __httpRoot . "assest/"; ?>bootstrap/js/bootstrap.min.js'></script>

</div>
</body>
</html>
