<?php
// 25.09.2013
// CarcaBot@CarcaBot.ro
require_once("../SMS_Module/classes/config.php");
require_once("..//SMS_Module/classes/mysqli.php");
require_once("..//SMS_Module/classes/sql.class.php");

?>      
      <!-- sider component -->
      <div class="slider-component">
        <div class="flexslider">
          <ul class="slides">
<?php
foreach(picList() as $img) {
echo '            <li>
              <img alt="'.$img['name'].'" src="'.$CONFIG['image_location']. DIRECTORY_SEPARATOR . $img['image'].'" />
              <p class="flex-caption">'.$img['name'].'</p>
            </li>
';
}
?>
          </ul>
          <div class="clear"></div>
        </div>
      </div>
      <div class="page-content">
        <div class="icon-text">
          <p><img alt="Our Mission" class="wrap-around" src="images/sample/objective.png"/> Our mission  at <?php echo $CONFIG['company']; ?>, is to provide a nice casual and cosy atmosphere for our customers to enjoy a flavorful and delicious meal with great service.  The idea is to spread the aloha spirit through asian hawaiian food. We offer a variety of Asian Hawaiian dishes for your experience.</p>
  
       </div>
        
        <div class="divider"></div>
        
        <div class="icon-text">
          <p><img alt="Who we are?" class="wrap-around" src="images/sample/info.png"/>We are a small family run restaurant.  You can eat in or call 623-587-4706 for take out orders.  We also cater to family or office parties. <br>
</p>
        </div>
      </div>

      
      
    