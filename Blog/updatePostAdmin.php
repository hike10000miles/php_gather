<!DOCTYPE html>
<html>
<head>
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

require_once "connect.php";
require_once "blogController.php";

$db = Connect::dbConnect();

$titleErr = $contentErr = "";
if(isset($_POST['update'])){
    $id=$_POST['id'];//get the id from form
    $myblog = new Blog($db);
    $update = $myblog->blogDetails($id);
}

if(isset($_POST['updateSuggest'])) {
// Get form data
    $id = $_POST['sugID'];
    $date = $_POST['f_Date'];
    $title = $_POST['f_Title'];
    $content = $_POST['f_Content'];
    $image =$_FILES['upfile']['name'];

    $target_path = "uploads/";
    $target_path = $target_path .  $_FILES['upfile']['name'];


    $myblog = new Blog($db);
    $result = $myblog->updateDetails($id,$date, $title, $content, $image);
    if ($result == 1) {
        header("Location: blog.php");
    }
}
?>
<form action="updatePostAdmin.php" enctype="multipart/form-data" method="post">

    <legend>Create Blog Post</legend>


    <input type="hidden" value="<?php if(isset($update)) { echo $update->id; } ?>" name="sugID">


    <!-- DATE -->
    <label for="in_Date">
        <input type="text" id="formDate" name="f_Date" value="<?php echo date("Y/m/d"); ?>"/>
        <div class="label-text">Date</div>
    </label><br/>

    <!-- TITLE -->
    <label for="in_Title">
        <input type="text" id="formTitle" name="f_Title" value="<?php if(isset($update)) { echo $update->title; } else { echo $title; } ?>"/>
        <div class="label-text">Title</div>
        <span id="msg"><?php echo $titleErr; ?></span>
    </label><br/>

    <!-- CONTENT -->

    <textarea id="mytextarea" name="f_Content"><?php if(isset($update)) { echo $update->content; } else { echo $content; } ?></textarea>
    <span id="msg"><?php echo $contentErr; ?></span>
    <!--
    <label for="in_Content">
        <input type="text" id="formContent" name="f_Content" value=""/>
        <div class="label-text">Content</div>

    </label><br/>-->

    <!-- IMAGE -->

    <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
    Select file: <input type="file" name="upfile" id="upfile" value="">

    <?php if(isset($update)) { echo "<img src='../uploads/" . $update->image ."' width='250px' height='250px'/>"; } else { echo "uploads/".$image; } ?>
    <!--<input type="submit" value="upload" name="upload" >-->


    <!-- SUBMIT -->



    <input id='btn1' class='button' type="submit" name="updateSuggest" value="submit" />

    <!--    <p>-->
    <!--        <button id="button" value="Submit" name="submit">Book Now</button>-->
    <!--    </p>-->

</form>