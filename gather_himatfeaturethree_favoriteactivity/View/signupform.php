<?php


require('../View/header.php');


require_once('../Model/dbconnect.php');
require_once('../Model/getandset_profile.php');
require_once('../Model/user_profile_crud.php');
require_once('../Model/get_locationid_crud.php');
require_once('../Model/get_roleid_crud.php');
require_once('../Model/usercreate_crud.php');
require_once('../Model/getandset_usercreate.php');
require_once('../Controller/Validation.php');

$databaseIndexConnect = new dbconnect();
$pdoconnection = $databaseIndexConnect->getDb();

$locationList = new get_locationid_crud();
$locationResult=$locationList->get_location_id($pdoconnection);

$roleList = new get_roleid_crud();
$roleResult=$roleList->get_user_role($pdoconnection);

//if(isset($_POST['submit'])) {
//    $_SESSION ['user_id'] = $_POST['Username'];

//    $setUserId = new getandset_usercreate();
//    $setUserId->setId($_POST ['user_id'] ); //change this to session if u get probs


//1.3 - Created a made up login so that a user can log in to the event page. The users database and log in features are currently being worked on by Batu, once he completes I'll implement into his feature
session_start();


$userid = '';
$username ='';
$email = '';
$password='';
$repassword = '';
$firstname = '';
$middlename = '';
$lastname = '';
$location_id = '';
$role_id = '';

//if (isset($_POST['SIGN UP'])){

if (isset($_POST['submit']) &&
    isset($_POST['Username']) &&
    isset($_POST['Email']) &&
    isset($_POST['Password']) &&
    isset($_POST['RePassword']) &&
    isset($_POST['FirstName']) &&
    isset($_POST['LastName']) &&
    isset($_POST['LocationId'])&&
    isset($_POST['RoleId'])) {
    echo "i am good until here";
    $password = Validation::cleanInput($_POST['Password']);
    $repassword = Validation::cleanInput($_POST['RePassword']);


    if ($password != $repassword) {
        echo "Your passwords don't match, please refill your password fields";

    } else {
        //$password_salt = random_bytes(5);
        $password_salt = 'abc123';
        $password = $password . $password_salt;
        $password_hash = hash('sha256', $password);

        // $userid = $_POST['user_id'];
        $username = $_POST['Username'];
        $email = $_POST['Email'];
        $password = $_POST['Password'];
        $repassword = $_POST['RePassword'];
        $firstname = $_POST['FirstName'];
        $middlename = $_POST['MiddleName'];
        $lastname = $_POST['LastName'];
        $location_id = $_POST['LocationId'];
        $role_id = $_POST['RoleId'];

//    if ($password != $repassword) {
//        echo "Your passwords don't match, please refill your password fields";
//        //put all validaion here
//        $setNewUser = new getandset_usercreate();
//        $setNewUser->setUsername($username);
//        $setNewUser->setEmail($email);
//        $setNewUser->setPasswordSalt($password_salt);
//        $setNewUser->setPasswordHash($password_hash);
//        $setNewUser->setPassword($password);
//        $setNewUser->setRepassword($repassword);
//        $setNewUser->setFirstname($firstname);
//        $setNewUser->setMiddlename($middlename);
//        $setNewUser->setLastname($lastname);
//        $setNewUser->setLocationId($location_id);
//        $setNewUser->setRoleId($role_id);

        $addUser = new usercreate_crud();
//        $row = $addUser->insertUser($pdoconnection, $username, $email, $password, $repassword, /*$password_hash, $password_salt,*/
//            $firstname, $middlename, $lastname, $location_id, $role_id);
       // $result = $addUser->insertUser($pdoconnection, $username, $email, $password_salt, $password_hash, $firstname, $middlename, $lastname, $location_id, $role_id);
        $addUser->insertUser($pdoconnection, $username, $email, $password_salt, $password_hash, $firstname, $middlename, $lastname, $location_id, $role_id);
        $newInsertedUserId = $pdoconnection->lastInsertId();
        //later on put a session variable
        $_SESSION['userid'] = $newInsertedUserId;
        header("Location: user_profile_pagecreate.php");
//        echo "<div class='successfulUsercreationdiv'>Thanks for signing up as a user " . $_POST['Username'] . "! Please click the button below to create your profile!
////        <form action = 'user_profile_pagecreate.php'>
////        <div>
////        <input type=\"submit\" class=\"btn btn-success btn-lg\" name=\"userCreatedButton\" id=\"userCreatedButton\"  value=\"Click Create Your Profile\">
////        </div>
////        </form>
////        </div>";


//        if(isset($_POST['userCreatedButton'])) {
//            header('user_profile_pagecreate.php');
//        }

    }




//if (isset($_POST['SIGN UP']) &&
//isset($_POST['Username']) &&
//isset($_POST['Email']) &&
//isset($_POST['Password']) &&
//isset($_POST['RePassword']) &&
//isset($_POST['FirstName']) &&
//isset($_POST['LastName']) &&
//isset($_POST['LocationId'])&&
//isset($_POST['RoleId']))
//{
//    $password = Validation::cleanInput($_POST['Password']);
//    $repassword = Validation::cleanInput($_POST['RePassword']);
//
//
//
//    if ($password != $repassword) {
//        echo "Your passwords don't match, please refill your password fields";
//
//    } else {
//        $password_salt = random_bytes(5);
//        $password = $password . $password_salt;
//        $password_hash = hash('sha256', $password);
//    }
//
//}

//1.4 - Create database instance and connect the userId using the CRUD functions

}

