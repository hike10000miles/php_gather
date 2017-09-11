<?php
session_start();
if (!isset($_SESSION['userid']) && !isset($_SESSION['profileid'])) {
   echo "Sorry, there was a problem with your sign up, you will now be redirected to sign up again";
    header('Location: signupform.php');
}

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

$thisuserDetails = new usercreate_crud();
$usersDetails = $thisuserDetails->selectUserDetails($pdoconnection, $_SESSION['userid']);
var_dump($usersDetails);


//$profileDetails = new user_profile_crud();
//$usersProfileDetails = $profileDetails->selectUserProfile($pdoconnection, $_SESSION['profileid']);
//var_dump($usersProfileDetails);

$profileDetails = new user_profile_crud();
$row = $profileDetails->selectUserProfile($pdoconnection, $_SESSION['profileid']);
var_dump($row);

$id = $row['id'];


//$delete = new user_profile_crud();
//$delete->delete_userprofile($pdoconnection, $id);

//************$update = new user_profile_crud();
//$updateProfile = $update->update_profile($pdoconnection, $user_id, $user_role, $user_dob, $current_jobtitle, $education_level, $address, $user_description, $pic_likes, $profile_image);
//
//$crud = new user_profile_crud();
//$result = $crud->get_user_profile($pdoconnection);

//
//$user_dob = filter_input(INPUT_POST, 'user_dob');
//$current_jobtitle = filter_input(INPUT_POST, 'current_jobtitle');
//$education_level = filter_input(INPUT_POST, 'education_level');
//$address = filter_input(INPUT_POST, 'address');
//$user_description = filter_input(INPUT_POST, 'user_description');
//$pic_likes = filter_input(INPUT_POST, 'pic_likes');
//$profile_image = filter_input(INPUT_POST, 'profile_image');
//
//echo $user_dob;
//echo $profile_image;



?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title><?php echo $usersDetails['username'] . '' ?>Profile</title>
        <script type="text/javascript" src="../Controller/deletebutton.js"></script>
        <!-- Bootstrap -->
        <link href="Styling/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="Styling/Stylesheets/master_stylesheet.css" rel="stylesheet"><!--chang this after-->
    </head>
    <body>
    <div class="container" id="wrapper">
        <div class="row">
            <div class="page-header">
                <header>
                    <h2 class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="headerheader">Hello <?php echo '' . $usersDetails['username']; ?> , take a look at your profile below. If you don't like it, simply click on edit and make some changes!</h2>
                </header>
            </div><!--page header div-->
        </div><!--div for row of header-->
        <main class="userProfile">
            <div class="row" id="buttonRow">
                <div class="col-lg-12 col md-12  col-sm-12 col-xs-12" id="buttonColumn">
                    <form action="updateProfile.php" class="editform" method="post">
                        <input type="hidden" value="<?php echo $row['id'];?>" name="id">
                        <input type ='submit' class='btn btn-success btn-lg'  id='edit' name="edit" value="Edit Profile">
                    </form>
                        <input type ='submit' class='btn btn-success btn-lg'  id='deleteNotifier' name='deleteNotifier' value="Delete Profile">
                        <div class="hidethedeletion" id="hidethedeletion">
                    <form action="deleteProfile.php" class="deleteform" id="deleteform" method="post">
                        <input type="hidden" value="<?php echo $row['id'];?>" name="id">
                        <p class="deleteconfirmationparagraph">Are you sure you want to delete your profile? If so, you will still be registered as a user, but will need to recreate your profile.</p>
                        <input type ='submit' class='btn btn-success btn-lg'  id='delete' name='delete' value="Yes, delete my profile!">
                    </form>
                            <input type ='submit' class='btn btn-success btn-lg'  id='deletenope' name='deletenope' value="No thanks!">
                    </div>
                </div><!--div for pic column-->
            </div><!--div for button row-->
            <br>
            <div class="row" id="rowOne">
                <div class="col-lg-6 col md-6  col-sm-12 col-xs-12" id="pictureColumn">
                    <?php echo "<img src='".$row['profile_image']."' />"; ?>
                </div><!--div for pic column-->
                <div class="col-lg-6 col md-6  col-sm-12 col-xs-12" id="userdetailsColumn">
                    <p class="userNameProfile">Username: <?php echo '' . $usersDetails['username']; ?></p>
                    <p class="nameProfile">Full Name:<br>  <?php echo '' . $usersDetails['firstname'] . '' . $usersDetails['middlename'] . '' . $usersDetails['lastname']; ?></p>
                    <p class="usersEmail">Email:<br>  <?php echo '' . $usersDetails['email']; ?></p>
                    <p class="usersProfiledob">Date of Birth:<br>  <?php echo '' . $row['user_dob']; ?></p>
                    <p class="usersAddress">Address:<br>  <?php echo '' . $row['address']; ?></p>
                    <p class="usersEducationLevel">Highest Educational Achievement:<br>  <?php echo '' . $row['education_level']; ?></p>
                    <p class="usersJobTitle">Current Job Title:<br>  <?php echo '' . $row['current_jobtitle']; ?></p>
                </div><!--div for userDetailsColumn-->
            </div><!--div for row 1-->

            <br>
            <div class="row" id="rowTwo">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="description">
                    <p class="usersDecription"><?php echo $usersDetails['username']?>'s Story:<br> <?php echo $row['user_description'];/*$usersProfileDetails['user_description']; */?></p>
                </div><!--div for description-->
            </div><!--div for row 2-->
            <br>

        </main>
    </div><!--div for container-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="Styling/bootstrap/js/bootstrap.min.js"></script>
    </body>
    </html>



