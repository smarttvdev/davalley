::<?php
session_start();
// Created by CarcaBot
// 25.09.2013
// CarcaBot@CarcaBot.ro
require_once("../SMS_Module/classes/paginare.class.php");
require_once("../SMS_Module/classes/config.php");
require_once("../SMS_Module/classes/mysqli.php");
require_once("../SMS_Module/classes/sql.class.php");
//var_dump($_GET);
 $pages = new Paginator;
 if (isset($_SESSION['tableSelected']) && $_SESSION['tableSelected'] == false){
     $_SESSION['products'] = array();
     unset($_SESSION['tableSelected']);
     $_SESSION['flag_uniqueINV'] = false;
 }
 if(isset($_REQUEST['cat'])){
    
    $cat = $_GET['cat'];

    $page = $_GET['page'];

    $pages->items_total = countItems($cat); 

    $pages->mid_range = 10;

    $pages->default_ipp = $CONFIG['pageRows'];
     
    $pages->paginate($cat);  

    $categories = categoryList();   

 }else{
    $cat = 0;

    $page = 0;

    $pages->items_total = countItems($cat); 

    $pages->mid_range = 10;

    $pages->default_ipp = $CONFIG['pageRows'];
     
    $pages->paginate($cat);  

    $categories = categoryList();  
 } 
 
 
?>
<link rel="stylesheet" href="/js/css/smoothness/jquery-ui-1.10.4.custom.min.css" />
<script type="text/javascript" src="/js/js/jquery-ui-1.10.4.custom.min.js"></script>

<div id="addtocart-dialog" style="display:none;">
    <textarea name="cookWith" id="cookWith" cols="29" rows="3" placeholder="Notes to the cook"></textarea>
    <div style="padding: 10px 0 0 10px;">
    </div>
</div>

<div id="sideorder-dialog" style="display:none;">
    <p></p>
    <form id="sideOrders">
        <img src="/images/general-loader.gif" />
    </form>
</div>

        <strong>Check out our menu</strong>
	<h2 style="margin-right: 6px; font-size:14px;"><a href="<?php echo $CONFIG['menu_url']; ?>" style="color: #f1f1f1">Download menu (*.png)</a><span style="float:right;"><select name="category" id="categoryChange"><option value="0">Select Category</option><?php foreach($categories as $category) { $selected = ($_GET['cat'] == $category['id']) ? 'selected' : ''; echo '<option value="'.$category['id'].'" '.$selected.'>'.$category['name'].'</option>';} ?> </select></span></h2>
      
       <table class="table4 table3">
            <thead>
                <tr>
                    <th class="cell-product">Items</th>
               </tr>
             </thead>
            
<?php
//$i=($_GET['page'] != '' && $_GET['page'] != 1) ? (($_GET['page'] - 1) * $CONFIG['pageRows']) : 1;
$items =itemsList($page,$cat);
if(empty($items)) {
	echo '<tr><td>No items found in this category</td></tr>';	
} else {
    $i = 0;
    
    $half_of_item_count = ceil(count($items)/2);
    echo '<tbody>';
    for($ii = 0 ; $ii < $half_of_item_count   ; $ii++ ) {
        $index = $ii*2;
	$item = $items[$index];
	//$item_imgae_final = empty($item['image']) || $item['image'] ==null?'cook1.png':$item['imgae'];
	$item['image'] = empty($item['image']) || $item['image'] ==null?'cook1.png':$item['image'];
	echo '<tr>
		<td>
		<span class="menu" title="Click to view the gallery.">
		    <a href="' . $CONFIG['image_location'] . DIRECTORY_SEPARATOR . $item['image'] . '">
			    <img src="/t.php?src=' . 	$CONFIG['image_location'] . DIRECTORY_SEPARATOR . $item['image'] . '&h=80&w=80" alt="' .
				 $item['description'] . '"class="image"/>
		    </a>
		</span><br>'
		. '<span class="AddToCart" title="Click to add to cart."'.'data-id="'.trim($item['itemCode']).'" data-name="'.$item['name'].
		'" data-sideordercat="'.$item['sideOrderCat'].'">'.$item['itemCode'].'.'.$item['name']
		.'</span><br><span class="price">$'.$item['price'].'</span>'
	      .'</td>';
	echo '</tr>';
	$i++;
    }
    echo '</tbody></table><table class="table4 table3 second">
    
                <thead class="second-header"><tr>
                    <th class="cell-product">Items</th>
                    
                </tr></thead>
            <tbody>';
    for($ii = 0; $ii < $half_of_item_count  ; $ii++ ) {
        $index = 2*$ii+1;
	$item = $items[$index];
	$item['image'] = empty($item['image']) || $item['image'] ==null?'cook1.png':$item['image'];
	echo '<tr>
		<td>
		<span class="menu" title="Click to view the gallery.">
		    <a href="' . $CONFIG['image_location'] . DIRECTORY_SEPARATOR . $item['image'] . '">
			    <img src="/t.php?src=' . 	$CONFIG['image_location'] . DIRECTORY_SEPARATOR . $item['image'] . '&h=80&w=80" alt="' .
				 $item['description'] . '"class="image"/>
		    </a>
		</span><br>'
		. '<span class="AddToCart" title="Click to add to cart."'.'data-id="'.trim($item['itemCode']).'" data-name="'.$item['name'].
		'" data-sideordercat="'.$item['sideOrderCat'].'">'.$item['itemCode'].'.'.$item['name']
		.'</span><br><span class="price">$'.$item['price'].'</span>'
	      .'</td>';
	echo '</tr>';
	$i++;
    } 
    echo '</tbody></table>';   
}
?>
           
        </table>
       <div class="pagination">
	   <?php echo $pages->display_pages(); ?>
        </div>
          <script>
		removeInvoice();
 	 </script>

        <div class="divider"></div>
        
        <a href="#">Back</a>
        
    
