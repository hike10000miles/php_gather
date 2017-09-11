<?php

/*
 <<<<<< OVERVIEW OF STEPS DONE FOR THIS FEATURE. PLEASE READ NITHYA >>>>>>>>

ITS IMPORTANT TO KNO THAT THE FEATURE IS SOLELY THE ANNOUNCEMENTS FEATURE> EVERYTHING ELSE IS TEMORARY AND WILL BE MODIFIED ONCE EVERYONE ELSE FINISHES THEIR FEATURES AS THIS IS A FEATURE THAT WILL
GO ON THE GATHERING FEATURE CHEN IS MAKING AND THE LOGIN WILL BE THE LOGIN FEATURE BATU IS MAKING, NOT THE TEMPORARY LOGIN I MADE FOR THE PURPOSE OF TESTING THI FEATURE

The code I've submitted for feature one is for the announcements feature. This feature comprises of a logged in user being able to post annoncements in a "Gathering"
that they are a part of. I've built as much as I can for this feature thus far, but many components are commented out for now as they will be used when it is combined with
the log in feature that Batu is creating and the gatherig page feature that Chen is currently working on.

Here is what I did in steps

STEP 1 - CREATED THE MODEL
1.1 - Created dbconect to connect to the server. This file is named "dbconnect.pp"
1.2 - Created getters and setters
1.3 - Created the crus operations

STEP 2 - CREATED THE VIEW
1.1 Made an index page with a temporary log in - this will be updated when Batu completes the log in feature and I will attach t that. I made a temporary log in
so that I can work with a userID session for this file
1.2 - Once user submits their userID on the index page, they are redirected to this file 'gather_grouppage.php'. In this page, I made a temporary HTML gathering page just to display the feature itself, which is solely the announcements
section of the code. The rest is just a placeholder that I made up for the purpose of handing in this feature. The actual gatherigs page will be done by Chen, and the announcements feature will be placed on his page
1.3 - Created a form that asks the user to submit their userID, a subject line and their announcement. On submit, all information is sent to db and is then placed inside the "CLICK HERE TO VIEW ANNOUNCEMENTS" container.
1.4 - FOr loop used to present each announcement
1.5 - Made PHP vaidation
1.6 - Styled the feature and used jquery in order to put announcements into a slideable sontainer with scrolldown capability. This is more visually pleasing for theuser, and all the most recent posts
are at the top bbecause the query to get them order them by date
1.7 - Integrated lines of code that will work for notifications - this is all commnted out for now as notificions will be implemented fully when Chen finishes the Gathering feature

STEP 3 - THE CONTROLLER
1.1 - Created JS validation for a better user experience
1.2 - Created a jquery function to make toggle and slidedown bars for the announcement results
1.3 - Created class called notificationClass with functions in it that will be implemented once CHEN's Gathering page feature is finsihed. I will merge it onto that page with a container
1.4 - Created funtions that will submit info without refreshing uing ajax - however, this will be implemented after once this is placed on the actual gathering page as all the functions will be wrking togetehr
for all features
 */
//STEP 2 - User can now post an announcement on the Gather Group Page

//2.1 - Include sessions, header, dbconnection and CRUD functions so that they can be used on this page
include 'header.php';

session_start();
if(isset($_POST['userId'])) {
    $_SESSION['userId'] = $_POST['userId'];
}

require_once ('../Model/dbconnect.php');
require_once ('../Model/getandset_Announcements.php');
require_once ('../Model/gatherAndAnnouncements_crud.php');
require_once ('../Controller/notificationClass.php');

//2.2 - Declare variables for the announcement as empty strings
$userId='';
$subjectLine = '';
$announcement = '';
$gatherid = 1;

//Declare variables for notifications as empty strings

$message = '';
$type = '';