?>
<!--Step 1.5 - Create temporary made up login form that will later be reconstructed so that the user can log in and see the gather page of which they are part of. This will be redone once Batu completes the login feature and placed using his feature. -->
<!DOCTYPE html>
<html>
<head>
    <title>GATHER SIGN UP</title>
</head>
<body>
<header>
    <h2>Welcome to the Gather Platform. Please sign up below by providing all your details!</h2><br>
</header>
<main id="mainbody">
    <br><br><br>
    <p>Sign up and get gathering! Once signed up, you will be directed to create your profile!<br><br><br>
    </p>

    <form id="userIdForm" action="" method="post" name="userIdForm"> <!--user_profile_pagecreate.php-->
            <div>
                <label for="Username">Username</label>
                <input type="text" name="Username"/>
            </div>
            <div>
                <label for="Email">Email</label>
                <input type="email" name="Email"/>
            </div>
            <div>
                <label for="Password">Password</label>
                <input type="password" name="Password"/>
            </div>
            <div>
                <label for="RePassword">RePassword</label>
                <input type="password" name="RePassword"/>
            </div>
            <div>
                <label for="FirstName">First Name</label>
                <input type="text" name="FirstName"/>
            </div>
            <div>
                <label for="MiddleName">Middle Name</label>
                <input type="text" name="MiddleName"/>
            </div>
            <div>
                <label for="LastName">Last Name</label>
                <input type="text" name="LastName"/>
            </div>
        <div>
            <label for="LocationId">Select Your Locaton:</label>
            <select name="LocationId">
                <?php
                foreach ($locationResult as $key){
                ?><option value="<?php echo $key['Id']; ?>" name="LocationId"><?php echo $key['Id']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div>
            <label for="RoleId">Select whether you're registering as a user or as a business:</label>
            <select name="RoleId">
                <?php
                foreach ($roleResult as $key){
                    ?><option value="<?php echo $key['id']; ?>" name="RoleId"><?php echo $key['id']; ?></option>
                <?php } ?>
            </select>
        </div>
            <div>
                <input type="submit" name="submit" value="SIGN UP"/>
            </div>
        </form>
</main>
<?php include('../View/footer.php'); ?>
</body>
</html>