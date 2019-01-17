<?php
if(!isset($_SESSION['username'])){
header("location:".base_url()."login.php");
}
?>