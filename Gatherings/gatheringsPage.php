<?php
if(!defined("__root")) {
    require( $_SERVER['DOCUMENT_ROOT']. "\php_gather\configer.php");
}
include __root . 'DbConnect/connect.php';
include __root . 'controllers/gatheringsController.php';
include __root . 'controllers/EventController.php';
include __root . 'controllers/announcementsController.php';



//$businessview = new BusinessDAO();


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

$eventController = new EventConnect($db);
$thisuserDetails = new gatheringsController($db);
$usersDetails = $thisuserDetails->selectUserDetails($db, $_SESSION['user_id']);

$gatheringDetails = new gatheringsController($db);
$row = $gatheringDetails->selectGathering($db, $_SESSION['gatherid']);
//var_dump($row);

//$gatheringDetails = new gatheringsController($db);
//$fetchUsers = $gatheringDetails->get_Gatheringusers($db, $_SESSION['gatherid']);
//var_dump($fetchUsers);

$gatheringDetails = new gatheringsController($db);
$fetchUsers = $gatheringDetails->get_GatheringusersModified($db, $_SESSION['gatherid']);
//var_dump($fetchUsers);

$eventsInGathering = new gatheringsController($db);
$fetchEvents = $eventsInGathering->get_GatheringusersModified($db, $_SESSION['gatherid']);
//var_dump($fetchEvents);


$getEventsforGather = new gatheringsController($db);
$events = $getEventsforGather->getgatheringsEvents($db);

$announcements_userId=$_SESSION['user_id'];
$subjectLine='';
$announcement='';



