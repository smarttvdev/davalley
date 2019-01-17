<?php
include "classes.php";
$obj=new Classes();
$logout = $obj->logout();
session_destroy();
?>
<script type="text/javascript">
window.location.href="<?php echo base_url(); ?>";
</script>