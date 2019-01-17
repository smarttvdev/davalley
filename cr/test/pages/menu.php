<?php
session_start();
// Created by CarcaBot
// 25.09.2013
// CarcaBot@CarcaBot.ro
require_once("../SMS_Module/classes/paginare.class.php");
require_once("../SMS_Module/classes/config.php");
require_once("../SMS_Module/classes/mysqli.php");
require_once("../SMS_Module/classes/sql.class.php");

dumpSession( "menu" );
 $pages = new Paginator;  
 $pages->items_total = countItems($_GET['cat']);
 $pages->mid_range = 10;
 $pages->default_ipp = $CONFIG['pageRows'];
 $pages->paginate($_GET['cat']);  

$categories = categoryList();
?>
<link rel="stylesheet" href="js/css/smoothness/jquery-ui-1.10.4.custom.min.css" />
<script type="text/javascript" src="js/js/jquery-ui-1.10.4.custom.min.js"></script>

<div id="addtocart-dialog" style="display:none;">
    <textarea name="cookWith" id="cookWith" cols="29" rows="3" placeholder="Notes to the cook"></textarea>
    <div style="padding: 10px 0 0 10px;">
    </div>
</div>

<div id="sideorder-dialog" style="display:none;">
    <p></p>
    <form id="sideOrders">
        <img src="images/general-loader.gif" />
    </form>
</div>

        <strong>Check out our menu</strong>
	<h2 style="margin-right: 6px; font-size:14px;"><a href="<?php echo $CONFIG['menu_url']; ?>" style="color: #f1f1f1">Download menu (*.png)</a><span style="float:right;"><select name="category" id="categoryChange"><option value="0">Select Category</option><?php foreach($categories as $category) { $selected = ($_GET['cat'] == $category['id']) ? 'selected' : ''; echo '<option value="'.$category['id'].'" '.$selected.'>'.$category['name'].'</option>';} ?> </select></span></h2>
       <table class="table3" width="99%">
            <tr>
                <thead>
                    <th>#</th>
                    <th>Price</th>
                    <th>Buy</th>
                    <th>Product</th>
                    
                </thead>
                <tbody>
                    </tbody></tr>
<?php
//$i=($_GET['page'] != '' && $_GET['page'] != 1) ? (($_GET['page'] - 1) * $CONFIG['pageRows']) : 1;
$items =itemsList($_GET['page'],$_GET['cat']);
if(empty($items)) {
	echo '<tr><td>No items found in this category</td></tr>';	
} else {
foreach($items as $item) {
echo '<tr>
	<td>'.$item['itemCode'].'.</td>
	<td>$'.$item['price'].'</td>
	<td><a href="#" data-id="'.trim($item['itemCode']).'" data-name="'.$item['name'].'" data-sideordercat="'.$item['sideOrderCat'].'" class="AddToCart">Add to cart</a></td>';
	if($item['image'] == '') {
        echo '<td>' . $item['name'] . '</td>';
    } else {
        echo '<td><span class="menu"><a href="' . $CONFIG['image_location'] . DIRECTORY_SEPARATOR . $item['image'] . '"><img src="t.php?src=' . $CONFIG['image_location'] . DIRECTORY_SEPARATOR . $item['image'] . '&h=24&w=24" alt="' . $item['description'] . '" width="24" height="24"/></a></span> ' . $item['name'] . '</td>';
    }
    echo '</tr>';
$i++;
}
}
?>
           
        </table>
       <div class="pagination">
	   <?php /*echo $pages->display_pages(); */?>
        </div>
        <div class="divider"></div>
        
        <a href="#">Back</a>
        
    
