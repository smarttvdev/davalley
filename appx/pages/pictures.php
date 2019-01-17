<?php
// Created by CarcaBot
// 25.09.2013
// CarcaBot@CarcaBot.ro
require_once("../SMS_Module/classes/config.php");
require_once("..//SMS_Module/classes/mysqli.php");
require_once("..//SMS_Module/classes/sql.class.php");


?>
      <h2>Pictures</h2>
      <ul class="pictures">
<?php
foreach(picList() as $img) {
echo         '<li><a href="'.$CONFIG['image_location']. DIRECTORY_SEPARATOR . $img['image'].'"><img src="'.$CONFIG['image_location']. DIRECTORY_SEPARATOR . $img['image'].'" alt="'.$img['name'].'" /></a></li>';
}
?>

      </ul>
      <div class="clear"></div>
      
      
