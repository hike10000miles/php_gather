<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../user/liststyle.css">
    <script src='https://cloud.tinymce.com/stable/tinymce.min.js'></script>
    <script src="http://cloud.tinymce.com/stable/tinymce.min.js?apiKey=eocjl47gfzdlmy660z4hpx0j11n4uxidv4cwf6xeroms0j69"></script>
<!--    <script>-->
<!--        tinymce.init({-->
<!--            selector: '#mytextarea'-->
<!--        });-->
<!--    </script>-->
    <script type="text/javascript">
        tinymce.init({
            selector: '#mytextarea',
            theme: 'modern',
            width: 600,
            height: 300,
            plugins: [
                'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
                'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
                'save table contextmenu directionality emoticons template paste textcolor'
            ],
            content_css: 'css/content.css',
            toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons'
        });
    </script>
</head>
<?php

include "../../header.php";

require_once "../user/connect.php";
require_once "../user/suggest.php";

require_once "../user/validation.php";

$db = Connect::dbConnect();
$mysuggest = new Suggest($db);

$msg = $msgErr = "";

if(isset($_POST['reply'])){
    $id=$_POST['id'];//get the id from form
    $mysuggest = new Suggest($db);
    $reply = $mysuggest->getDetails($id);
}

if(isset($_POST['submit'])){
    $id = $_POST['sugID'];
$msg = $_POST['f_Msg'];

    if(!Validation::isEmpty($msg)){
        $msgErr = "Enter the message";
    }

    if($msgErr == "") {
        $addMsg = $mysuggest->postMsg($id, $msg);
        if ($addMsg == 1) {
            header("Location: index.php");
        }
    }
}

?>

<h3>Reply Message</h3>
<form action="reply.php" method="post">

    <input type="hidden" value="<?php if(isset($reply)) { echo $reply->id; } ?>" name="sugID">

<!--    <label for="in_Msg">
        <input type="text" id="formMsg" name="f_Msg" value=""/>
        <span id="msg"></span>
        <div class="label-text">Message</div>
    </label><br/>-->

    <textarea id="mytextarea" name="f_Msg"></textarea>
    <span id="msg"><?php echo $msgErr; ?></span>

    <p>
        <button id="button" value="Submit" name="submit">Post Message</button>
    </p>
</form>


<?php

include "../../footer.php";
?>