<?php
 if(!defined("__root")) {
    require( $_SERVER['DOCUMENT_ROOT']. "\php_gather\configer.php");
}
include __root . 'DbConnect/connect.php';
include __root . 'controllers/Business.php';
include __root . 'controllers/EventController.php';
include __root . 'controllers/CategoryController.php';

$db = Connect::dbConnect();
$eventConnect = new EventConnect($db);
$categoryConnect = new CategoryConnect($db);
$businessview = new BusinessDAO();
$events = null;
$categories = null;

session_start();

$events = $eventConnect->getEvents();
$categories = $categoryConnect->getCategories();

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
    <title> All Event | Gather</title>
</head>
<body>
<hr class="">
<div class="container">
    <?php include(__root."views/components/header.php"); ?>
    <h1>List of Event</h1>
    <div class="row">

        <div class="col-md-3">
            <div class="list-group">
                <?php foreach($categories as $category):?>
                <a href="<?php echo __httpRoot . "Event/Events.php?category=" . $category->getId(); ?>" class="list-group-item"><?php echo $category->getTitle();?></a>
                <?php endforeach;?>
            </div>
        </div>

        <div class="col-md-9">
        <div class="row">

        <?php foreach($events as $event) : ?>
            <div class="col-sm-4 fixheight">
                <div class="thumbnail">
                    <img src="http://placehold.it/320x150" alt="">
                    <div class="caption">
                        <h4 class="pull-right">$24.99</h4>
                        <h4><a href="<?php echo __httpRoot . "Event/Event.php?id=" . $event->getEventId(); ?>"><?php echo $event->getName(); ?></a>
                        </h4>
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
                     <?php //if(isset($le['discount'])): ?>
                        <div class="panel-footer text-center">
                            Apply <?php //echo $le['discount'];?>% off Today!
                        </div>
                    <?php //endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
    </div>
    <div class="clearfix"></div>
    <?php include(__root."views/components/footer.php"); ?>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src='<?php echo __httpRoot . "assest/"; ?>bootstrap/js/bootstrap.min.js'></script>
</div>
</body>
</html>