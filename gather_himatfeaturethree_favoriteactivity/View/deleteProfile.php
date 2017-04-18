<?php

require_once ('../Model/dbconnect.php');

$databaseIndexConnect = new dbconnect();
$db = $databaseIndexConnect->getDb();

if(isset($_POST['delete'])){
    $id = $_POST['id'];
    require_once ('../Model/dbconnect.php');
    $query = "DELETE FROM user_profile WHERE id = :id";
    $pdostmt = $db->prepare($query);
    $pdostmt->bindValue(':id',$id, PDO::PARAM_INT);
    $row = $pdostmt->execute();
    //echo "Deleted " . $row;
    header("Location: index.php");
}