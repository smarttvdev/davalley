<?php
// Created by CarcaBot
// 25.09.2013
// CarcaBot@CarcaBot.ro
session_start();

require_once("twilio/Services/Twilio.php");
require_once("classes/mysqli.php");
require_once("classes/sql.class.php");
require_once("classes/config.php");

switch($_POST['action']) {
case 'login':
if($_POST['password'] == $CONFIG['adminpass']) { 
$_SESSION['logat'] = true;
ob_start();
header("Location: admin.php?page=index");
} else { $_SESSION['logat'] = false; }
exit();
break;
default: break;
}
if(!$_SESSION['logat']) {
?>
<form method="POST" name="login">
<table>
<tr><td>Password: </td><td><input type="text" name="password" placeholder="Admin Password"><input type="hidden" name="action" value="login"></td><td><input type="submit" name="submit" value="Log-in"></td></tr>
</table>
</form>
<?php
}
if($_SESSION['logat'] == false) { exit(); }
switch($_GET['pages']) {
case 'index':
<<<INDEX



INDEX;
break;
default:
echo "test";
break;
}


?>

