<?php
 if(!defined("__root")) {
    require( $_SERVER['DOCUMENT_ROOT']. "\php_gather\configer.php");
}
include __root . 'DbConnect/connect.php';
include __root . 'controllers/Business.php';
include __root . 'controllers/CategoryController.php';

$db = Connect::dbConnect();

$categoryController = new CategoryConnect($db);
$categories = null;

session_start();

$_SESSION['role']= 'admin';

if($_SESSION['role'] == 'admin') {
    $categories = $categoryController->getCategoriesWithTotal();
}

?>
<!DOCTYPE>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
    <?php include(__root."views/components/globalhead.php"); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>List of categories | Gather</title>
</head>
<body>
<hr class="">
<div class="container">
    <?php include(__root."views/components/header.php"); ?>
    <?php if(isset($categories) && ($_SESSION['role'] == 'admin')):?>
    <h1>List of all categories</h1>
        <section class="container">
            <div class="row" id="admin-categories-list">
    <?php foreach ($categories as $category) : ?>
                <div class="panel panel-default col-sm-6">
                    <div class="panel-heading"><a href="<?php echo __httpRoot . "Event/Events.php?id=" . $category->getId();?>"><?php echo $category->getTitle(); ?></a></div>
                    <div class="panel-body">
                        <p><?php echo $category->getDescription()?></p>
                        <p>Total events in this category: <?php echo $category->getTotal()?></p>
                    </div>
                </div>
    <?php endforeach; ?>
                </div>
        </section>
    <?php else: ?>
    <div class="alert alert-warning">
        You do not have access to this page.
    </div>
    <?php endif?>
    <?php include(__root."views/components/footer.php"); ?>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src='<?php echo __httpRoot . "assest/"; ?>bootstrap/js/bootstrap.min.js'></script>
</div>
</body>
</html>
