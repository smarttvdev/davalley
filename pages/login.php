<?php
session_start();
// Created by CarcaBot
// 25.09.2013
// CarcaBot@CarcaBot.ro
// My Orders

require_once("../SMS_Module/classes/config.php");
require_once("../SMS_Module/classes/mysqli.php");
require_once("../SMS_Module/classes/sql.class.php");

?>
        <h2>Login</h2>
    <link rel="stylesheet" href="<?php echo $CONFIG['site'];?>/js/css/smoothness/jquery-ui-1.10.4.custom.min.css" />
 <!--   <script type="text/javascript" src="/js/js/jquery-1.10.2.js"></script> -->
    <script type="text/javascript" src="<?php echo $CONFIG['site'];?>/js/js/jquery-ui-1.10.4.custom.min.js"></script>
	

	<form name="login" action="" method="post">
	<div class="popup-content clearfix">
	<div style="margin-bottom:10px; float:left;">
		<label class="popup-label">Username</label>
		<input name="LoginUser" id="LoginUser" type="text" class="popup-input">
	</div>
	<div style="margin-bottom:10px; float:left;">
		<label class="popup-label">Password</label>
		<input name="LoginPassword" id="LoginPassword" type="password" class="popup-input">
	</div>
		<div class="popup-bottom">
		
		<input type="submit" id="LoginSubmit" class="popup-submit" name="LoginSubmit" value="Login">
	</div>
		
	</div>
	
	</form>

<style>
.clear {
	clear:both;
	line-height:0;
	font-size:0;
}
.clearfix {
	clear:both;
}

/* Clearfix */
.clearfix:before,
.clearfix:after {
    content: " ";
    display: table;
}
.clearfix:after {
    clear: both;
}
.clearfix {
    *zoom: 1;
}

*::-moz-selection {
    background:#000;
    color: #fff00f;
}

div.popup-div {
	margin:50px auto 0;
	padding:5px;
	width:300px;
	background:#fff;
	border:1px solid #777;
	border-radius:5px;
	position:absolute;
	left:25%;
	z-index:50;
}
div.popup-close {
	margin:0 0 20px;
	padding:6px;
	background:#aaa;
	border-radius:5px;
	text-align:center;
	font-size:15px;
	font-weight:bold;
	color:#fff;
}
div.popup-close a{
	margin:0;
	padding:0;
	background:url(cross.png) no-repeat;
	float:right;
	border-radius:5px;
}
div.popup-content {
	margin:0 0 15px 15%;
	padding:30px 0;
	width:304px;
}
div.popup-contentfinal {
	margin:0 0 15px;
	padding:15px 0;
	border-bottom:1px solid #aaa;
}
.popup-label {
	margin:0;
	padding:0;
	float:left;
	height:30px;
	width:100px;
	font-family:arial;
	font-size:15px;
	line-height:30px;
	text-align:left;
	float:left;
}
.popup-labelfinal {
	margin: 0 0 0 20px;
	padding:0;
	float:left;
	height:30px;
	width:100px;
	font-family:arial;
	font-size:15px;
	line-height:30px;
	text-align:left;
	float:left;
}
.popup-labelfinaltxt {
	margin:0;
	padding:0;
	float:left;
	height:30px;
	width:120px;
	font-family:arial;
	font-size:15px;
	line-height:30px;
	text-align:left;
	float:left;
}
.popup-input {
	margin:0;
	padding:0 5px;
	float:right;
	width:180px;
	background:none;
	border:1px solid #aaa;
	height:30px;
	border-radius:5px;
}
.popup-bottom {
	float:right;
	margin:0 12px 0 0;
	padding:0;
}
.popup-cancel {
	float:left;
	width:95px;
	margin:0;
	padding:0;
	font-family:arial;
	font-size:15px;
	line-height:30px;
	text-align:center;
	cursor:pointer;
	border:1px solid #aaa;
	border-radius:5px;
}
.popup-submit {
	float:right;
	width:95px;
	margin:0;
	padding:0;
	font-family:arial;
	font-size:15px;
	line-height:30px;
	text-align:center;
	cursor:pointer;
	border-radius:5px;
	
	background: rgba(0, 0, 0, 0) linear-gradient(to bottom, #f2489b 0%, #ee1981 100%) repeat scroll 0 0;
    border: 1px solid #ee1981;
    color: #fff !important;
}
</style>