//2.3 - Connect to the database with a new instance
$databaseIndexConnect = new dbconnect();
$pdoconnection = $databaseIndexConnect->getDb();
$notification = new notificationClass();
//2.4 - Declare variables as values from the submit of annuncement
if(isset($_POST['addAnnouncement'])){
    //$id = $_POST[''];
    $userId=$_POST['userID'];
    $subjectLine=$_POST['subjectLine'];
    $announcement = $_POST['announcement'];


    // $notificationInGather = $notification->submitFormNotification();

    $notificationCreator = $notification->notificationCreator();


//Validate
    if ($userId == "") {
        $error_message = 'Please enter your User Id';
    } else if ($userId != $_SESSION['userId']){
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
        //2.5 - Use the Get and Set Announcements Functions to set the Announcements variables
        $setInfo = new getandset_Announcements();
        $setInfo->setUsersId($userId);
        $setInfo->setSubjectline($subjectLine);
        $setInfo->setAnnouncement($announcement);
        $setInfo->setgatherID($gatherid);
        //echo $setInfo->getUsersId() . $setInfo->getSubjectline() . $setInfo->getAnnouncement() . $setInfo->getDate() . $setInfo->getgatherID();

//2.6 - Create an object called $add - this will use the add function from the announcements crud class so we can use it to add announcements
        $add = new gatherAndAnnouncements_crud();
        $row=$add->addAnnouncement($pdoconnection, $userId, $subjectLine, $announcement, date("Y-m-d h:i:s"), $gatherid);

        if ($row ==1){
            header("Refresh:0");
       }

$result = $crud->getAnnouncement($pdoconnection);
if (isset($_POST['delete'])){
    if (!empty ($_POST['id'])) {
        $crud->deleteAnnouncement($pdoconnection, $_POST['id']);
        header("Refresh:0");
    }
}

foreach ($result as $key) {
    echo "<div class='eachPost'>";
    echo "<span class='subjectandUser'>";
    echo "<label class='userLabel'>Posted By:&nbsp;</label>";
    echo ($key['UsersId']);
    echo  "<label class='subjectLabel'>&nbsp;&nbsp;Subject:&nbsp;</label>";
    echo ($key['subject']);
    echo "<span class='dateClass'>";
    echo  "<label class='dateLabel'>&nbsp;&nbsp;&nbsp;Date Posted:&nbsp;</label>";
    echo ($key['Date']) ."</span></span><br>";
    echo  "<label class='announcementLabel'>Announcement: </label><br/>";
    echo ($key['announcement']) ."<br/>";
    echo "<form method='post' action='gather_grouppage.php'>";
    echo "<input type='hidden' name='id' value='".$key['Id']."' />";
    echo "<input type='submit' name='delete' class='deletebutton' value='Delete Announcement' onclick='return chk();'/>";
    echo "</form>";
    echo "</div>";
}



    }


                //$id = filter_input(INPUT_POST, 'userID');
//                $userId = filter_input(INPUT_POST, 'userID');
//                $subjectLine = filter_input(INPUT_POST, 'subjectLine');
//                $announcement = filter_input(INPUT_POST, 'announcement');

//                $crud = new gatherAndAnnouncements_crud();
//                $result = $crud->getAnnouncement($pdoconnection);
//
//                if (isset($_POST['delete'])){
//                    if (!empty ($_POST['id'])) {
//                        $crud->deleteAnnouncement($pdoconnection, $_POST['id']);
//                        header("Refresh:0");
//                    }
//                }
//                foreach ($result as $key) {
//
//                    echo "<div class='eachPost'>";
//                    echo "<span class='subjectandUser'>";
//                    echo "<label class='userLabel'>Posted By:&nbsp</label>";
//                    echo ($key['UsersId']);
//                    echo  " <label class='subjectLabel'>&nbsp&nbspSubject:&nbsp</label>";
//                    echo ($key['subject']);
//                    echo "<span class='dateClass'>";
//                    echo  "<label class='dateLabel'>&nbsp&nbsp&nbspDate Posted:&nbsp</label> ";
//                    echo ($key['Date']) ."</span></span><br>";
//                    echo  "<label class='announcementLabel'>Announcement: </label><br> ";
//                    echo ($key['announcement']) ."<br>";
//                    echo "<form method='post' action='gather_grouppage.php'>";
//                    echo "<input type='hidden' name='id' value='".$key['Id']."' />";
//                    echo "<input type='submit' name='delete' class='deletebutton' value='Delete Announcement' onclick='return chk();'/>";
//                    echo "</form>";
//                    echo "</div>";
//                }

}


?>

<!--2.7 - Create a made up HTML 'Gathering' Page for a group of friends that like camping.
For now, this is just a temporary page, the actual feature is the announcement feature on it. Once Chen finalizes the events and
Gathering features, this announcements feature will be added onto the Gathering page. -->
<!--<!DOCTYPE HTML>-->
<!--<html>-->
<head>
    <title>Gather - The Camping Buddies</title>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="../Controller/gather_announcements.js"></script>
    <script type="text/javascript" src="../Controller/validation.js"></script>
    <link href="Styling/announcement_stylesheet.css" rel="stylesheet">
</head>
<body>
<header>
    <h2>WELCOME TO YOUR GATHERING - GET GATHERING</h2><br><br>
