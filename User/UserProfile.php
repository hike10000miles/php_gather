<?php
if(!defined("__root")) {
    require( $_SERVER['DOCUMENT_ROOT']. "\php_gather\configer.php");
}

include __root . 'DbConnect/connect.php';
include __root . 'controllers/LoginController.php';

$_db = Connect::dbConnect();
$login = new LoginController($_db);
    
session_start();

if(isset($_GET['loggout'])) {
	if($_GET['loggout'] == 'Log Out') {
		$login->logout();
        header("Location: " . __httpRoot);
        exit;
	}
}
echo var_dump($_SESSION);
?>
<form action='UserProfile.php' method="GET">
    <input type="submit" name="loggout" value="Log Out">
</form>