if(isset($_POST['addAnnouncement'])) {
//$id = $_POST[''];
$announcements_userId = $_POST['userID'];
$subjectLine = $_POST['subjectLine'];
$announcement = $_POST['announcement'];
$gatherid = $_SESSION['gatherid'];

if ($announcements_userId == "") {
    $error_message = 'Please enter your User Id';
} else if ($announcements_userId != $_SESSION['user_id']){
    $error_message = 'Incorrect user id. Please enter the correct User Id';
} else if ($subjectLine == NULL) {
    $error_message = 'Please enter a subject title for your announcement';

} else if ($announcement == NULL) {
    $error_message = 'Please write an announcement';
} else {
    $error_message = '';
}


if ($error_message != ''){
    //echo $error_message;
}
else {

//2.6 - Create an object called $add - this will use the add function from the announcements crud class so we can use it to add announcements
    $announcements_crud = new announcementsController($db);
    $row = $announcements_crud->addAnnouncement($db, $announcements_userId, $subjectLine, $announcement, date("Y-m-d h:i:s"), $gatherid);

    if ($row == 1) {
        header("Refresh:0");
    }


    $result = $announcements_crud->getAnnouncement($db);
    if (isset($_POST['delete'])) {
        if (!empty ($_POST['id'])) {
            $announcements_crud->deleteAnnouncement($db, $_POST['id']);
            //header("Refresh:0");
        }
    }
        foreach ($result as $key) {
            echo "<div class='eachPost'>";
            echo "<span class='subjectandUser'>";
            echo "<label class='userLabel'>Posted By:&nbsp;</label>";
            echo($key['UsersId']);
            echo "<label class='subjectLabel'>&nbsp;&nbsp;Subject:&nbsp;</label>";
            echo($key['subject']);
            echo "<span class='dateClass'>";
            echo "<label class='dateLabel'>&nbsp;&nbsp;&nbsp;Date Posted:&nbsp;</label>";
            echo ($key['Date']) . "</span></span><br>";
            echo "<label class='announcementLabel'>Announcement: </label><br/>";
            echo ($key['announcement']) . "<br/>";
            echo "<form method='post' action='gatheringsPage.php'>";
            echo "<input type='hidden' name='id' value='" . $key['Id'] . "' />";
            if ($_SESSION['user_id'] == $announcements_userId) {
                echo "<input type='submit' name='delete' class='deletebutton' value='Delete Announcement' onclick='return chk();'/>";
            }
            echo "</form>";
            echo "</div>";
        }

    }

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
    <link rel="stylesheet" href='<?php echo __httpRoot . "assest/"; ?>style/announceentstylesheet.css'>
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

<!--                            foreach ($fetchUsers as $key){-->
<!--                            $query = "SELECT username FROM users WHERE id =".$key['UserId'];-->
<!--                            $pdostmt2 = $db->prepare($query);-->
<!--                            $pdostmt2->execute(); // now we execute the statement-->
<!--                            $gatherresultUsernameswithUserId= $pdostmt2->fetch(PDO::FETCH_ASSOC);-->
<!--                            $pdostmt2->closeCursor(); //dont forget this, because it disconnects your connection to db cuz there can only be 1 at a atime-->
<!--                            //var_dump($gatherresultUsernameswithUserId);-->
<!--                            foreach ($gatherresultUsernameswithUserId as $keyusername){-->
<!--                            echo $keyusername;-->
<!--                            }//return ture because its succesfful-->
<!--                            ?><br>-->
<!--                            --><?php //} ?>
<!---->
<!--                                public function getgatheringsEvents($db){-->
<!--                                $query = "SELECT * FROM gatheringevents";-->
<!--                                $pdostmt2 = $db->prepare($query);-->
<!--                                $pdostmt2->execute();-->
<!---->
<!--                                $events = $pdostmt2->fetchAll();-->
<!--                                return $events;-->
<!--                                }-->




                            <?php foreach($events as $event): ?>
                                <div class="col-md-4">
                                    <div class="thumbnail">
                                        <img alt="300x200" src="http://lorempixel.com/300/150/technics">
                                        <div class="caption">
                                            <h4 class="pull-right"></h4>
<!--                                            <h4><a href='--><?php //echo __httpRoot . "Event/Event.php?id=" . $event->getEventId(); ?><!--'>--><?php //echo $event->getName(); ?><!--</a></h4>-->
<!--                                            <p>--><?php //echo $event->getDescription(); ?><!--</p>-->
                                            <?php echo $event->EventName;
                                            echo $event->EventDescription;
                                            echo "<br/> ";
                                            echo '$'. $event->price;
                                            echo "<br/>";?>
                                                <a href="<?php echo __httpRoot . "Event/bookEvents.php?id=".$event->id ?>" class="btn btn-danger" role="button">Book</a><br /><br/>
                                                <a href="<?php echo __httpRoot . "Event/StripePaymentForm.php?id=".$event->id ?>" class="btn btn-info" role="button">Pay</a>
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
    <!--ANNOUNCEMENT -->

    <div class="panel-body">
        <div class="row">

            <div class="panel panel-default col-lg-9 col-md-9 col-sm-9 col-xs-12 pull-right">
                <div class="wholeAnnouncement">
                    <h2 class="announcementsHeader">ANNOUNCEMENTS</h2>
                    <p class="viewAnnouncementsButton">CLICK TO VIEW ANNOUNCEMENTS</p>
                    <p class="viewAnnouncementsButtonhidden">CLICK TO CLOSE</p>
                    <section class="AnnouncementResults">
                        <div class="results" id="results">
                            <?php

                            //$id = filter_input(INPUT_POST, '');
                            $announcements_userId = filter_input(INPUT_POST, 'userID');
                            $subjectLine = filter_input(INPUT_POST, 'subjectLine');
                            $announcement = filter_input(INPUT_POST, 'announcement');
                            //$date = filter_input(INPUT_POST, 'postdate');

                            $crud = new announcementsController($db);
                            $result = $crud->getAnnouncement($db);

                            if (isset($_POST['delete'])){
                                if (!empty ($_POST['id'])) {
                                    $crud->deleteAnnouncement($db, $_POST['id']);
                                    //header("Refresh:0");
                                }
                            }
                            foreach ($result as $key) {

                                echo "<div class='eachPost'>";
                                echo "<span class='subjectandUser'>";
                                echo "<label class='userLabel'>Posted By:&nbsp</label>";
                                echo ($key['UsersId']);
                                echo  " <label class='subjectLabel'>&nbsp&nbspSubject:&nbsp</label>";
                                echo ($key['subject']);
                                echo "<span class='dateClass'>";
                                echo  "<label class='dateLabel'>&nbsp&nbsp&nbspDate Posted:&nbsp</label> ";
                                echo ($key['Date']) ."</span></span><br>";
                                echo  "<label class='announcementLabel'>Announcement: </label><br> ";
                                echo ($key['announcement']) ."<br>";

                                //echo "<a href='?action=delete&id=".$key['Id']. "'>delete</a><br><br>";
                                echo "<form method='post' action=''>";
                                echo "<input type='hidden' name='id' value='".$key['Id']."' />";
                                echo "<input type='submit' name='delete' class='deletebutton' value='Delete Announcement'/>";
                                echo "</form>";
                                echo "</div>";
                            }
                            ?>
                        </div>
                    </section>
                    <section>
                        <br>
                        <p>Post your announcement <br>to this Gathering below:</p>
                        <?php if (!empty($error_message)) { ?>
                            <p class="error"><?php echo htmlspecialchars($error_message); ?></p>
                        <?php } ?>
                        <form action="" method="post" name="mainForm"> <!--if problem with notification remove function from action -->
                            <div id="formdata">
                                <!--<label class="uid">User ID: </label>-->
                                <input type="hidden" id="userID" name="userID" value="<?php echo htmlspecialchars($_SESSION['user_id']); ?>"><br>
                                <label class="sl">Subject: </label>
                                <input type="text" id = "subjectLine" name="subjectLine" value="<?php echo htmlspecialchars($subjectLine); ?>"><br><br>
                                <label class="cyp">Compose Your Announcement: </label><br>
                                <input type="text" class="announcement" id="announcement" name="announcement" value="<?php echo htmlspecialchars($announcement); ?>"><br>
                            </div>
                            <br>
                            <div id="button">
                                <input type="submit" name="addAnnouncement" id="addAnnouncement" class="addAnnouncementButton" value="Post Announcement">

                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <?php include(__root."views/components/footer.php"); ?>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src='<?php echo __httpRoot . "assest/"; ?>scripts/announcementsfunctionality.js'></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src='<?php echo __httpRoot . "assest/"; ?>bootstrap/js/bootstrap.min.js'></script>
</div>
</body>
</html>
