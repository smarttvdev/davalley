<?php
include_once 'config.php';
class Classes
{
	function __construct()
	{
		$conn=new Conn();
	}
	function login($username,$password){
		$query 		=	mysql_query("SELECT * FROM `admin` WHERE loginID='$username' and password='$password' and logintype IN ('employee','admin')")or die(mysql_error());
		$num_rows 	=	mysql_num_rows($query);
		if($num_rows==1){
			$get_user_info	=	mysql_fetch_array($query);
			$clock_time = mysql_query("insert into UserTimeSheets(UserID,clockInTime,edate) values('$get_user_info[id]',NOW(),NOW())");			
			$_SESSION['username'] 		= $get_user_info['loginID'];
			$_SESSION['user_id'] 		= $get_user_info['id'];
			$_SESSION['user_email'] 	= $get_user_info['email'];			
			$_SESSION['user_phone'] 	= $get_user_info['phone'];
			$_SESSION['user_logintype'] = $get_user_info['logintype'];
			$_SESSION['user_fullname'] 	= $get_user_info['name'];
		}
		return $num_rows;		
	}
	function logout(){
		$last_user_id = mysql_fetch_array(mysql_query("SELECT * FROM UserTimeSheets WHERE UserID='$_SESSION[user_id]' ORDER BY id DESC LIMIT 0, 1"));
		$query = mysql_query("UPDATE UserTimeSheets SET clockOutTime=NOW() where id=$last_user_id[id]");
	}
	function get_top_selling_item($limit=""){
		$top_sell_item = array();
		$query = mysql_query("SELECT  `item_id` , SUM(  `quantity` ) AS TotalQuantity FROM apx_order_history GROUP BY  `item_id` 
HAVING SUM(  `quantity` )  LIMIT 0 , $limit");
		while ($re = mysql_fetch_array($query)) {
			array_push($top_sell_item, $re['item_id']);
		}
		$item_ids = implode(',', $top_sell_item);
		return mysql_query("SELECT * FROM items WHERE itemID IN($item_ids)");
		

	}
	function get_item_by_id($id){
		return $query = mysql_fetch_array(mysql_query("SELECT * FROM `items` WHERE itemID='$id'"));
	}
	function get_item_by_orderid($id){
		return $query = mysql_fetch_array(mysql_query("SELECT * FROM  items i LEFT JOIN apx_order_history oh ON i.itemID = oh.item_id WHERE oh.order_id='$id'"));
	}

	

	function create_new_order($table_number){
	
	$mysqli = new mysqli("localhost","myorders", "Davalley7!", "myorders");
	$query = "SELECT MAX(OrderID) as last FROM ordersPaid";
    	$result = $mysqli->query($query);
	$row = $result->fetch_array(MYSQLI_ASSOC);
	
		$last_id =  $row['last'] + 1;
		$insert = $mysqli->query("insert into orders(orderID,neworderID,user_id,table_id,order_status,added_date,added_time) 						values('$last_id','$last_id',$_SESSION[user_id]','$table_number','Pending',NOW(),NOW())");
		
		return $last_id;
	}
	
	function get_current_order_detail(){
		return $query = mysql_fetch_array(mysql_query("SELECT * FROM `orders` WHERE orderID='$_SESSION[order_id]'"));
	}
	function add_item_to_order($item_id,$form_data){
		$check_item = mysql_num_rows(mysql_query("SELECT * FROM apx_order_history where item_id='$item_id' and order_id='$_SESSION[order_id]'"));
		if($check_item<=0){
			//print_r($form_data);
			if(sizeof($form_data['item_checkbox'])>=1){
			$sider_order = implode(',', $form_data['item_checkbox']);
			}else{
			$sider_order = "";
			}
			$add_item = mysql_query("insert into apx_order_history(order_id,item_id,quantity,side_order_item_ids,cook_message,added_date) values('$_SESSION[order_id]','$item_id','1','$sider_order','$form_data[cook_message]',NOW())");
			if($form_data['cook_message']!=""){
				$message = ",".$form_data['cook_message'];
			}else{
				$message = "";
			}
			$side_order_name = $this->get_side_order_detail_for_old($sider_order);
			$all_side_orders = $side_order_name.$message;
			$old_trable_order_paid = mysql_query("insert into ordersPaid(orderID,itemID,cookWith,sideOrder,quantity,dateOrdered,cash,orderRead,orderCompleted,orderBy,price,userID,tableNum,GuestNum) values('$_SESSION[order_id]','$item_id','$all_side_orders','$sider_order','1',NOW(),'0','1','','0','','','','')")or die(mysql_error());
			return $this->get_item_by_orderid($item_id);
		}else{
			return "exist";
		}
		
	}
	function get_side_order_detail_for_old($sider_order_id){
		if($sider_order_id!=""){
		$q = mysql_query("SELECT * from items where itemID IN ($sider_order_id)");
		$side_order_names = array();
		while ($res = mysql_fetch_array($q)) {
		$side_order_names[] = $res['itemName'];
		}
		return implode(",", $side_order_names);
		}
	}
	function get_order_item_by_id($item_id){
		return $query = mysql_fetch_array(mysql_query("SELECT * FROM apx_order_history WHERE item_id='$item_id' AND order_id='$_SESSION[order_id]'"));
	}

	function get_order_item_list($o_id = ""){
		if($o_id==""){
		$order_id = $_SESSION['order_id'];	
		}else{
			$order_id = $o_id;
		}
		
		return $query = mysql_query("SELECT * FROM  items i LEFT JOIN apx_order_history oh ON i.itemID = oh.item_id WHERE oh.order_id='$order_id'");
		//return $query = mysql_query("SELECT * FROM `items` WHERE itemID IN(SELECT item_id FROM apx_order_history WHERE order_id='$_SESSION[order_id]')");
	}

function get_order_item_list_checkout($o_id = ""){
		if($o_id==""){
		$order_id = $_SESSION['order_id'];	
		}else{
			$order_id = $o_id;
		}
		
		$query = mysql_query("SELECT * FROM  items i LEFT JOIN apx_order_history oh ON i.itemID = oh.item_id WHERE oh.order_id='$order_id'");
		$res_array = array();
		while ($res = mysql_fetch_array($query)) {
			//array_push($res_array, $res);
			$res_array[]=$res;
		}
		return $res_array;
		//return $query = mysql_query("SELECT * FROM `items` WHERE itemID IN(SELECT item_id FROM apx_order_history WHERE order_id='$_SESSION[order_id]')");
	}

	function get_order_total_amount(){
		$total_array = array();
		$item_qty = mysql_query("SELECT * FROM apx_order_history WHERE order_id='$_SESSION[order_id]'")or die(mysql_error());
		while($res = mysql_fetch_array($item_qty)){
			$item_price = mysql_fetch_array(mysql_query("SELECT itemPrice FROM `items` WHERE itemID = $res[item_id]"));			
			$total_item_price = (($item_price['itemPrice']*$res['quantity'])-$res['item_discount_amount']);
			array_push($total_array, $total_item_price);
		}	
		$total = array_sum($total_array);
		if($total<=0){
			return $total;
		}else{
			$taxs = $this->get_tax_percent();
			$tax = array_sum($taxs);
			return $new_total = round((($tax / 100) * $total)+$total, 2);
		}
		
	}
	function get_order_total_amount_without_tax(){
		$total_array = array();
		$item_qty = mysql_query("SELECT * FROM apx_order_history WHERE order_id='$_SESSION[order_id]'")or die(mysql_error());
		while($res = mysql_fetch_array($item_qty)){
			$item_price = mysql_fetch_array(mysql_query("SELECT itemPrice FROM `items` WHERE itemID = $res[item_id]"));			
			$total_item_price = (($item_price['itemPrice']*$res['quantity'])-$res['item_discount_amount']);
			array_push($total_array, $total_item_price);
		}	
		return $total = array_sum($total_array);
		
		
	}


	function get_order_total_amount_by_id($order_id){
		$total_array = array();
		$item_qty = mysql_query("SELECT * FROM apx_order_history WHERE order_id='$order_id'")or die(mysql_error());
		while($res = mysql_fetch_array($item_qty)){
			$item_price = mysql_fetch_array(mysql_query("SELECT itemPrice FROM `items` WHERE itemID = $res[item_id]"));			
			$total_item_price = (($item_price['itemPrice']*$res['quantity'])-$res['item_discount_amount']);
			array_push($total_array, $total_item_price);
		}		
		$total = array_sum($total_array);
		if($total<=0){
			return $total;
		}else{
			$taxs = $this->get_tax_percent();
			$tax = array_sum($taxs);
			return $new_total = round((($tax / 100) * $total)+$total, 2);
		}

	}
	function get_order_total_amount_by_id_without_tax($order_id){
		$total_array = array();
		$item_qty = mysql_query("SELECT * FROM apx_order_history WHERE order_id='$order_id'")or die(mysql_error());
		while($res = mysql_fetch_array($item_qty)){
			$item_price = mysql_fetch_array(mysql_query("SELECT itemPrice FROM `items` WHERE itemID = $res[item_id]"));			
			$total_item_price = (($item_price['itemPrice']*$res['quantity'])-$res['item_discount_amount']);
			array_push($total_array, $total_item_price);
		}		
		return array_sum($total_array);

	}

	function update_item_qty($item_id,$qty){
		$query = mysql_query("UPDATE apx_order_history SET quantity='$qty' WHERE item_id='$item_id' and order_id='$_SESSION[order_id]'");
	}
	function get_all_item_category(){
		return $query = mysql_query("SELECT * FROM categories");
	}
	function get_category_by_id($id){
		return $query = mysql_fetch_array(mysql_query("SELECT * FROM categories WHERE CategoryID='$id' "));
	}
	function get_items_by_category($cat_id){
		return $query = mysql_query("SELECT * FROM items WHERE categoryID='$cat_id'");
	}
	
	function remove_item_from_order($id){
		$query = mysql_query("DELETE FROM apx_order_history WHERE item_id='$id' and order_id='$_SESSION[order_id]'");
		$query = mysql_query("DELETE FROM ordersPaid WHERE itemID='$id' and orderID='$_SESSION[order_id]'");

	}
	function get_total_order_item(){
		return $query = mysql_num_rows(mysql_query("SELECT id FROM apx_order_history WHERE order_id='$_SESSION[order_id]'"));
	}
	function get_today_orders(){
		return $query = mysql_query("SELECT * FROM orders WHERE `added_date` >= DATE(NOW()) and user_id='$_SESSION[user_id]'");
	}
	function edit_order_from_front($order_id){
		$query = mysql_fetch_array(mysql_query("SELECT * FROM orders WHERE orderID='$order_id'"));
		if($query['order_status']=="Pending"){
			return 1;
		}else{
			return 0;
		}

	}
	function save_order_payment($form_data){
		//echo "insert into apx_payment(order_id,user_id,order_total,discount_percent,discount_amt,tip_percent,tip_amt,balance_amt,tendered_amt,cash_change) values('$_SESSION[order_id]','$_SESSION[user_id]','$form_data[order_total]','$form_data[discount_in_percent]','$form_data[discount_percent_amt]','$form_data[tip_in_percent]','$form_data[calculate_percent_amt]','$form_data[balance_amt]','$form_data[tendered_amt]','$form_data[cash_change]')";
		$this->save_tax_in_order();
		$check_payment = mysql_num_rows(mysql_query("SELECT * FROM apx_payment WHERE order_id='$_SESSION[order_id]'"));
		if($check_payment<=0){
			$query = mysql_query("insert into apx_payment(order_id,user_id,order_total,discount_percent,discount_amt,tip_percent,tip_amt,balance_amt,tendered_amt,cash_change) values('$_SESSION[order_id]','$_SESSION[user_id]','$form_data[order_total]','$form_data[discount_in_percent]','$form_data[discount_percent_amt]','$form_data[tip_in_percent]','$form_data[calculate_percent_amt]','$form_data[balance_amt]','$form_data[tendered_amt]','$form_data[cash_change]')");
			
			if($query){
				$update_order = mysql_query("UPDATE orders SET order_status='complete' WHERE orderID='$_SESSION[order_id]'");
				echo "1";
			}else{
				echo "0";
			}
		}else{
			$query = mysql_query("
				update apx_payment set user_id='$_SESSION[user_id]',order_total='$form_data[order_total]',discount_percent='$form_data[discount_in_percent]',discount_amt='$form_data[discount_percent_amt]',tip_percent='$form_data[tip_in_percent]',tip_amt='$form_data[calculate_percent_amt]',balance_amt='$form_data[balance_amt]',tendered_amt='$form_data[tendered_amt]',cash_change='$form_data[cash_change]' where order_id='$_SESSION[order_id]'");
			if($query){
				$update_order = mysql_query("UPDATE orders SET order_status='complete' WHERE orderID='$_SESSION[order_id]'");
				echo "1";
			}else{
				echo "0";
			}

		}
		/**/
	}

	function save_order_payment_with_due($form_data){
		$check_payment = mysql_num_rows(mysql_query("SELECT * FROM apx_payment WHERE order_id='$_SESSION[order_id]'"));
		$this->save_tax_in_order();
		if($check_payment<=0){
		$query = mysql_query("insert into apx_payment(order_id,user_id,order_total,discount_percent,discount_amt,tip_percent,tip_amt,balance_amt,tendered_amt,cash_change) values('$_SESSION[order_id]','$_SESSION[user_id]','$form_data[order_total]','$form_data[discount_in_percent]','$form_data[discount_percent_amt]','$form_data[tip_in_percent]','$form_data[calculate_percent_amt]','$form_data[balance_amt]','$form_data[tendered_amt]','$form_data[cash_change]')");
		}else{
			$query = mysql_query("UPDATE apx_payment SET order_total='$form_data[order_total]', discount_percent='$form_data[discount_in_percent]', discount_amt='$form_data[discount_percent_amt]', tip_percent='$form_data[tip_in_percent]', tip_amt='$form_data[calculate_percent_amt]', balance_amt='$form_data[balance_amt]', tendered_amt='$form_data[tendered_amt]', cash_change='$form_data[cash_change]' WHERE order_id='$_SESSION[order_id]'");
		}
		
	}
	function get_payment_detail($order_id){
		return $query = mysql_fetch_array(mysql_query("SELECT * FROM `apx_payment` WHERE order_id = '$order_id'"));
	}
	function get_addons($item_id){
		$query = mysql_query("SELECT * FROM items WHERE categoryID IN (SELECT sideOrderCat FROM items WHERE itemID='$item_id')") or die(mysql_error());
		$res_array = array();
		while ($res = mysql_fetch_array($query)) {
			//array_push($res_array, $res);
			$res_array[]=$res;
		}
		return $res_array;
	}
	function get_side_order_detail($ids){
		$query = mysql_query("SELECT * FROM items WHERE itemID IN($ids)");
		$res_array = array();
		while ($res = mysql_fetch_array($query)) {
			//array_push($res_array, $res);
			$res_array[]=$res;
		}
		return $res_array;
	}
	function save_discount($data, $h_id){
		$query = mysql_query("UPDATE apx_order_history SET item_discount_percent='$data[modal_item_disc]', item_discount_amount='$data[item_disc_custom]' WHERE id='$h_id'");
		if($query){
			return $data[modal_item_disc];
		}else{
			return "NOT OK";
		}
	}
	function get_payment_info($o_id=""){
		if($o_id==""){
		$order_id = $_SESSION['order_id'];	
		}else{
			$order_id = $o_id;
		}
		return $query = mysql_fetch_array(mysql_query("SELECT * FROM apx_payment WHERE order_id='$order_id'"));
	}
	function update_cart_payment($order_id, $card_amount){
		$remin_amt = $this->get_payment_info($order_id);
		$p = substr($remin_amt[cash_change], 1);
		$card_amount_n = $remin_amt['cart_pay_amount']+$card_amount;
		$cash_change = $card_amount-$p;
		mysql_query("UPDATE apx_payment SET cart_pay_amount='$card_amount_n', cash_change='$cash_change' WHERE order_id='$order_id'");
		if($remin_amt['cash_change']>=0){
			$update_order = mysql_query("UPDATE orders SET order_status='complete' WHERE orderID='$order_id'");
		}
		
	}
	function new_customer($data,$order_id){
		
		$query = mysql_query("insert into customers (cName,cPhone,cEmail,cCountry,cCity,cZip,order_id) Values('$data[name]','$data[phoneNumber]','$data[email]','$data[country]','$data[city]','$data[zip]','$order_id')");
		//echo "insert into customers (cName,cPhone,cEmail,cCountry,cCity,cZip,order_id) Values('$data[name]','$data[phoneNumber]','$data[email]','$data[country]','$data[city]','$data[zip]','$order_id')";
	}
	function get_tax(){
		return $query = mysql_query("SELECT * from apx_tax where status='on'");
	}
	function get_tax_name(){
		$tax_ar = array();
		$taxs = $this->get_tax();
		while ($tax = mysql_fetch_array($taxs)) {
			$tax_ar[] = $tax['tax_type'];
		}
		return $tax_ar;
	}
	function get_tax_percent(){
		$tax_ar = array();
		$taxs = $this->get_tax();
		while ($tax = mysql_fetch_array($taxs)) {
			$tax_ar[] = $tax['tax_percent'];
		}
		return $tax_ar;
	}
	function get_tax_amount(){
		$tax_ar = array();
		$taxs = $this->get_tax();
		$amount = $this->get_order_total_amount_without_tax();
		while ($tax = mysql_fetch_array($taxs)) {
			$tax_ar[] = $tax['tax_percent'];
		}
		$tax_amount = (array_sum($tax_ar) / 100) * $amount;
		return number_format((float)$tax_amount, 2, '.', '');
	}
	function save_tax_in_order(){
		$check = mysql_num_rows(mysql_query("SELECT * FROM apx_order_tax WHERE order_id='$_SESSION[order_id]'"));
		if($check<=0){
			$taxs = $this->get_tax();
			while ($tax = mysql_fetch_array($taxs)) {				
				$insert = mysql_query("insert into apx_order_tax(order_id,tax_type,tax_percent,edate) values('$_SESSION[order_id]','$tax[tax_type]','$tax[tax_percent]',NOW())");
			}
		}
	}
	function get_paid_tax_detail($order_id){
		return $check = mysql_query("SELECT * FROM apx_order_tax WHERE order_id='$order_id'");
	}
}
?>