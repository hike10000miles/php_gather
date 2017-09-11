
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

if(!isset($_GET['id'])){
    echo "Sorry, please try again";
} else {
    $idforthePoll = (int)$_GET['id'];
    $query = $pdoconnection->prepare("
    SELECT id, poll_question_string FROM topfiveactivities_poll
WHERE id = :id AND DATE(NOW()) BETWEEN start_date AND end_date
    ");

    $query->execute(['id' => $idforthePoll]);

    $getQuestionString = $query->fetchObject();

    $getallchoicesforthispoll = $pdoconnection->prepare("
    SELECT topfiveactivities_poll.id, topfiveactivities_poll_choices.id AS fiveactivitieschoices_id, topfiveactivities_poll_choices.poll_choiceoption
    FROM topfiveactivities_poll JOIN topfiveactivities_poll_choices ON topfiveactivities_poll.id = topfiveactivities_poll_choices.poll_choiceoption
    WHERE topfiveactivities_poll.id = :poll_id AND DATE(NOW()) BETWEEN topfiveactivities_poll.start_date AND topfiveactivities_poll.end_date
    ");

    $getallchoicesforthispoll->execute([
        'poll_id' => $idforthePoll
    ]);

    print_r($getallchoicesforthispoll);

   // while($row = $)

}
?>

<!--HIDDEN DIV TO SHOW THE POLL WHEN A USER CLICKS ON IT .. example says other page-->
<?php if(!$idforthePoll):?>
    <p>Sorry, the poll requested doesn;t match any polls in this gathering</p>
    <?php else: ?>
<div class="row" id="rowforPoll">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5" id="pollMain">
        <div class="pollQuestions">
           <?php echo $getQuestionString->poll_question_string ?>
        </div>
        <form action="pollResults.php" method="post" class="pollsubmitForm">
            <div class="optionsforthepoll">
                <input type="radio" name="poll_choice" value="1" id="c1">
                <label for="c1">Option One</label>
            </div>
            <div class="optionsforthepoll">
                <input type="radio" name="poll_choice" value="2" id="c2">
                <label for="c2">Option Two</label>
            </div>
            <div class="optionsforthepoll">
                <input type="radio" name="poll_choice" value="3" id="c3">
                <label for="c3">Option Three</label>
            </div>
            <div class="optionsforthepoll">
                <input type="radio" name="poll_choice" value="4" id="c4">
                <label for="c4">Option Four</label>
            </div>
            <div class="optionsforthepoll">
                <input type="radio" name="poll_choice" value="5" id="c4">
                <label for="c5">Option Five</label>
            </div>
            <input type="submit" class="btn-success" value="Submit Your Option">
            <input type="hidden" name="pollOptionSubmission" value="1">
        </form>
    </div>
</div>
    <?php endif ?>
<?php include 'footer.php';