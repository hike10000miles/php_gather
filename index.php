<?php
     if(!defined("__root")) {
        require( $_SERVER['DOCUMENT_ROOT']. "\gather_finial\configer.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Gather</title>
    <!-- Bootstrap -->
    <link href="assest/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="assest/style/master_stylesheet.css" rel="stylesheet">
  </head>
  <body>
	<div class="container" id="wrapper">
		<header>
		<div class="row" id="header">
			<div class="col-xs-3 col-xs-offset-1"><p id="head"><a href="#">CREATE A GATHERING</a></p></div>
			<div class="col-xs-2 col-xs-offset-1"><a href="#"><img src="assest/images/gather_logo.png" id="logo"></a></div>
			<div id="login" class="col-xs-4 col-xs-offset-1">
				<ul>
					<li><a href="#">LOGIN</a></li>
					<li><a href="#">SIGN-UP</a></li>
				</ul>
			</div>
		</div>
		</header>
		<section class="row" id="banner">
			<div class="col-xs-12">
					<img src="assest/images/main_image_notext.png" id="main" class="img-responsive" />
					<div id="main_message">
						<p class="big_text">begin gathering</p><p class="big_text">with purpose</p><p class="subtext">create you own gathering now</p>
						<a href="#"><img src="assest/images/signup.png" /></a>
					</div>
			</div>
		</section>
		<section class="row">
			<h2 class="col-xs-8 col-xs-offset-2 text-center">Definition of a Plan in Modern Times:</h2>
			<p class="col-xs-6 col-xs-offset-3 text-center">A string of noncommittal text messages leading up to a series of potential, though unlikely, events.</p>
			<p class="col-xs-6 col-xs-offset-3 text-center">Leave the flakiness back in the ceral aisle and begin planning with <span>gather</span></p>  
		</section>
		
			<h3 class="text-center">How Does It Work?</h3>
	<section class="row" id="icons">
			<div id="first" class="col-sm-3 col-xs-6 col-xs-offset-3">
				<div class="img_box">
					<img src="assest/images/Icon1.png" class="icon"/>
				</div>
				<h4 class="text-center">START A GATHERING</h3>
				<p>Begin one of the old rituals in human history. Invite your group to commonarea, where all the decision will be made. </p>
			</div>
			<div class="col-sm-3 col-sm-offset-1 col-xs-6 col-xs-offset-3">
				<div class="img_box">
					<img src="assest/images/Icon2.png" class="icon"/>
				</div>
				<h4 class="text-center">PLAN ALL THE DETAILS</h3>
				<p>As a group, beginning planning all the details. Discover new events, vote on the location reserve your spot, split the bill, figure out logistics and plan the carpooling - 
ALL IN  ONE SPOT</p>
			</div>
			<div class="col-sm-3 col-sm-offset-1 col-xs-6 col-xs-offset-3">
				<div class="img_box">
					<img src="assest/images/Icon3.png" class="icon" />
				</div>
				<h4 class="text-center">PAR-TAY</h4>
				<p>Enjoy the new experience and ponder how you ever made plans without <span>gather</span></p>
			</div>
		</section>
		<section class="row">
			<h3 class="text-center">Where Do You Start?</h3>
			<section class="col-md-6 col-xs-12 call-to-action">
				<h2>Are You A Gatherer?</h2>
				<p>Begin taking advantage of all of gather's tools and discover what you have been missing.<p><a href="#">CREATE A GATHERING</a></p>
			</section>
			<section class="col-md-6 col-xs-12 call-to-action">
				<h2>Are You A Business Owner?</h2>
				<p>If you have an event space or want help setting up your offering for other Gatherers to taken advantage of then, then click below.</p><p><a href="#">HOST A GATHERING</a></p>
			</section>
		</section>
	<footer>
		<div class="row">
			<div class="col-xs-4 col-xs-offset-1">
				<p id="copyright">© Copyright Gather, 2017. All rights reserved.</p>
			</div>
			<div class="col-xs-7">
				<nav id="footer-navigation">
					<ul class="menu">
					  <div class="col-sm-4">
					  <li><a href="#">Pre-Planning</a>
						<ul>
						  <li><a href="#">Most Popular</a></li>
						  <li><a href="#">Suggestions</a></li>
						  <li><a href="#">FAQ</a></li>
						</ul>
					  </li>
					 </div>
					 <div class="col-sm-4">
					  <li><a href="#">Planning</a>
						<ul>
						  <li><a href="#">Want-To-Do List</a></li>
						  <li><a href="#">Car-Pooling</a></li>
						  <li><a href="#">Split The Bill</a></li>
						  <li><a href="#">Public Gathering</a></li>
						</ul>
					  </li>
					</div>
					 <div class="col-sm-4">
					  <li><a href="#">Post-Event</a>
						<ul>
						  <li><a href="#">Leave A Review</a></li>
						  <li><a href="#">Our guarantee</a></li>
						</ul>
					  <li><a href="#">Business Tools</a>
						<ul>
						  <li><a href="#">Offer Discounts</a></li>
						</ul>
					  </li>
					  </div>
					</ul>
				</nav>
			</div>
		</div>
	</footer>
		
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assest/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>