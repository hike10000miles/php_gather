<?php
 if(!defined("__root")) {
    require( $_SERVER['DOCUMENT_ROOT']. "\php_gather\configer.php");
}
include __root . 'DbConnect/connect.php';
include __root . 'controllers/Business.php';
include __root . 'controllers/EventController.php';

$db = Connect::dbConnect();
$eventConnect = new EventConnect($db);
$businessview = new BusinessDAO();
$event = null;
$message = null;

session_start();

$_SESSION['id']= 3;
$_SESSION['UserId'] = 4;
$_SESSION['role'] = 'business';

if($_SESSION['role'] == 'business') {

$businessdetails = $businessview->getBusinessInfo($db,$_SESSION['id']);

    if(isset($_GET["id"])) {
        try {
            $event = $eventConnect->getEvent($_GET["id"]);
        } catch(Exception $e) {
            $message = $e->getMessage();
        }
    }

    if(isset($_POST["subbtn"])) {
        if(isset($_SESSION['UserId']) && isset($_POST['EventName']) 
            && isset($_POST['EndDateTime']) && isset($_POST['StartDateTime']) 
            && isset($_POST['BusinessId']) && isset($_POST['EventDescription'])) {
            $result = null;
            try {
                $event = new EventModel($_POST);
            } catch(Exception $e){
                $message = $e->getMessage();
            }
            if($event != null) {
                $eventConnect = new EventConnect($db);
                $result = $eventConnect->createEvent($event);
            } 
            if($result != null && $result) {
                header("Location: http://localhost/views/Business.php/");
                exit;
            } else if(is_a($result, "Exception")) {
                $message = $result->getMessage();
            } else {
                if($message == null) {
                    $message = "The event is not successfully submitted!";
                }
            }
        } else {
            $message = "The event is not successfully submitted!";
        }
    }
} else {
    $message = "You are not logged in as a business account!";
}
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
    <title>Edit Event | Gather</title>
</head>
<body>
<?php if(isset($message)): ?>
    <div class="alert alert-warning">
        <?php echo $message; ?>
    </div>
<?php endif?>
<hr class="">
<div class="container">
    <?php include(__root."views/components/header.php"); ?>
    <?php if($_SESSION['role'] == 'business'):?>
    <?php foreach ($businessdetails as $bd) : ?>
    <div class="row">
        <div class="col-md-3">
                <h1 class=""><?php echo $bd['businessName']; ?></h1>
                <i style="color:green" class="fa fa-check-square"></i> Still In Business
                <div class="ratings">
                    <span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                    </span>
                    <span>15 reviews</span><br/><br/>
                </div>
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

        <!--BUSINESS MAIN-->
        <div class="col-sm-9" contenteditable="false" >
            <div class="panel panel-default">
                <div class="panel-heading"><?php echo $bd['businessName']; ?> Information</div>
                <div class="panel-body"><?php echo $bd['businessDescription']; ?></div>
            </div>
                <?php if(is_a($event, "EventModel")): ?>
                <form action="create.php" method="POST">
                    <input type="text" value='<?php echo $_SESSION['id']; ?>' name="BusinessId" hidden/>
                    <div class="form-group">
                        <label for="EventName">Event Name:</label>
                        <input type="text" name="EventName" class="form-control" value='<?php echo $event->getName();?>' />
                    </div>
                    <div class="form-group">
                        <label for="StartDateTime">Event Start Time</label>
                        <input type="datetime-local" name="StartDateTime" class="form-control" value='<?php echo $event->getStartDateTime("detail"); ?>' />
                    </div>
                    <div class="form-group">
                        <label for="EndDateTime">Event End Time</label>
                        <input type="datetime-local" name="EndDateTime" class="form-control" value='<?php echo $event->getStartDateTime("detail"); ?>' />
                    </div>
                    <div class="form-group">
                        <label for="EventDescription">Description</label>
                        <textarea name="EventDescription"  class="form-control"><?php echo $event->getDescription(); ?></textarea>
                    </div>
                    <input type="submit" value="Submit" name="subbtn" class="btn btn-default"/>
                </form>
                <?php elseif(is_a($event, "Exception")):?>
                <div class="alert alert-warning">
                    <?php echo $event->getMessage(); ?>
                </div>
                <?php endif ?>
        </div>
    </div>
    <?php endforeach; ?>
    <?php endif; ?>
    <?php include(__root."views/components/footer.php"); ?>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src='<?php echo __httpRoot . "assest/"; ?>bootstrap/js/bootstrap.min.js'></script>
</div>
</body>
</html>