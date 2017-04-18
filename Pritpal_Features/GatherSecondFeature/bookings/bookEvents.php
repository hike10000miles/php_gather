<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>TMM - Booking</title>
    <link rel="stylesheet" href="liststyle.css">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>
        $(function(){
            $("#datepicker").datepicker({
                dateFormat: "yy-mm-dd"
            });
        });
    </script>
</head>
<?php

require_once "../header.php";


require_once "connect.php";
require_once "booking.php";
require_once "validation.php";

$db = Connect::dbConnect();
$mybooking = new Booking($db);
$id = $_POST['id'];
$date = $time = $people = $user = $phone = $email = "";
$dateErr = $timeErr = $peopleErr = $userErr = $phoneErr = $emailErr = "";

if(isset($_POST['submit'])){
    $date = $_POST['f_Date'];
    $time = $_POST['f_Time'];
    $people = $_POST['f_People'];
    $user = $_POST['f_Name'];
    $phone = $_POST['f_Phone'];
    $email = $_POST['f_Email'];
    $id = $_POST['id'];

    if(!Validation::isEmpty($user)){
        $userErr = "Enter the User Name";
    }

    if(!Validation::isEmpty($phone)){
        $phoneErr = "Enter the Contact Number";
    }

    if(!Validation::isEmpty($email)){
        $emailErr = "Enter the Email";
    }

    if(!Validation::isEmpty($time)){
        $timeErr = "Enter the time";
    }

    if(!Validation::isEmpty($people)){
        $peopleErr = "Enter the number of people";
    }

    if(!Validation::checkName($user)) {
        $userErr = "Only words and white spaces allowed";
    }

    if(!Validation::phoneValid($phone)){
        $phoneErr = "Not a Valid format";
    }

    if(!Validation::emailValid($email)){
        $emailErr = "Email is not valid";
    }

    if(!Validation::integerValue($people)){
        $peopleErr = "Only integer values allowed";
    }

    if($userErr == "" && $phoneErr == "" && $emailErr == "" && $timeErr == "" && $peopleErr == "") {
        $add = $mybooking->eventBook($date, $time, $people, $user, $phone, $email, $id);
        if ($add == 1) {

/**
 * This example shows settings to use when sending via Google's Gmail servers.
 */

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');

require 'PHPMailer/PHPMailerAutoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer;

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;

//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "pritpalkaur03@gmail.com";

//Password to use for SMTP authentication
$mail->Password = "Sidhu@3392";

//Set who the message is to be sent from
$mail->setFrom('pritpalkaur03@gmail.com', 'Admin');

//Set an alternative reply-to address
$mail->addReplyTo('replyto@example.com', 'First Last');

//Set who the message is to be sent to
$mail->addAddress($email, $user);

//Set the subject line
$mail->Subject = 'Confirmation email for booking';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML("<h2>Thank You for booking the event with us</h2>");

//Replace the plain text body with one created manually
$mail->AltBody = 'Thank you for booking the event with us';

//Attach an image file
$mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: ";
} else {
    echo "Message sent!";
}



           header("Location: index.php");
        }
    }
}


?>


<form action="bookEvents.php" method="post">

    <legend>Online Booking</legend>

    <input type="hidden" value="<?php echo $id; ?>" name="id"/>

    <!--USER NAME-->
    <label for="in_Fname">
        <input type="text" id="formName" name="f_Name" value="<?php echo $user;?>"/>
        <div class="label-text">User Name</div>
        <span id="msg"><?php echo $userErr; ?></span>
    </label><br/>

    <!--PHONE-->
    <label for="in_phone">
        <input type="text" id="formPhone" name="f_Phone" value="<?php echo $phone;?>"/>
        <div class="label-text">Contact Number</div>
        <span id="msg"><?php echo $phoneErr; ?></span>
    </label><br/>

    <!--EMAIL-->
    <label for="in_Email">
        <input type="text" id="formEmail" name="f_Email" value="<?php echo $email;?>"/>
        <div class="label-text">Email</div>
        <span id="msg"><?php echo $emailErr; ?></span>
    </label><br/>

    <!--DATE-->
    <label for="in_Date">
        <input type="text" id="datepicker" name="f_Date" value="<?php echo $date; ?>"/>
        <div class="label-text">Date</div>
    </label><br/>

    <!--TIME-->
    <label for="in_Time">
        <input type="text" id="formTime" name="f_Time" value="<?php echo $time;?>"/>
        <div class="label-text">Time</div>
        <span id="msg"><?php echo $timeErr; ?></span>
    </label><br/>

    <!-- PEOPLE -->
    <label for="in_People">
        <input type="text" id="formPeople" name="f_People" value="<?php echo $people;?>"/>
        <div class="label-text">Number Of People</div>
        <span id="msg"><?php echo $peopleErr; ?></span>
    </label><br/>

    <!-- SUBMIT -->



        <input id='btn1' class='button' type="submit" name="submit" value="submit" />

<!--    <p>-->
<!--        <button id="button" value="Submit" name="submit">Book Now</button>-->
<!--    </p>-->

</form>

<?php

require_once "../footer.php";

?>
