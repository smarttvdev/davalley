<?php
// Created by CarcaBot
// 25.09.2013
// CarcaBot@CarcaBot.ro
session_start();

require_once("../SMS_Module/twilio/Services/Twilio.php");
require_once("../SMS_Module/classes/mysqli.php");
require_once("../SMS_Module/classes/sql.class.php");
require_once("../SMS_Module/classes/config.php");


if(isset($_POST['submit'])) {
    $pass =$_POST['password'];
    $username=$_POST['username'];

    $space_position=strpos($username,' ');
    $firstname=substr($username,0,$space_position);
    $lastname=substr($username,$space_position+1);
    global $mysqli;
    $query="SELECT * FROM employee where firstname='$firstname' and lastname='$lastname'";

    $query_result=$mysqli->query($query);
    $num_rows=$query_result->num_rows;
//    echo $num_rows;
    if ($num_rows>0){
        $row=$query_result->fetch_array(MYSQLI_ASSOC);
        if ((int)$row['credentials']<80){
            echo("<script>alert('Your credential is not enough for manager')</script>");
        }
        else{
            $_SESSION['logat'] = true;
            header("Location: index.php");
        }
    }else {
        $_SESSION['logat'] = false;
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin - Login</title>
<link href="styles/layout.css" rel="stylesheet" type="text/css" />
<link href="styles/login.css" rel="stylesheet" type="text/css" />
<!-- Theme Start -->
<link href="themes/blue/styles.css" rel="stylesheet" type="text/css" />
<!-- Theme End -->

</head>
<body>
	<div id="logincontainer">
    	<div id="loginbox">
        	<div id="loginheader">
            	<img src="themes/blue/img/cp_logo_login.png" alt="Control Panel Login" />
            </div>
            <div id="innerlogin">
            	<form action="login.php" name="login" method="post">
                    <p style="text-align:left;margin-bottom:-5px">Enter your name:</p>
                    <input type="text" name="username" class="logininput" />
                    <p style="text-align:left;margin-bottom:-5px">Enter your password:</p>
                	<input type="password" name="password" class="logininput" />
                   
                   	<input type="submit" class="loginbtn" name="submit" value="Submit" /><br />
                </form>
            </div>
        </div>
        <img src="img/login_fade.png" alt="Fade" />
    </div>
</body>
</html>