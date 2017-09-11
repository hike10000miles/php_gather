<?php

session_start();
if (!isset($_SESSION['userid'])) {
   echo "Sorry, there was a problem with your sign up, you will now be redirected to sign up again";
    header('Location: signupform.php');
}
//if(isset($_GET))
//
//    if(isset($_POST['Username'])) {
//        $_SESSION['Username'] = $_POST['Username'];
//    }

include 'header.php';


require_once ('../Model/dbconnect.php');
require_once ('../Model/getandset_profile.php');
require_once ('../Model/user_profile_crud.php');
require_once('../Model/get_locationid_crud.php');
require_once('../Model/get_roleid_crud.php');
require_once('../Model/usercreate_crud.php');
require_once('../Model/getandset_usercreate.php');

$databaseIndexConnect = new dbconnect();
$pdoconnection = $databaseIndexConnect->getDb();

$locationList = new get_locationid_crud();
$locationResult=$locationList->get_location_id($pdoconnection);

$roleList = new get_roleid_crud();
$roleResult=$roleList->get_user_role($pdoconnection);

//ELECT STATEMENT GOES HERE

$thisuserDetails = new usercreate_crud();
$usersDetails = $thisuserDetails->selectUserDetails($pdoconnection, $_SESSION['userid']);
var_dump($usersDetails);



//2.2 - Declare variables for the announcement as empty strings

$db=$user_id=$user_role=$user_dob=$current_jobtitle=$education_level=$address=$user_description=$pic_likes=$profile_image='';

$addUserProfile = new user_profile_crud();

//2.4 - Declare variables as values from the submit of annuncement
if(isset($_POST['create_profile_submit'])) {
    //$id = $_POST[''];
    $user_id = $_POST['userIdfromSession'];
    $user_role = $usersDetails['roleid'];
    $user_dob = $_POST['user_dob'];
    $current_jobtitle = $_POST['current_jobtitle'];
    $education_level = $_POST['education_level'];
    $address = $_POST['address'];
    $user_description = $_POST['user_description'];
    $pic_likes = 0;
    echo "===============";
    //var_dump($_FILES['profile_image']['tmp_name']);
    //validation
    $fileDimensioncheck = $_FILES["profile_image"]['tmp_name'];
    list($width, $height) = getimagesize($fileDimensioncheck);

    if ($width != "300" && $height != "300") {
        $error_message = "Error : image size must be 300 x 300 pixels.";
    } else if ($user_dob === NULL) {
        $error_message = 'You must enter a Date of Birth';
    } else if ($address == NULL) {
        $error_message = 'Please enter an address';
    }
    else if (strlen($address) < 5 || strlen($address) > 500) {
        $error_message = 'Address must be more than 5 characters and less than 500 characters';
    }else if ($education_level == NULL) {
        $error_message = 'Please enter education level';
    } else if (strlen($education_level) < 5 || strlen($education_level) > 200) {
        $error_message = 'Educaion Level Must be more than 5 characters and less than 200 characters';
    } else if ($current_jobtitle == NULL) {
        $error_message = 'Please enter your current job title';
    } else if (strlen($current_jobtitle) < 5 || strlen($current_jobtitle) > 200) {
        $error_message = 'Job title be more than 5 characters and less than 200 characters';
    } else if ($user_description == NULL) {
        $error_message = 'Please enter your user description';
    } else if (strlen($user_description) < 300 || strlen($user_description) > 1000) {
        $error_message = 'You must use at between 300 and 1000 characters to describe yourself';
    } else {
        $error_message = '';

    }


    if ($error_message != '') {
        //echo $error_message;
    } else {

        move_uploaded_file($_FILES["profile_image"]["tmp_name"], "images/" . $_FILES["profile_image"]["name"]);


        $profile_image = "images/" . $_FILES["profile_image"]["name"];
        //$profile_image = "<img src='".$row['profile_image']."' />";


//    //Image below:


        //echo "File uploaded";


//    $target = "images/" .basename($_FILES['image']['name']);
//    $profile_image = $_FILES['image']['name']; //assigns the image to the var
//
//    $username =getfield('username'); //function to get fields
//    $location = 'user/'.$username.'/';  //this is the part that doesnt work
//
//    if (move_uploaded_file($tmp_name,$location.$name))
//    {
//        echo 'uploaded';
//    }else
//    {
//        echo 'there was an error';
//    }
//   if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
//       $msg = 'Image uploded successfully';
//        }else {
//       $msg = 'There was an error in uploading this image. Please try re-uploading';
//   }

//    public function add_user_profile($db, $user_id, $user_role, $user_dob, $current_jobtitle, $education_level, $address,
//                                     $user_description, $pic_likes, $profile_image)
        $addUserProfile = new user_profile_crud();
        $addUserProfile->add_user_profile($pdoconnection, $user_id, $user_role, $user_dob, $current_jobtitle, $education_level, $address, $user_description, $pic_likes, $profile_image);

        $newInsertedUserProfileId = $pdoconnection->lastInsertId();
        //later on put a session variable
        $_SESSION['profileid'] = $newInsertedUserProfileId;
        header('Location: user_profile_page.php');

    }
}

