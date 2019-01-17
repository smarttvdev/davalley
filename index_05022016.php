<?php
session_start();
//if(!isset($_GET['site'])) { exit('under construction'); }
// Created by CarcaBot
// 25.09.2013
// CarcaBot@CarcaBot.ro

require_once("SMS_Module/classes/mysqli.php");
require_once("SMS_Module/classes/sql.class.php");
require_once("SMS_Module/classes/config.php");
if($_GET['so'] == 1 && $_GET['From'] != '') {
$From = preg_match_all("/\d+/i", $_GET['From'], $From_output);
$orderID = orderPaid($From_output[0][0], 1);
clearOrder($From_output[0][0]);
header("Location: /success.php?ordersent&orderID=" . $orderID);
exit();
}
if(isset($_REQUEST['LoginSubmit']) && $_REQUEST['LoginSubmit']!=''){
	$query = "SELECT * FROM `admin` WHERE loginID = '".$_REQUEST['LoginUser']."' AND password = '".$_REQUEST['LoginPassword']."'";
	$result = $mysqli->query($query);
	$num_rows = $result->num_rows;
	$fetch = $result->fetch_array(MYSQLI_ASSOC);
	if($num_rows == 1){
		$_SESSION['UserLogin'] = "TRUE";
		$_SESSION['UserID'] = $fetch['id'];
		$_SESSION['UserName'] = $fetch['name'];
	}
	header("Location: ".$CONFIG['site']);
}
//echo "<pre>";print_r($_SESSION);
?>
<!doctype html>
<!-- Conditional comment for mobile ie7 blogs.msdn.com/b/iemobile/ -->
<!--[if IEMobile 7 ]>    <html class="no-js iem7" lang="en"> <![endif]-->
<!--[if (gt IEMobile 7)|!(IEMobile)]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

