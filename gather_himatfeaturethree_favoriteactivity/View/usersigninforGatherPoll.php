<?php


require('../View/header.php');

//1.2 - Connect the database and crud functions to the file
require_once('../Model/dbconnect.php');
require_once('../Model/usercreate_crud.php');


//1.3 - Created a made up login so that a user can log in to the event page. The users database and log in features are currently being worked on by Batu, once he completes I'll implement into his feature
session_start();
//$_SESSION ['userId'] = '';

$username = '';
$error_message= '';


//1.4 - Create database instance and connect the userId using the CRUD functions
$databaseIndexConnect = new dbconnect();
$pdoconnection = $databaseIndexConnect->getDb();

function fetchUser ($pdoconnection){
    $username = $_POST['userName'];

    $query = "SELECT * FROM users WHERE username = :username";
    $pdostmt2 = $pdoconnection->prepare($query);
    $pdostmt2->bindValue(":username", "$username");
    $pdostmt2->execute();
    $userFetch = $pdostmt2->fetch(PDO::FETCH_ASSOC);
    $pdostmt2->closeCursor();
    return $userFetch;
}

if(isset($_POST['submit'])) {
    fetchUser($pdoconnection);

    if (count(fetchUser($pdoconnection)) > 0) {
        $_SESSION['userName'] = fetchUser($pdoconnection)['username'];
        echo $_SESSION['userName'];
        header("Location:fakegather.php");
    }

       if (count(fetchUser($pdoconnection)) < 1) {
        $error_message = "Sorry, the username was not recognized. Please try again!";
    }
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
    <div class="error_message"><?php echo $error_message ?></div>

    <form id="userIdForm" action="usersigninforGatherPoll.php" method="post" name="userIdForm">
        <div>
            <label for="userId">Enter Your User Name:</label>
<!--            <input type="text" id="userId" name="userId" placeholder="eg ... Nithya" value="--><?php //if(isset($_POST['userId'])) { echo $_POST['userId'];} else $_POST['userName']=''; ?><!--"/>-->
            <input type="text" id="userName" name="userName" placeholder="eg ... Himat"/>
        </div>
        <div>
            <input type="submit"  value="Login" name="submit"/><br><br>
        </div>
    </form>
</main>
<?php include('../View/footer.php'); ?>
</body>