?>

<head xmlns="http://www.w3.org/1999/html">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $usersDetails['username']."'s"; ?>Profile Creation</title>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!--<script type="text/javascript" src="../Controller/gather_announcements.js"></script>
    <script type="text/javascript" src="../Controller/validation.js"></script>
    <link href="Styling/announcement_stylesheet.css" rel="stylesheet">-->
    <link href="Styling/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="Styling/user_profile_stylesheet.css" rel="stylesheet">
</head>
<body>
<div class="container" id="wrapper">
    <div class="row">
    <div class="page-header">
        <header>
            <h2 class="col-lg-12 col-md-12 col-sm-12 col-xs-12">Hello <?php echo '' . $usersDetails['username']; ?> , create your profile below!</h2>
        </header>
    </div><!--page header div-->
    </div><!--div for row of header-->
<div class="row" id="error_row">
            <?php if (!empty($error_message)) { ?>
                <p class="error"><?php echo htmlspecialchars($error_message); ?></p>
            <?php } ?>
</div><!--error row>-->
            <form action="user_profile_pagecreate.php" method="post" name="mainForm" enctype="multipart/form-data"><!--enctype means for image upload-->
                <div class="row col-lg-12 col md-12  col-sm-12 col-xs-12" id="formrowdisplaySignInResults">
                    <p class="usersSignUpinfo_username">Username: <?php echo '' . $usersDetails['username']; ?></p>
                    <p class="usersSignUpinfo_fullName">Full Name: <?php echo '' . $usersDetails['firstname'] . '' . $usersDetails['middlename'] . '' . $usersDetails['lastname']; ?></p>
                    <p class="usersSignUpinfo_middleName">Email: <?php echo '' . $usersDetails['email']; ?></p>
                </div>
                <div class="row col-lg-12 col md-12  col-sm-12 col-xs-12" id="formrow1">
                    <label class="user_dob_label">DOB: </label>
                    <input type="date" id="user_dob" name="user_dob" value="<?php echo htmlspecialchars($user_dob); ?>">
                </div>
                <div class="row col-lg-12 col md-12  col-sm-12 col-xs-12" id="formrow1.5">
                    <label class="address_label">Address: </label>
                    <input type="text" id="address" name="address" placeholder="ex: 883 Drysdale Drive, Mississauga ON, L5V 1X5" value="<?php echo htmlspecialchars($address); ?>">
                </div><!--formrow1-->
                <div class="row col-lg-12 col md-12  col-sm-12 col-xs-12" id="formrow2">
                    <label class="education_level_label">Highest Education: </label>
                    <input type="text" id = "education_level" name="education_level" placeholder="ex. Postgraduate Diploma in Web Development" value="<?php echo htmlspecialchars($education_level); ?>">
                </div>
                <div class="row col-lg-12 col md-12  col-sm-12 col-xs-12" id="formrow2.5">
                    <label class="current_jobtitle_label">Current Job Title: </label>
                    <input type="text" id = "current_jobtitle" name="current_jobtitle" placeholder="ex. Strategy Assistant at Starcom Mediavest" value="<?php echo htmlspecialchars($current_jobtitle); ?>">
                </div><!--formrow2-->
                <div class="row" id="formrow4">
                    <label class="user_description_label">Please write a brief description about yourself:</label><br>
                    <input type="text" class="user_description" id="user_description" name="user_description" rows="2" cols="50" placeholder="Must be between 300 and 1000 characters" value="<?php echo htmlspecialchars($user_description); ?>">
<!--                    <textarea input type="text" class="user_description" id="user_description" name="user_description" rows="2" cols="50" placeholder="Must be between 300 and 1000 characters" value="--><?php //echo htmlspecialchars($user_description); ?><!--"></textarea>-->
                </div><!--formrow4-->
                <div class="row" id="formrow5">
                    <label class="profile_image_label">Please upload a picture of yourself to be used as a profile picture. Picture must be 300px X 300px.</label><br>
                    <input type="file" enctype="multipart/form-data" name="profile_image" id="profile_image">
                </div><!--formrow5-->
                <div class="row" id="formbutton">
                    <input type="hidden" name="userIdfromSession" value="<?php echo $_SESSION['userid'] ?>">
                    <input type="submit" class="btn btn-success btn-lg" name="create_profile_submit" id="create_profile_submit"  value="Create Profile">
                </div>
            </form>
</div><!--container div-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="Styling/bootstrap/js/bootstrap.min.js"></script>
</body>
<?php include 'footer.php' ?>
