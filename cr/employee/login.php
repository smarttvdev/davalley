<?php
include('classes.php');
if(isset($_SESSION['username'])){
header("Location:index.php");
}
$obj    =   new Classes();
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<title>Reastaurant</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/Fontawesome.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/responsive.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/layout.css">
 <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet"> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
</head>

<body id="Main">

<div class="container-fluid">
    <div class="Rs-Login" id="Rs-Login">
        <h4>
        	Login To Your Account
        </h4>
    	<form id="login_form">
        	<div class="form-group">
            	<span class="inputIcon"><i class="fa fa-user" aria-hidden="true"></i></span>
                <input type="text" name="username" placeholder="Username" class="user">
            </div>
            <div class="form-group">
            	<span class="inputIcon"><i class="fa fa-lock" aria-hidden="true"></i></span>
                <input type="Password" name="password" placeholder="Password" class="password">
            </div>
            <div class="form-group text-center">            
            	<a href="#" class="clockin" id="clockin">Clock In</a>
                <a href="#" class="clockout">Clock Out</a>
            </div>
            <div class="error">Invalid Username and Password</div>
        </form>        
    </div>
    <div class="rs-loader Rs-Login" id="rs-loader">
        <img src="<?php echo base_url(); ?>images/loadingWait.gif" class="img-responsive">
    </div>

</div>
<script src="<?php echo base_url(); ?>js/bootstrap.js"></script>
<?php
include('ajax_request.php');
?>
</body>
</html>
