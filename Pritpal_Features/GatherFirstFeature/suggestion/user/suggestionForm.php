<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="liststyle.css">
</head>
<?php

include "../../header.php";

require_once "connect.php";
require_once "suggest.php";

require_once "validation.php";


$db = Connect::dbConnect();
$mysuggest = new Suggest($db);

$fname = $lname = $email = $title = $suggest = "";
$fnameErr = $lnameErr = $emailErr = $titleErr = $suggestErr = "";
if(isset($_POST['submit']))
{
    $fname=$_POST['f_Fname'];
    $lname = $_POST['f_Lname'];
    $email = $_POST['f_Email'];
    $date = $_POST['f_Date'];
    $title = $_POST['f_Title'];
    $suggest = $_POST['f_Sug'];

    if(!Validation::isEmpty($fname)){
        $fnameErr = "Enter the First Name";
    }
    if(!Validation::isEmpty($lname)){
        $lnameErr = "Enter the Last Name";
    }
    if(!Validation::isEmpty($email)){
        $emailErr = "Email is required";
    }
    if(!Validation::isEmpty($title)){
        $titleErr = "Enter the title";
    }
    if(!Validation::isEmpty($suggest)){
        $suggestErr = "Suggestion is required";
    }

    if(!Validation::checkName($fname)) {
        $fnameErr = "Only words and white spaces allowed";
    }

    if(!Validation::checkName($lname)){
        $lnameErr = "Only words and white spaces allowed";
    }

    if(!Validation::emailValid($email)){
        $emailErr = "Invalid email";
    }


if($fnameErr == "" && $lnameErr == "" && $emailErr == "" && $titleErr == "" && $suggestErr == "") {
    $add = $mysuggest->addSuggest($fname, $lname, $email, $date, $title, $suggest);
    if ($add == 1) {
        header("Location: index.php");
    }
}
}

?>

    <form action="suggestionForm.php" method="post">

            <legend>Suggestion Form</legend>



            <!--FIRST NAME-->
            <label for="in_Fname">
                <input type="text" id="formFname" name="f_Fname" value="<?php echo $fname;?>"/>
                <div class="label-text">First name</div>
                <span id="msg"><?php echo $fnameErr; ?></span>
            </label><br/>

            <!--LAST NAME-->
            <label for="in_Lname">
                <input type="text" id="formLname" name="f_Lname" value="<?php echo $lname;?>"/>
                <div class="label-text">Last name</div>
                <span id="msg"><?php echo $lnameErr; ?></span>
            </label><br/>

            <!--EMAIL-->
            <label for="in_Email">
                <input type="text" id="formEmail" name="f_Email" value="<?php echo $email;?>"/>
                <div class="label-text">Email</div>
                <span id="msg"><?php echo $emailErr; ?></span>
            </label><br/>

            <!--DATE-->
            <label for="in_Date">
                <input type="text" id="formDate" name="f_Date" value="<?php echo date("Y/m/d"); ?>"/>
                <div class="label-text">Date</div>
            </label><br/>

            <!--TITLE-->
            <label for="in_Title">
                <input type="text" id="formTitle" name="f_Title" value="<?php echo $title;?>"/>
                <div class="label-text">Title</div>
                <span id="msg"><?php echo $titleErr; ?></span>
            </label><br/>

            <!-- SUGGESTION -->
            <label for="in_Sug">
                <input type="text" id="in_Sug" name="f_Sug" value=""/>
                <div class="label-text">Suggestion</div>
                <span id="msg"><?php echo $suggestErr; ?></span>
            </label><br/>

            <!-- SUBMIT -->
            <p>
                <button id="button" value="Submit" name="submit">Create Suggestion</button>
            </p>

        </form>
    <?php
    include "../../footer.php";
?>

