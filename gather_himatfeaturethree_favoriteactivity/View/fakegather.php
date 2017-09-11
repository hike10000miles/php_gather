<?php
header_remove();
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

$fakeGathering = new get_gatheringcrud();
$gatherresult=$fakeGathering->get_testGathering($pdoconnection);

$fakeGatheringUsers = new get_gatheringcrud();
$gatherresultusers = $fakeGatheringUsers->get_testGatheringusers($pdoconnection);

var_dump($gatherresult); //Note that query is only for gather 2 - needs to be modified, fo rnow just for a placehdler test
echo "=======";
var_dump($gatherresultusers);

$querytogetPollQuestions = $pdoconnection->query("
SELECT id, poll_question_string FROM topfiveactivities_poll
WHERE DATE(NOW()) BETWEEN start_date AND end_date
");

while($row = $querytogetPollQuestions->fetchObject() ){
   // echo"spacespacespacesapcefortestetstststetst";
    //var_dump($row);
    $listofPollQuestions[] = $row;
}

echo '<pre>'|'</pre>';


////Empty Vars for the Poll Creation
//$poll_question_string=$start_date=$end_date='';
//$gather_id=$gatherresult['id'];
//
////EMpty Vars for the poll choice creation
//$poll_id=$poll_choiceoption='';

//EMpty Var for Error message by default
$error_message = '';



if(isset($_POST['submit_poll_choices'])) {

    $poll_choiceoption_1 = $_POST['poll_choiceoption_1'];
    $poll_choiceoption_2 = $_POST['poll_choiceoption_2'];
    $poll_choiceoption_3 = $_POST['poll_choiceoption_3'];
    $poll_choiceoption_4 = $_POST['poll_choiceoption_4'];
    $poll_choiceoption_5 = $_POST['poll_choiceoption_5'];
    $poll_id = $_POST['poll_id'];

    $poll_choices = new poll_crud();
    $poll_choices->create_poll_choices($pdoconnection, $poll_id, $poll_choiceoption_1);
    $poll_choices->create_poll_choices($pdoconnection, $poll_id, $poll_choiceoption_2);
    $poll_choices->create_poll_choices($pdoconnection, $poll_id, $poll_choiceoption_3);
    $poll_choices->create_poll_choices($pdoconnection, $poll_id, $poll_choiceoption_4);
    $poll_choices->create_poll_choices($pdoconnection, $poll_id, $poll_choiceoption_5);


    var_dump($poll_choices);

}




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
    <link href="Styling/pollStyling.css" rel="stylesheet">
</head>
<body>
<div class="container">
<div class="page-header">
    <?php echo $gatherresult['gatheringName'];?>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h2>Gathering Description:</h2><br><br>
        <?php echo $gatherresult['gatheringDescription'];?>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <h3>Gathering's Users</h3>
        <?php
        foreach ($gatherresultusers as $key){
       $query = "SELECT username FROM users WHERE id =".$key['UserId'];
            $pdostmt2 = $pdoconnection->prepare($query);
            $pdostmt2->execute(); // now we execute the statement
            $gatherresultUsernameswithUserId= $pdostmt2->fetch(PDO::FETCH_ASSOC);
            $pdostmt2->closeCursor(); //dont forget this, because it disconnects your connection to db cuz there can only be 1 at a atime
            //var_dump($gatherresultUsernameswithUserId);
            foreach ($gatherresultUsernameswithUserId as $keyusername){
                echo $keyusername;
            }//return ture because its succesfful
            ?><br>
        <?php } ?>
    </div>
</div>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" id="linktocreatepoll">
            <a href="createpoll.php">CREATE A POLL FOR YOUR GROUP</a>
        </div>
    </div>
<!--    <div class="row" id="thepoll1">-->
<!--        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5" id="polltitle">-->
<!--            <h2>--><?php //echo  $gatherresult['gatheringName']?><!-- POLL</h2>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="row" id="thepoll2">-->
<!--        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5" id="pollquestion">-->
<!--            <h2>--><?php //echo  "put the question here";?><!--</h2>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="row" id="thepoll3">-->
<!--        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5" id="pollchoices"><!--we'll need to put a foreach here-->-->
<!--            <h2>--><?php //echo  $poll_choiceoption_1 . $poll_choiceoption_2 . $poll_choiceoption_3 . $poll_choiceoption_4. $poll_choiceoption_5?><!-- POLL</h2>-->
<!--        </div>-->
<!--    </div>-->
    <!--LIST OUT THE POLLS-->
    <?php if(!empty($listofPollQuestions)): ?>
        <ul>
            <?php foreach($listofPollQuestions as $polls): ?>
                <li><a href="pollOptions.php?id=<?php echo $polls->id; ?>"><?php echo $polls->poll_question_string; ?></a></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p class="sorrynopolls">The admin has not posted any active questions at this time.</p>
    <?php endif; ?>
    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="Styling/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
<?php include 'footer.php' ?>