</header>
<!--<div id="container">-->
<!--    put some php here for noification-->
<!--</div>-->
<main>
    <section id="gather">
        <h2>THE CAMPING BUDDIES</h2>
        <br>
        <img src="Styling/images/campingplaceholderimage.jpg" height="400" width="400">
        <h3>Group Members:</h3>
        <p><?php echo $_SESSION['userId'] ?><br>Wayne Gretzky<br>Muhhammad Ali<br>Michael Jordan<br>Tom Brady<br>Lionel Messi<br>Roger Federer<br>Babe Ruth<br></p>
        <br>
        <p>Let's go camping every weekend this comng summer! Apparently all of the Canadian parks are free this summer. <br>
            We should really be taking advantage of this :). Take a look at all the evnts we've now booked below.<br>
            Get your fishing licenses and stock up on firewood, because this summer, it's on!</p><br><br>
        <h4>Events</h4>
        <ul>
            <li>Bon Echo Campgrounds - Weekend 1</li>
            <li>Silver Lake Camprgrounds - Weekend 2</li>
            <li>We Conquer Crown Land - Weekend 3</li>
            <li>Manitoulin Campgrounds - Weekend 4</li>
        </ul>
    </section>
    <br>
    <!-- 2.8 - Create an HTML form for the announcement section-->
    <div class="wholeAnnouncement">
        <h2 class="announcementsHeader">ANNOUNCEMENTS</h2>
        <p class="viewAnnouncementsButton">CLICK TO VIEW ANNOUNCEMENTS</p>
        <p class="viewAnnouncementsButtonhidden">CLICK TO CLOSE</p>
        <section class="AnnouncementResults">
            <div class="results" id="results">
                <?php
                $userId = filter_input(INPUT_POST, 'userID');
                $subjectLine = filter_input(INPUT_POST, 'subjectLine');
                $announcement = filter_input(INPUT_POST, 'announcement');
                $crud = new gatherAndAnnouncements_crud();
//                $result = $crud->getAnnouncement($pdoconnection);
//                if (isset($_POST['delete'])){
//                    if (!empty ($_POST['id'])) {
//                        $crud->deleteAnnouncement($pdoconnection, $_POST['id']);
//                         header("Refresh:0");
//                    }
//                }
//
//                foreach ($result as $key) {
//                    echo "<div class='eachPost'>";
//                    echo "<span class='subjectandUser'>";
//                    echo "<label class='userLabel'>Posted By:&nbsp;</label>";
//                    echo ($key['UsersId']);
//                    echo  "<label class='subjectLabel'>&nbsp;&nbsp;Subject:&nbsp;</label>";
//                    echo ($key['subject']);
//                    echo "<span class='dateClass'>";
//                    echo  "<label class='dateLabel'>&nbsp;&nbsp;&nbsp;Date Posted:&nbsp;</label>";
//                    echo ($key['Date']) ."</span></span><br>";
//                    echo  "<label class='announcementLabel'>Announcement: </label><br/>";
//                    echo ($key['announcement']) ."<br/>";
//                    echo "<form method='post' action='gather_grouppage.php'>";
//                    echo "<input type='hidden' name='id' value='".$key['Id']."' />";
//                    echo "<input type='submit' name='delete' class='deletebutton' value='Delete Announcement' onclick='return chk();'/>";
//                    echo "</form>";
//                    echo "</div>";
//                }
//                ?>
            </div>
        </section>
        <section>
            <br>
            <p><?php echo $_SESSION['userId'] ?>, post your announcement <br>to this Gathering below:</p>
            <?php if (!empty($error_message)) { ?>
                <p class="error"><?php echo htmlspecialchars($error_message); ?></p>
            <?php } ?>
            <form action="" method="post" name="mainForm"> <?php //$notification->submitFormNotification() <--This will go in action once we merge this app in the gatherings page Chen is working on ;?>
                <div id="formdata">
                    <label class="uid">User ID: </label>
                    <input type="text" id="userID" name="userID" value="<?php echo htmlspecialchars($userId); ?>"><br>
                    <label class="sl">Subject: </label>
                    <input type="text" id = "subjectLine" name="subjectLine" value="<?php echo htmlspecialchars($subjectLine); ?>"><br><br>
                    <label class="cyp">Compose Your Announcement: </label><br>
                    <textarea input type="text" class="announcement" id="announcement" name="announcement" rows="2" cols="50" value="<?php echo htmlspecialchars($announcement); ?>"></textarea><br>
                </div>
                <div id="button">
                    <input type="submit" name="addAnnouncement" id="addAnnouncement" class="addAnnouncementButton" value="Post Announcement">
                </div>
            </form>
        </section>
    </div>
</main>
<?php include 'footer.php'; ?>




