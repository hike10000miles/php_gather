

<?php
if(!defined("__root")) {
    require( $_SERVER['DOCUMENT_ROOT']. "\php_gather\configer.php");
}
include __root . 'DbConnect/connect.php';
include __root . 'controllers/ReviewsController.php';


//require_once "../header.php";
//require_once "database.php";

//require_once "ReviewsController.php";

$post_id="";
$db=Connect::dbConnect();

if (isset($_POST['post_id'])) {
    $post_id = $_POST['post_id'];
}
if(isset($_POST['update']))
{
    $status = $_POST['status'];
    echo $status;
    var_dump($status);
    var_dump($post_id);
    $a = new Admin($db);
    $row2 = $a->toeditdata( $status,$post_id);

    header("Location: ReviewAdmin.php");
}








?>

<div>

 <form method='post' action='ReviewEditAdmin.php'>

   <div id="edit">
       <input type="hidden" name="post_id" value="<?php echo $post_id ?>"/>
    <!--   <label for="status">Status:</label>

       <input type="text" id="status" name="status" placeholder="Approved/Not Seen"/><span id="email_text"></span>-->
       <label for="status">Status:</label>
       <select id="status" name="status">
           <option value="Approved">Approved</option>
           <option value="Not Seen">Not Seen</option>
       </select>
    </div>
     <style>#edit{margin-left: 100px; margin-top: 50px;}</style>


           <input class='btn btn-danger' type='submit' name='update' value='update' />
</form>


</div>














    <h3><a href="ReviewAdmin.php">Back to reviews</a></h3>
<?php
//require_once "../footer.php";
?>