<?php include 'footer.php' ?>







<!--OLD CODE -->
<?php
//session_start();
////if (!isset($_SESSION['userid']) && !isset($_SESSION['profileid'])) {
////    echo "Sorry, there was a problem with your sign up, you will now be redirected to sign up again";
////    header('Location: signupform.php');
////}
//
//include 'header.php';
//require_once ('../Model/dbconnect.php');
//require_once ('../Model/getandset_profile.php');
//require_once ('../Model/user_profile_crud.php');
//require_once('../Model/get_locationid_crud.php');
//require_once('../Model/get_roleid_crud.php');
//require_once('../Model/usercreate_crud.php');
//require_once('../Model/getandset_usercreate.php');
//
//
//$databaseIndexConnect = new dbconnect();
//$pdoconnection = $databaseIndexConnect->getDb();
//
//$thisuserDetails = new usercreate_crud();
//$usersDetails = $thisuserDetails->selectUserDetails($pdoconnection, $_SESSION['userid']);
//var_dump($usersDetails);
//
//
////$profileDetails = new user_profile_crud();
////$usersProfileDetails = $profileDetails->selectUserProfile($pdoconnection, $_SESSION['profileid']);
////var_dump($usersProfileDetails);
//
//$profileDetails = new user_profile_crud();
//$row = $profileDetails->selectUserProfile($pdoconnection, $_SESSION['profileid']);
//var_dump($row);
//
//$id = $row['id'];
//
////$delete = new user_profile_crud();
////$delete->delete_userprofile($pdoconnection, $id);
//
//$update = new user_profile_crud();
////$updateProfile = $update->update_profile($pdoconnection, $user_id, $user_role, $user_dob, $current_jobtitle, $education_level, $address, $user_description, $pic_likes, $profile_image);
////
////$crud = new user_profile_crud();
////$result = $crud->get_user_profile($pdoconnection);
//
////
////$user_dob = filter_input(INPUT_POST, 'user_dob');
////$current_jobtitle = filter_input(INPUT_POST, 'current_jobtitle');
////$education_level = filter_input(INPUT_POST, 'education_level');
////$address = filter_input(INPUT_POST, 'address');
////$user_description = filter_input(INPUT_POST, 'user_description');
////$pic_likes = filter_input(INPUT_POST, 'pic_likes');
////$profile_image = filter_input(INPUT_POST, 'profile_image');
////
////echo $user_dob;
////echo $profile_image;
//?>
<!--    <!DOCTYPE html>-->
<!--    <html lang="en">-->
<!--<head>-->
<!--    <meta charset="utf-8">-->
<!--    <meta http-equiv="X-UA-Compatible" content="IE=edge">-->
<!--    <meta name="viewport" content="width=device-width, initial-scale=1">-->
<!--    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->-->
<!--    <title>--><?php //echo $usersDetails['username'] . '' ?><!--Profile</title>-->
<!--    <!-- Bootstrap -->-->
<!--    <link href="Styling/bootstrap/css/bootstrap.min.css" rel="stylesheet">-->
<!--    <link href="Styling/Stylesheets/master_stylesheet.css" rel="stylesheet"><!--chang this after-->-->
<!--</head>-->
<!--<body>-->
<!--<div class="container" id="wrapper">-->
<!--    <div class="row">-->
<!--        <div class="page-header">-->
<!--            <header>-->
<!--                <h2 class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="headerheader">Hello --><?php //echo '' . $usersDetails['username']; ?><!-- , take a look at your profile below. If you don't like it, simply click on edit and make some changes!</h2>-->
<!--            </header>-->
<!--        </div><!--page header div-->-->
<!--    </div><!--div for row of header-->-->
<!--<main class="userProfile">-->
<!--    <div class="row" id="buttonRow">-->
<!--        <div class="col-lg-12 col md-12  col-sm-12 col-xs-12" id="buttonColumn">-->
<!--            <form class="editeranddeleteform" method="post">-->
<!--                <input type ='submit' class='btn btn-success btn-lg'  id='Edit' name="Edit" value="Edit Profile">-->
<!--                --><?php
//                if(isset($_POST['Edit'])) {
//                    header("Location:user_profile_pageupdate.php");
//                } else {
//                    //header("Refresh:0");
//                }
//                ?>
<!--                <input type ='submit' class='btn btn-success btn-lg'  id='Delete' name='Delete' value="Delete Profile">-->
<!--                --><?php
//                if(isset($_POST['Delete'])) {
////    echo "<script>
////var deletecheck = prompt('Are you sure you want to delete this profile? If so, you can still log in, but you will have to recreate your profile');
////</script>";
////    $deleteandeditdiv = "Are you sure you want to delete this profile? If you do, you can still login, but wil have to recreate this profile.";
////    echo $deleteandeditdiv;
//
//                    echo "Are you sure you wat to delete this profile? If so, you can still login, but will have to recreate this profile. <br>
//    <form class='deleteconfirmation' method='post'>
//    <input type = 'submit' name='yesdelete' value ='Yes, lets delete my profile'>
//    <input type = 'submit' name = 'nodelete' value ='No, lets keep my profile'>
//    </form>
//    ";
//
//                    if (isset($_POST['yesdelete'])) {
//                        $delete = new user_profile_crud();
//                        $delete->delete_userprofile($pdoconnection, $id);
//                        //header("Location:index.php");
//                    } else if(isset($_POST['nodelete'])) {
//                        header("Refresh:0");
//                    }else{
//
//                    }
//                }
//                ?>
<!--            </form>-->
<!---->
<!--        </div><!--div for pic column-->-->
<!--    </div><!--div for button row-->-->
<!--    <br>-->
<!--    <div class="row" id="rowOne">-->
<!--        <div class="col-lg-6 col md-6  col-sm-12 col-xs-12" id="pictureColumn">-->
<!--            --><?php //echo "<img src='".$row['profile_image']."' />"; ?>
<!--        </div><!--div for pic column-->-->
<!--        <div class="col-lg-6 col md-6  col-sm-12 col-xs-12" id="userdetailsColumn">-->
<!--            <p class="userNameProfile">Username: --><?php //echo '' . $usersDetails['username']; ?><!--</p>-->
<!--            <p class="nameProfile">Name: --><?php //echo '' . $usersDetails['firstname'] . '' . $usersDetails['middlename'] . '' . $usersDetails['lastname']; ?><!--</p>-->
<!--            <p class="usersEmail">Email: --><?php //echo '' . $usersDetails['email']; ?><!--</p>-->
<!--            <p class="usersProfiledob">Date of Birth: --><?php //echo '' . $row['user_dob']; ?><!--</p>-->
<!--            <p class="usersAddress">Address: --><?php //echo '' . $row['address']; ?><!--</p>-->
<!--            <p class="usersEducationLevel">Highest Educational Achievement: --><?php //echo '' . $row['education_level']; ?><!--</p>-->
<!--            <p class="usersJobTitle">Current Job Title: --><?php //echo '' . $row['current_jobtitle']; ?><!--</p>-->
<!--        </div><!--div for userDetailsColumn-->-->
<!--    </div><!--div for row 1-->-->
<!---->
<!--    <br>-->
<!--        <div class="row" id="rowTwo">-->
<!--            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="description">-->
<!--                --><?php //echo $row['user_description'];/*$usersProfileDetails['user_description']; */?>
<!--            </div><!--div for description-->-->
<!--        </div><!--div for row 2-->-->
<!--<br>-->
<!---->
<!--</main>-->
<!--</div><!--div for container-->-->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>-->
<!--<script src="Styling/bootstrap/js/bootstrap.min.js"></script>-->
<!--</body>-->
<!--</html>-->
<!---->
<!---->
<!---->
<?php //include 'footer.php' ?>