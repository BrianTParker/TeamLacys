<?php 
  session_start(); 
  ob_start();
  ?>
  <?php
  /**********************************INCLUDE*********************************** *
  * **************************************************************************** */
 include "db_connect.php";
 include_once( __DIR__ . '/php/cart/CartManager.php' );
 include_once( __DIR__ . '/Account/AccountManager.php' );
 
 $ACCT_MGR = AccountManager::getInstance();
  ?>
  
  
  <?php 
  //session_start(); 
  ob_start();
  
  ini_set('session.bug_compat_warn', 0);
  ini_set('session.bug_compat_42', 0);
  ?>
  
  <!doctype html>
  <!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
  <!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
  <!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
  <!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
  <!-- Consider adding an manifest.appcache: h5bp.com/d/Offline -->
  <!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
  <head>
    <meta charset="utf-8">
  
    <!-- Use the .htaccess and remove these lines to avoid edge case issues.
         More info: h5bp.com/b/378 -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  
    <title>Lacy's</title>
    <meta name="description" content="">
    <meta name="TeamLacys" content="">
  
    <!-- Mobile viewport optimized: j.mp/bplateviewport -->
    <meta name="viewport" content="width=device-width,initial-scale=1">
  
    <!-- Place favicon.ico and apple-touch-icon.png in the root directory: mathiasbynens.be/notes/touch-icons -->
  
    <!-- CSS: implied media=all -->
    <!-- CSS concatenated and minified via ant build script-->
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <link href="css/custom_css.css" rel="stylesheet">
  
    <!-- All JavaScript at the bottom, except for Modernizr / Respond.
         Modernizr enables HTML5 elements & feature detects; Respond is a polyfill for min/max-width CSS3 Media Queries
         For optimal performance, use a custom Modernizr build: www.modernizr.com/download/ -->
    <script src="js/libs/modernizr-2.0.6.min.js"></script>
  </head>
  
  <body>
  
	<div>
		<div class="control-panel">
			<ul>
				<?php
				  if(!AccountManager::getInstance()->isLoggedIn()){
					  echo '<li style="padding-left: 200px"><a href="login.php">Log In</a></li>';
					  echo '<li><a href="newuser.php">Create Account</a></li>';
					  if(isset($emptyCart)){
						echo '<li style="float: right; padding-right: 50px; color : #c0392b"><span class="glyphicon glyphicon-shopping-cart"><a href="cart.php">Cart(0)</a></span></li>';
					  }else{
							echo '<li style="float: right; padding-right: 50px; color : #c0392b"><span class="glyphicon glyphicon-shopping-cart"><a href="cart.php">'. CartManager::getInstance() .'</a></span></li>';
						}
					}else{
						if($ACCT_MGR->getAccessLevel() == 1){
							echo '<li style="padding-left:200px"><a href="admin.php">Admin</a></li>';
						}
					  echo '<li><a href="account.php">Welcome, '.$_SESSION['firstName'].'</a></li>';
					  echo '<li><a href="account.php">My Account</a></li>';
					  echo '<li><a id="logout" href="">Logout</a></li>';
					  if(isset($emptyCart)){
						echo '<li style="float: right; padding-right: 50px; color : #c0392b"><span class="glyphicon glyphicon-shopping-cart"><a href="cart.php">Cart(0)</a></span></li>';
					  }else{
							echo '<li style="float: right; padding-right: 50px; color : #c0392b"><span class="glyphicon glyphicon-shopping-cart"><a href="cart.php">'. CartManager::getInstance() .'</a></span></li>';
						}
					}
				?>
			</ul>
		</div>
	</div>
   <!--<div class="" role="navigation">
    <div class="container-fluid">

      <div class="">
        <form action="search.php" method="POST" class="navbar-form navbar-right" role="search">
          <div class="form-group">
            <input name="searchString" type="text" class="form-control" placeholder="Search">
          </div>
          <button type="submit" class="btn btn-default">Search</button>
        </form>
        <ul class="nav navbar-nav navbar-left">
			

            /* if(!AccountManager::getInstance()->isLoggedIn()){
			  echo '<li><a id="cartmgr" href="cart.php">'. CartManager::getInstance() .'</a></li>';
			  echo '<li><a href="login.php">Log In</a></li>';
			  echo '<li><a href="newuser.php">Create Account</a></li>';
            }else{
				if($ACCT_MGR->getAccessLevel() == 1){
					echo "<li><a href='admin.php'>Admin</a></li>";
				}
			  echo "<li><a href='account.php'>Welcome, ".$_SESSION['firstName']."</a></li>";
			  echo '<li><a href="account.php">My Account</a></li>';
              echo '<li><a id="cartmgr" href="cart.php">'. CartManager::getInstance() .'</a></li>';
              echo '<li><a id="logout" href="">Logout</a></li>';
            } */

        </ul>
      </div><!-- /.navbar-collapse -->
  
  <div class="container-fluid">
		<div class="row">
			<div id="logo">
				<a href='./index.php'>
					<img src="./img/logo02.png"/ style="float:left; padding-left: 180px;">
				</a>
				<form id="search" action="search.php" method="POST" class="navbar-form navbar-right" role="search" style="padding-right:200px;">
					  <div class="form-group">
						<input name="searchString" type="text" class="form-control" placeholder="Search">
					  </div>
					  <button type="submit" class="btn btn-default">Search</button>
				</form>
			</div>
		</div>
  </div>
 
  <nav class="navbar navbar-inverse navbar-center" role="navigation">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>
	  
      <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-nav-lacys">
		  <li><a href="mens.php"><strong>Men</strong></a></li>
          <li><a href="womens.php"><strong>Women</strong></a></li>
          <li><a href="children.php"><strong>Children</strong></a></li>
		  <li><a href="kitchen.php"><strong>Kitchen & Dining</strong></a></li>
		  <li><a href="homeEssential.php"><strong>Home Essentials</strong></a></li>
		  <li><a href="beauty.php"><strong>Beauty</strong></a></li>
		  <li><a href="salesItem.php"><strong>Sales</strong></a></li>
		</ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
  