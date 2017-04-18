
<?php

session_start();
if (!isset($_SESSION['userName'])) {
    echo "Sorry, there was a problem with your log in, you will now be redirected to log in again";
    header('Location: index.php');
}




require('../View/header.php');
require_once('../Model/get_gatheringcrud.php');
require_once('../Model/dbconnect.php');
require_once('../Model/usercreate_crud.php');
require_once('../Model/poll_crud.php');

$databaseIndexConnect = new dbconnect();
$pdoconnection = $databaseIndexConnect->getDb();

//var_dump(($_SESSION['userName']));

$fakeGathering = new get_gatheringcrud();
$gatherresult=$fakeGathering->get_testGathering($pdoconnection);

$fakeGatheringUsers = new get_gatheringcrud();
$gatherresultusers = $fakeGatheringUsers->get_testGatheringusers($pdoconnection);

var_dump($gatherresult); //Note that query is only for gather 2 - needs to be modified, fo rnow just for a placehdler test
echo "=======";
var_dump($gatherresultusers);


////Empty Vars for the Poll Creation
//$poll_question_string=$start_date=$end_date='';
//$gather_id=$gatherresult['id'];

if(isset($_POST['create_poll_submit'])) {
    $poll_question_string=$_POST['poll_question_string'];
    $start_date=$_POST['start_date'];
    $end_date=$_POST['end_date'];
    $gather_id=$_POST['gather_id'];


    if ($poll_question_string === NULL ) {
        $error_message = "Please enter a question for your poll";
    } else if (strlen($poll_question_string) < 5 || strlen($poll_question_string) > 300) {
        $error_message = 'Your question cannot be less than 5 characters and cannot exceed a length of 300 characters';
    } else if ($start_date == NULL) {
        $error_message = 'Please enter a start date';
    } else if ($end_date == NULL) {
        $error_message = 'Please enter an end date';
    } else {
        $error_message = '';
    }


    if ($error_message != '') {
        //echo $error_message;
    } else {

        $addPollQuestion = new poll_crud();
        $addPollQuestion->create_poll($pdoconnection, $poll_question_string, $start_date, $end_date, $gather_id);
        $newPoll = $pdoconnection->lastInsertId();
        echo "<<<>>>>>";
        var_dump($newPoll);
    }

}

$poll_choiceoption_one=$poll_choiceoption_two=$poll_choiceoption_three=$poll_choiceoption_four=$poll_choiceoption_five='';
$poll_id= $newPoll;


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!--    <meta charset="utf-8">-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Gather</title>
    <!-- Bootstrap -->
    <link href="Styling/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="Styling/Stylesheets/master_stylesheet.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="page-header">
        <h2><?php $_SESSION['userName'] ?>, please fill out the five options that can be used as answers to your question below:</h2>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h2>Your Question:</h2><br><br>
            <?php echo $poll_question_string;?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <h3>Enter Your Answer Options Below:</h3>
        </div>
    </div>
    <div class="row">
        <div class='col-lg-12 col-md-12 col-sm-12 col xs-12' id="createPollQuestions">
            <form action="fakegather.php" method="post" class="pollcreationformforoptions">
                <label class="option_one">Option One: </label><br>
                <input type="text" id="poll_choiceoption" name="poll_choiceoption_1" value="<?php echo htmlspecialchars($poll_choiceoption_one); ?>"><br><br>
                <input type="hidden" name="poll_id" value="<?php echo $poll_id ?>">
                <label class="option_two">Option Two: </label><br>
                <input type="text" id="poll_choiceoption" name="poll_choiceoption_2" value="<?php echo htmlspecialchars($poll_choiceoption_two); ?>"><br><br>
                <input type="hidden" name="poll_id" value="<?php echo $poll_id ?>">
                <label class="option_one">Option Three: </label><br>
                <input type="text" id="poll_choiceoption" name="poll_choiceoption_3" value="<?php echo htmlspecialchars($poll_choiceoption_three); ?>"><br><br>
                <input type="hidden" name="poll_id" value="<?php echo $poll_id ?>">
                <label class="option_one">Option Four: </label><br>
                <input type="text" id="poll_choiceoption" name="poll_choiceoption_4" value="<?php echo htmlspecialchars($poll_choiceoption_four); ?>"><br><br>
                <input type="hidden" name="poll_id" value="<?php echo $poll_id ?>">
                <label class="option_one">Option Five: </label><br>
                <input type="text" id="poll_choiceoption" name="poll_choiceoption_5" value="<?php echo htmlspecialchars($poll_choiceoption_five); ?>"><br><br>
                <input type="hidden" name="poll_id" value="<?php echo $poll_id ?>">
                <div class="row" id="formbutton">
                    <input type="submit" class="btn btn-success btn-lg" name="submit_poll_choices" id="submit_poll_choices"  value="Create Options for Your Poll">
                </div>
            </form>
        </div>
        <!--        <div class="row" id="createPollChoicesForAnswers">-->
        <!--            this form is hidden for now - when you get to creation code for this with radios, implement it-->
        <!--        </div>-->
    </div>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="Styling/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
<?php include 'footer.php' ?>