<head>
  <meta charset="utf-8" />

  <title><?php echo $CONFIG['company'];?></title>
  <meta name="description" content="" />

  <!-- Mobile viewport optimization h5bp.com/ad -->
  <meta name="HandheldFriendly" content="True" />
  <meta name="MobileOptimized" content="320" />
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" />

  <!-- Home screen icon  Mathias Bynens mathiasbynens.be/notes/touch-icons -->
  <!-- For iPhone 4 with high-resolution Retina display: -->
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/h/apple-touch-icon.png" />
  <!-- For first-generation iPad: -->
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/m/apple-touch-icon.png" />
  <!-- For non-Retina iPhone, iPod Touch, and Android 2.1+ devices: -->
  <link rel="apple-touch-icon-precomposed" href="img/l/apple-touch-icon-precomposed.png" />
  <!-- For nokia devices: -->
  <link rel="shortcut icon" href="img/l/apple-touch-icon.png" />
    
  


  <!-- iOS web app, delete if not needed. https://github.com/h5bp/mobile-boilerplate/issues/94 -->
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <meta name="apple-mobile-web-app-status-bar-style" content="black" /> 
  <!-- <script>(function(){var a;if(navigator.platform==="iPad"){a=window.orientation!==90||window.orientation===-90?"img/startup-tablet-landscape.png":"img/startup-tablet-portrait.png"}else{a=window.devicePixelRatio===2?"img/startup-retina.png":"img/startup.png"}document.write('<link rel="apple-touch-startup-image" href="'+a+'"/>')})()</script> -->

  
  <!-- fonts -->
  <!-- <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600' rel='stylesheet' type='text/css'> -->
  <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,400,600' rel='stylesheet' type='text/css' />

  <!--<link href='http://fonts.googleapis.com/css?family=Quattrocento:400,700' rel='stylesheet' type='text/css'>-->
  
  <!--<link rel="stylesheet" href="css/style.less">-->
  <link rel="stylesheet" href="<?php echo $CONFIG['site'];?>/css/reset.css" />
  <link rel="stylesheet" href="<?php echo $CONFIG['site'];?>/css/jquery.qtip.min.css" />
  <link rel="stylesheet" href="<?php echo $CONFIG['site'];?>/css/flexslider.css" />
  <link rel="stylesheet" href="<?php echo $CONFIG['site'];?>/css/photoswipe.css" />
  <link rel="stylesheet" href="<?php echo $CONFIG['site'];?>/css/add2home.css" />
    
  
  <link rel="stylesheet/less" href="css/style.php?color=" />
  <script src="<?php echo $CONFIG['site'];?>/js/less-1.3.0.min.js"></script>
  
  <!-- Main Stylesheet -->
  <!--<link rel="stylesheet" href="css/style.css">-->
  
  <!-- All JavaScript at the bottom, except for Modernizr which enables HTML5 elements & feature detects -->
  <script src="<?php echo $CONFIG['site'];?>/js/libs/modernizr-2.0.6.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<body onLoad="ShowMenuDefault();">
  <!-- Splash screen -->
  <div id="splash"> 
    <img id="splash-bg" src="<?php echo $CONFIG['site'];?>/images/splash/splash.png" alt="splash image" />
    <img id="splash-title" src="<?php echo $CONFIG['site'];?>/images/splash/main.png" alt="splash title" />
  </div> 
  <!-- end splash screen -->
  <div id="container">
    <header>
      <div id="header">
        <div class="navigation">
          <a href="pages/default.php">
            <img alt="Image-alt" src="<?php echo $CONFIG['site'];?>/images/icons/tab-bar/home.png" width="24" />
            <em><br />Home</em>
          </a>
          <a href="pages/menu.php" id="menu">
            <img alt="Image-alt" src="<?php echo $CONFIG['site'];?>/images/icons/tab-bar/man.png" width="24" />
            <em><br />Menu</em>
          </a>
          <a href="pages/myorders.php" id="myorders">
            <img alt="Image-alt" src="<?php echo $CONFIG['site'];?>/images/icons/tab-bar-more/cart_48.png" width="24" />
            <em><br />My Cart (<span id="addedtocart">0</span>)</em>
          </a>

          <a href="pages/pictures.php" id="pictures">
            <img alt="Image-alt" src="<?php echo $CONFIG['site'];?>/images/icons/tab-bar/Picture.png" width="24" />
            <em><br />Pictures</em>
          </a>
          <a href="pages/contact.php" id="contact">
            <img alt="Image-alt" src="<?php echo $CONFIG['site'];?>/images/icons/tab-bar/mail.png" width="24" />
            <em><br />Contact</em>
          </a>
		  <?php if($_SESSION['UserLogin'] == 'TRUE'){?>
		  <a href="pages/logout.php">
            <img alt="Image-alt" src="<?php echo $CONFIG['site'];?>/images/icons/tab-bar/login-icon.png" width="24" />
            <em><br />Logout</em>
          </a>
		  <?php }else{?>
		  <a href="pages/login.php" id="login">
            <img alt="Image-alt" src="<?php echo $CONFIG['site'];?>/images/icons/tab-bar/login-icon.png" width="24" />
            <em><br />Login</em>
          </a>
		  <?php }?>
          <a href="pages/category.php" id="category" style="display:none;"></a>
          <a href="pages/success.php" id="success" style="display:none;"></a>
          <a href="pages/error.php" id="error" style="display:none;"></a>
          <a href="pages/ordersent.php" id="ordersent" style="display:none;"></a>
          <div class="clear"></div>
        </div>
      </div>
    </header>
    <div class="logo-menu">
      <div class="company-info left">
        <h1><?php echo $CONFIG['company'];?></h1>
        <h2><?php echo $CONFIG['company_slogan'];?></h2>
      </div>
      <a id="menu-trigger" class="right"><img src="<?php echo $CONFIG['site'];?>/images/icons/menu.png" width="36" /></a>
      <div class="clear"></div>
    </div>
    <div class="page-loader">
      <img alt="Image-alt" src="<?php echo $CONFIG['site'];?>/images/general-loader.gif" />
      <p>Please wait</p>
    </div>
    
    <div class="page">
          </div>
    <footer>
      <div id="footer">
        Copyright &copy; <?php echo date('Y'); ?> by <?php echo $CONFIG['company']; ?>
      </div>
    </footer>
  </div> <!--! end of #container -->


  <!-- JavaScript at the bottom for fast page loading -->

  <!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if necessary -->
  <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script> -->
  <script src="<?php echo $CONFIG['site'];?>/js/js/jquery-1.10.2.js"></script>
  <!-- <script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.1.min.js"><\/script>')</script> -->
  <script>window.jQuery || document.write('<script src="<?php echo $CONFIG['site'];?>/js/js/jquery-1.10.2.js"><\/script>')</script>
  

  <!-- scripts concatenated and minified via ant build script-->
  <script src="<?php echo $CONFIG['site'];?>/js/jquery.qtip.min.js"></script>
  <script src="<?php echo $CONFIG['site'];?>/js/helper.js"></script>
  <script src="<?php echo $CONFIG['site'];?>/js/jquery.flexslider-min.js"></script>
  <script src="<?php echo $CONFIG['site'];?>/js/iphone-style-checkboxes.js"></script>
  <script src="<?php echo $CONFIG['site'];?>/js/klass.min.js"></script>
  <script src="<?php echo $CONFIG['site'];?>/js/code.photoswipe.jquery-3.0.5.min.js"></script>
  <script src="<?php echo $CONFIG['site'];?>/js/add2home.js"></script>
  <script src="<?php echo $CONFIG['site'];?>/js/script.js"></script>
  
  
  
  <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
  <script type="text/javascript">stLight.options({publisher: "ur-1eb94470-5bf0-cdf2-b5df-a5cae9a58336"}); </script>
  
  <!-- end scripts-->
 <style>
 	.navigation a{
		width:15% !important;
	}
	.navigation a img{
		width:24px !important;
		height:24px !important;
	}
 </style>

</body>
</html>