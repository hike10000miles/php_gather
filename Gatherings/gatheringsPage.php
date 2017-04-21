<?php
if(!defined("__root")) {
    require( $_SERVER['DOCUMENT_ROOT']. "\php_gather\configer.php");
}
include __root . 'DbConnect/connect.php';
include __root . 'controllers/gatheringsController.php';
//include __root . 'controllers/EventController.php';


//$businessview = new BusinessDAO();
//$eventController = new EventConnect($db);

session_start();
if (!isset($_SESSION['user_id']) && !isset($_SESSION['gatherid'])) {
    echo "Sorry, there was a problem with your gathering, you will now be redirected to sign up again";
    header('Location: create.php');
}

$_SESSION['role'] = "normal";
$_SESSION['gatherid'] = 4;

$db = Connect::dbConnect();


$thisuserDetails = new gatheringsController($db);
$usersDetails = $thisuserDetails->selectUserDetails($db, $_SESSION['user_id']);

$gatheringDetails = new gatheringsController($db);
$row = $gatheringDetails->selectGathering($db, $_SESSION['gatherid']);
var_dump($row);

//$gatheringDetails = new gatheringsController($db);
//$fetchUsers = $gatheringDetails->get_Gatheringusers($db, $_SESSION['gatherid']);
//var_dump($fetchUsers);

$gatheringDetails = new gatheringsController($db);
$fetchUsers = $gatheringDetails->get_GatheringusersModified($db, $_SESSION['gatherid']);
var_dump($fetchUsers);

$eventsInGathering = new gatheringsController($db);
$fetchEvents = $eventsInGathering->get_GatheringusersModified($db, $_SESSION['gatherid']);
var_dump($fetchEvents);



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




<!--    --><?php //foreach($row as $gr): ?>
        <div class="row">
            <div class="col-md-3">
                <h1 class=""><?php echo $row['gatheringName']; ?></h1>
<!--                <i style="color:green" class="fa fa-check-square"></i> Still In Business-->
<!--                <div class="ratings">-->
<!--                    <span>-->
<!--                        <span class="glyphicon glyphicon-star"></span>-->
<!--                        <span class="glyphicon glyphicon-star"></span>-->
<!--                        <span class="glyphicon glyphicon-star"></span>-->
<!--                        <span class="glyphicon glyphicon-star"></span>-->
<!--                        <span class="glyphicon glyphicon-star"></span>-->
<!--                    </span>-->
<!--                    <span>15 reviews</span><br/><br/>-->
<!--                </div>-->
<!--                --><?php //if($_SESSION['role'] == 'normal'): ?>
<!--                    <div>-->
<!--                        <button type="button" class="btn btn-danger">Leave A Review</button>-->
<!--                        <button type="button" class="btn btn-info" style="margin-top:1em;">Send me a message</button>-->
<!--                    </div>-->
<!--                --><?php //else: ?>
<!--                    <div>-->
<!--                        <button type="button" class="btn btn-danger">Update Details</button>-->
<!--                        <button type="button" class="btn btn-info" style="margin-top:1em;">Manage Promotion</button>-->
<!--                    </div>-->
<!--                --><?php //endif; ?>
            </div>
            <div class="col-md-9">
                <img title="profile image" class="img-responsive" src="http://lorempixel.com/850/250/sports">
            </div>
        </div>
        <div class="row" style="margin-top:1em;">
            <div class="col-sm-3">
                <!--left col-->
                <ul class="list-group">
                    <li class="list-group-item text-muted" contenteditable="false">Gathering's Info</li>
                    <li class="list-group-item text-right"><span class="pull-left"><strong class="">Date Created</strong></span> <?php echo $row['creationDate']?></li>
                    <li class="list-group-item text-right"><span class="pull-left"><strong class="">Status:</strong></span>Closed Group</li>
                </ul>
                <ul class="list-group">
                    <li class="list-group-item text-muted">Created By: <i class="fa fa-address-book-o fa-1x"></i></li>
                    <li class="list-group-item text-left"><strong class=""><?php echo $row['userid']; ?></strong></li>
                </ul>

<!--                <div class="panel panel-default">-->
<!--                    <div class="panel-heading">Website <i class="fa fa-link fa-1x"></i>-->
<!---->
<!--                    </div>-->
<!--                    <div class="panel-body"><a href="#" class="">yourwebsite.com</a>-->
<!---->
<!--                    </div>-->
<!--                </div>-->
                <div class="panel panel-default">
                    <div class="panel-heading">Gathering's Members<i class="fa fa-link fa-1x"></i>

                    </div>
                    <div class="panel-body"><a href="#" class="">
                            <?php
                            foreach ($fetchUsers as $key){
                                $query = "SELECT username FROM users WHERE id =".$key['UserId'];
                                $pdostmt2 = $db->prepare($query);
                                $pdostmt2->execute(); // now we execute the statement
                                $gatherresultUsernameswithUserId= $pdostmt2->fetch(PDO::FETCH_ASSOC);
                                $pdostmt2->closeCursor(); //dont forget this, because it disconnects your connection to db cuz there can only be 1 at a atime
                                //var_dump($gatherresultUsernameswithUserId);
                                foreach ($gatherresultUsernameswithUserId as $keyusername){
                                    echo $keyusername;
                                }//return ture because its succesfful
                                ?><br>
                            <?php } ?>
                        </a>

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

            <!--BUSINESS MAIN-->
            <div class="col-sm-9" contenteditable="false" >
                <div class="panel panel-default">
                    <div class="panel-heading"><?php echo $row['gatheringName']; ?> Gathering Description</div>
                    <div class="panel-body"><?php echo $row['gatheringDescription']; ?></div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" contenteditable="false">Events<span class="pull-right"><a href="#">View More</a></span></div>
                    <div class="panel-body">
                        <div class="row">
                            <?php foreach($events as $event): ?>
                                <div class="col-md-4">
                                    <div class="thumbnail">
                                        <img alt="300x200" src="http://lorempixel.com/300/150/technics">
                                        <div class="caption">
                                            <h4 class="pull-right">$24.99</h4>
                                            <h4><a href='<?php echo __httpRoot . "Event/Event.php?id=" . $event->getEventId(); ?>'><?php echo $event->getName(); ?></a></h4>
                                            <p><?php echo $event->getDescription(); ?></p>
                                        </div>
                                        <div class="ratings">
                                            <p class="pull-right">15 reviews</p>
                                            <p>
                                                <span class="glyphicon glyphicon-star"></span>
                                                <span class="glyphicon glyphicon-star"></span>
                                                <span class="glyphicon glyphicon-star"></span>
                                                <span class="glyphicon glyphicon-star"></span>
                                                <span class="glyphicon glyphicon-star"></span>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">Review</div>
                    <div class="panel-body"> Insert Reviews Here. </div>
                </div>
            </div>
        </div>
<!--    --><?php //endforeach; ?>

    <?php include(__root."views/components/footer.php"); ?>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src='<?php echo __httpRoot . "assest/"; ?>bootstrap/js/bootstrap.min.js'></script>
</div>
</body>
</html>
