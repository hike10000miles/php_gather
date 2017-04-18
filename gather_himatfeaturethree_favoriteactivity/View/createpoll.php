<?php
session_start();
if (!isset($_SESSION['userName'])) {
    echo "Sorry, there was a problem with your log in, you will now be redirected to log in again";
    header('Location: index.php');
}
echo $_SESSION['userName'];

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


//Empty Vars for the Poll Creation
$poll_question_string=$start_date=$end_date='';
$gather_id=$gatherresult['id'];

//EMpty Vars for the poll choice creation
$poll_id=$poll_choiceoption='';

//EMpty Var for Error message by default
$error_message = '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Gather</title>
    <!-- Bootstrap -->
    <link href="Styling/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="Styling/Stylesheets/master_stylesheet.css" rel="stylesheet">
</head>
<body>
<div class="container" id="wrapper">
<div class="row">
    <div class='col-lg-6 col-md-6 col-sm-6 col xs-6' id="createPoll">
        <h2 class="headerforcreatepoll" id="headerforcreatepoll"><?php echo $_SESSION['userName']?>, create your poll below in order to let your fellow gatherers vote on things such as top five acivities you can do together!</h2>
        <div class="row" id="error_message"><?php echo $error_message ?></div>
        <form action="createpolloptions.php" method="post" class="pollcreationform">
            <label class="poll_question_string_label">Enter the specific Question You'd Like to Ask Your Gathering: </label><br>
            <input type="text" id="poll_question_string" name="poll_question_string" placeholder='eg...Vote on which of the five activities below you would like to do' value="<?php echo htmlspecialchars($poll_question_string); ?>"><br><br>
            <label class="start_date_label">Enter the Day You'd Like to Start this Poll: </label><br>
            <input type="date" id="start_date" name="start_date" value="<?php echo htmlspecialchars($start_date); ?>"><br><br>
            <label class="end_date_label">Enter the Day You'd Like This Poll to End: </label><br>
            <input type="date" id="end_date" name="end_date" value="<?php echo htmlspecialchars($end_date); ?>"><br><br>
            <div class="row" id="formbutton">
                <input type="hidden" name="gather_id" value="<?php echo $gather_id ?>">
                <input type="submit" class="btn btn-success btn-lg" name="create_poll_submit" id="create_poll_submit"  value="Continue To Create Your Five Choices For This Poll">
            </div>
        </form>
    </div>
</div>
</div><!--coninerdiv-->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="Styling/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>

<?php include 'footer.php'; ?>
