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
require_once "blog.php";

$db = Connect::dbConnect();
$myblog = new Blog($db);


$date = $title = $content = "";
$dateErr = $titleErr = $contentErr = "";

if(isset($_POST['upload'])){

//get the variable values in superglobles $_FILES array

//path of the file in temp directory
$file_temp = $_FILES['upfile']['tmp_name'];
//original path and file name of the uploaded file
$file_name = $_FILES['upfile']['name'];
//size of the uploaded file in bytes
$file_size = $_FILES['upfile']['size'];
//type of the file(if browser provides)
$file_type = $_FILES['upfile']['type'];
//error number
$file_error = $_FILES['upfile']['error'];

echo $file_temp . "<br />";
echo $file_name . "<br />";
echo $file_size . "<br />";
echo $file_type . "<br />";
echo $file_error . "<br />";
if ($file_error > 0)
{
    echo "Problem";
    switch ($file_error)
    {
        case 1:
            echo "File exceeded upload_max_filesize.";
            break;
        case 2:
            echo "File exceeded max_file_size";
            break;
        case 3:
            echo "File only partially uploaded.";
            break;
        case 4:
            echo "No file uploaded.";
            break;
    }
    exit;
}



$max_file_size = 200000;
if($file_size > $max_file_size)
{
    echo "file size too big";

}

//folder to move the uploaded file
$target_path = "uploads/";
$target_path = $target_path .  $_FILES['upfile']['name'];
//
////move the uploaded file from tempe path to taget path
if(move_uploaded_file($_FILES['upfile']['tmp_name'], $target_path)) {
    echo "The file ".  $_FILES['upfile']['name'] . " has been uploaded ";
} else{
    echo "There was an error uploading the file, please try again!";
}
//
//






}
if(isset($_POST['submit'])) {

    $date = $_POST['f_Date'];
    $title = $_POST['f_Title'];
    $content = $_POST['f_Content'];


    $imgData =$_FILES['upfile']['name'];

    $target_path = "uploads/";
    $target_path = $target_path .  $_FILES['upfile']['name'];
//
////move the uploaded file from tempe path to taget path
    if(move_uploaded_file($_FILES['upfile']['tmp_name'], $target_path)) {
        echo "The file ".  $_FILES['upfile']['name'] . " has been uploaded ";
    } else{
        echo "There was an error uploading the file, please try again!";
    }

    $add = $myblog->blogPost($date, $title, $content, $imgData);
    if ($add == 1) {
        header("Location: index.php");
    }
}
?>


<form action="createPost.php" enctype="multipart/form-data" method="post">

    <legend>Create Blog Post</legend>



    <!-- DATE -->
    <label for="in_Date">
        <input type="text" id="formDate" name="f_Date" value="<?php echo date("Y/m/d"); ?>"/>
        <div class="label-text">Date</div>
    </label><br/>

    <!-- TITLE -->
    <label for="in_Title">
        <input type="text" id="formTitle" name="f_Title" value="<?php echo $title;?>"/>
        <div class="label-text">Title</div>
        <span id="msg"><?php echo $titleErr; ?></span>
    </label><br/>

    <!-- CONTENT -->

    <textarea id="mytextarea" name="f_Content"></textarea>
    <span id="msg"><?php echo $contentErr; ?></span>
    <!--
    <label for="in_Content">
        <input type="text" id="formContent" name="f_Content" value="<?php echo $content;?>"/>
        <div class="label-text">Content</div>

    </label><br/>-->

    <!-- IMAGE -->

    <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
    Select file: <input type="file" name="upfile" id="upfile" >
    <!--<input type="submit" value="upload" name="upload" >-->


    <!-- SUBMIT -->



    <input id='btn1' class='button' type="submit" name="submit" value="submit" />

    <!--    <p>-->
    <!--        <button id="button" value="Submit" name="submit">Book Now</button>-->
    <!--    </p>-->

</form>
