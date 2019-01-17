<?php session_start();
require_once("../SMS_Module/classes/config.php");
session_unset($_SESSION['UserLogin']);
session_unset($_SESSION['UserID']);
session_unset($_SESSION['UserName']);
?>
<script>
window.location.reload();
</script>