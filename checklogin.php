<?php
/**
 * @Author: mindfog
 */
if (!defined("__root")) {
    require($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "configer.php");
}

include __root . 'DbConnect/connect.php';
include __root . 'controllers/LoginController.php';
include __root . 'utils/CryptoEngine.php';

require_once("DbConnect/connect.php");

session_start();

$_db = Connect::dbConnect();
$loginModel = new LoginModel();

if (isset($_COOKIE['UserId'])) {
    $_SESSION['UserId'] = $_COOKIE['UserId'];
} else {
    ob_start();
    $jsonResponse = '';
    // TODO(batuhan): Filter values.
    $identifier = $_POST['identifier'];
    $password = $_POST['password'];
    
    $login = new LoginController($_db);
    $loginResult = $login->login($identifier, $password);
    if ($loginResult != false) {
        $model = new LoginModel($loginResult['UserId']);
    }
    ob_end_flush();
}
