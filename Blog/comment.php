<!DOCTYPE html>
<html>
<head>

</head>
<?php



require_once "../admin/connect.php";
require_once "../admin/blogController.php";


$db = Connect::dbConnect();
$myblog = new Blog($db);

$msg = $userErr= $msgErr = "";


if(isset($_POST['reply'])){
    $id=$_POST['id'];//get the id from form
    $myblog = new Blog($db);
    $reply = $myblog->blogDetails($id);
}

if(isset($_POST['submit'])){

    $user = $_POST['f_User'];
    $msg = $_POST['f_Msg'];
    $blog_id = $_POST['sugID'];




        $addMsg = $myblog->postMsg($user, $msg, $blog_id);
        if ($addMsg == 1) {
            header("Location: blog.php");
        }
    }


?>

<h3>Reply Message</h3>
<form action="comment.php" method="post">


    <input type="hidden" value="<?php if(isset($reply)) { echo $reply->id; } ?>" name="sugID">

    <!--    <label for="in_Msg">
            <input type="text" id="formMsg" name="f_Msg" value=""/>
            <span id="msg"></span>
            <div class="label-text">Message</div>
        </label><br/>-->

    User Name: <input type="text" name="f_User">
    <span id="msg"><?php echo $userErr ?></span>

    Comment: <textarea id="mytextarea" name="f_Msg"></textarea>
    <span id="msg"><?php echo $msgErr; ?></span>

    <p>
        <button id="button" value="Submit" name="submit">Post Message</button>
    </p>
</form>


