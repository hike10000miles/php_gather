<?php

/*
  THIS IS A TEMPORARY LOGIN I JUST MADE FOR TESTING THIS FEATURE. ONCE BATU COMPLETES LOGIN, THIS FEATURE WILL RUN FROM THE ACTUAL LOGIN NOT THIS TEMPORARY ONE
 */


//STEP 1 - User logs in and goes to the Gathering Page they are a part of

//1.1 - Include header.php in order to bring styling into the feature
require('../View/header.php');

//1.2 - Connect the database and crud functions to the file
require_once('../Model/dbconnect.php');
require_once('../Model/getandset_Announcements.php');
require_once('../Model/gatherAndAnnouncements_crud.php');


//1.3 - Created a made up login so that a user can log in to the event page. The users database and log in features are currently being worked on by Batu, once he completes I'll implement into his feature
session_start();
$_SESSION ['userId'] = '';


//1.4 - Create database instance and connect the userId using the CRUD functions
$databaseIndexConnect = new dbconnect();
$pdoconnection = $databaseIndexConnect->getDb();

if(isset($_POST['submit'])) {
    $_SESSION ['userId'] = $_POST['userId'];

    $setUserId = new getandset_Announcements();
    $setUserId->setUsersId($_SESSION ['userId'] );
}

?>
<!--Step 1.5 - Create temporary made up login form that will later be reconstructed so that the user can log in and see the gather page of which they are part of. This will be redone once Batu completes the login feature and placed using his feature. -->
<!DOCTYPE html>
<html>
<head>
    <title>Gather - Login</title>
</head>
<body>
<header>
    <h2>Welcome to the Gather Platform. Please login below by providing your User Id</h2><br>
</header>
<main id="mainbody">
    <br><br><br>
    <p>Log in and get gathering! Once logged in, you will be directed to your last Gather.<br><br><br>
    </p>

    <form id="userIdForm" action="gather_grouppage.php" method="post" name="userIdForm">
        <div>
            <label for="userId">Enter Your User Id:</label>
            <input type="text" id="userId" name="userId" placeholder="eg ... Nithya" value="<?php if(isset($_POST['userId'])) { echo $_POST['userId'];} else $_POST['userName']=''; ?>"/>
        </div>
        <div>
            <input type="submit"  value="Login" name="submit"/><br><br>
        </div>
    </form>
</main>
<?php include('../View/footer.php'); ?>
</body>
