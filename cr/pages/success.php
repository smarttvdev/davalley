<?php
session_start();
include_once("../SMS_Module/classes/config.php");
$conf_number = "";
if(isset($_SESSION['orderID'])) { $conf_number = "Your confirmation number is #" . $_SESSION['orderID']; }
?>
    <h2>Thank You!</h2>
    <h3>Your transaction was successfully ! <?php echo $conf_number;?></h3>
   <div class="divider"></div>
   <a href="#">Back</a>
