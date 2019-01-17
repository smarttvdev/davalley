<?php
include_once 'config.php';
class Classes
{
    public $mysqli;
	function __construct()
	{
        $this->mysqli = new mysqli("localhost", "myorders", "Davalley7!", "myorders");
        if ($this->mysqli->connect_errno) {
            echo "Failed to connect to MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
        }
	}

	function logout(){
	    $mysqli=$this->mysqli;
	    $query="SELECT * FROM UserTimeSheets WHERE UserID='$_SESSION[employee_id]' ORDER BY id DESC LIMIT 0, 1";
	    $query_result=$mysqli->query($query);
	    $last_user_id = $query_result->fetch_array(MYSQLI_ASSOC);
		$query = $mysqli->query("UPDATE UserTimeSheets SET clockOutTime=NOW() where id=$last_user_id[id]");
	}
	function get_top_selling_item($limit=""){
	    $mysqli=$this->mysqli;
		$top_sell_item = array();
		$query_result =$mysqli->query("SELECT  `item_id` , SUM(  `quantity` ) AS TotalQuantity FROM apx_order_history GROUP BY  `item_id`
                        HAVING SUM(  `quantity` )  LIMIT 0 , $limit");
		while ($re = $query_result->fetch_array()) {
			array_push($top_sell_item, $re['item_id']);
		}
		$item_ids = implode(',', $top_sell_item);
		return $mysqli->query("SELECT * FROM items WHERE itemID IN($item_ids)");
	}
	function get_item_by_id($id){
	    $mysqli=$this->mysqli;
	    $query1=$mysqli->query("SELECT * FROM `items` WHERE itemID='$id'");
		return $query = $query1->fetch_array(MYSQLI_ASSOC);
	}

	function create_new_order($table_number){
        $mysqli=$this->mysqli;

        $today_date=(new \DateTime())->format('Y-m-d');
        $today_time=(new \DateTime())->format('H:i:s');

        $query = "insert into apx_order(user_id,table_id,order_status,added_date,added_time) values('$_SESSION[employee_id]','$table_number','Pending','$today_date','$today_time')";
        $query_result=$mysqli->query($query);

//<--------------------------------------        Origianal Code        ------------------>
        //        if ($query_result){
        //            $last_id=$mysqli->insert_id;
        //            $num = sprintf("%'.05d\n", $last_id);
        //            $mysqli->query("update apx_order set ticket_id='$num' where id='$last_id'");
        //            return $last_id;
        //        }


// <---------------------------------------       Tai's Code            --------------------->
        if ($query_result){
            $last_id=$mysqli->insert_id;
            $last_order=$this->GetUniqueID();
//            $num = sprintf("%'.05d\n", $last_id);
            $mysqli->query("update apx_order set ticket_id='$last_order' where id='$last_id'");
//            return $last_order;
            return $last_id;
        }
	}

//	 Tai's Inserted Function
    function GetUniqueID() {
        $mysqli=$this->mysqli;
        $query = "select Invoice from sysfile limit 1";
        $result = $mysqli->query($query);
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $last_order = $row['Invoice'] + 1;
        $query_update = "UPDATE `sysfile` SET Invoice=Invoice + 1";
        $result_update = $mysqli -> query($query_update);
        return $last_order;
    }






	function get_current_order_detail(){
        $mysqli=$this->mysqli;
        $query_result=$mysqli->query("SELECT * FROM `apx_order` WHERE id='$_SESSION[order_id]'");
		return $query = $query_result->fetch_array(MYSQLI_ASSOC);
	}
	function add_item_to_order($item_id,$form_data){
        $mysqli=$this->mysqli;
        $query_result=$mysqli->query("SELECT * FROM apx_order_history where item_id='$item_id' and order_id='$_SESSION[order_id]'");
		$check_item = $query_result->num_rows;

		if($check_item<=0){
//			dd($form_data);
			if(sizeof($form_data['item_checkbox'])>=1){
			    $sider_order = implode(',', $form_data['item_checkbox']);
			}else{
			    $sider_order = "";
			}
			$add_item = $mysqli->query("insert into apx_order_history(order_id,item_id,quantity,side_order_item_ids,cook_message,added_date) values('$_SESSION[order_id]','$item_id','1','$sider_order','$form_data[cook_message]',NOW())");
			if($form_data['cook_message']!=""){
				$message = ",".$form_data['cook_message'];
			}else{
				$message = "";
			}
			$side_order_name = $this->get_side_order_detail_for_old($sider_order);
			$all_side_orders = $side_order_name.$message;
			$old_trable_order = $mysqli->query("insert into orders(neworderID,itemID,cookWith,sideOrder,quantity,dateOrdered) values('$_SESSION[order_id]','$item_id','$all_side_orders','$sider_order','1',NOW())");
			$old_ordertableID = $mysqli->insert_id;
			$query_result=$mysqli->query("SELECT * FROM `apx_order` WHERE id='$_SESSION[order_id]'");
			$row=$query_result->fetch_array(MYSQLI_ASSOC);
			$order_id=$row['ticket_id'];


//			$old_trable_order_paid = $mysqli->query("insert into ordersPaid(neworderID,orderID,itemID,cookWith,sideOrder,quantity,dateOrdered,cash,orderRead,orderCompleted,orderBy,price,userID,tableNum,GuestNum) values('$_SESSION[order_id]','$old_ordertableID','$item_id','$all_side_orders','$sider_order','1',NOW(),'0','1','','0','','','','')")or die(mysqli_error());
            $old_trable_order_paid = $mysqli->query("insert into ordersPaid(neworderID,orderID,itemID,cookWith,sideOrder,quantity,dateOrdered,cash,orderRead,orderCompleted,orderBy,price,userID,tableNum,GuestNum) values('$_SESSION[order_id]','$order_id','$item_id','$all_side_orders','$sider_order','1',NOW(),'1','0','','0','','','$row[table_id]','')")or die(mysqli_error());

			return $this->get_item_by_id($item_id);
		}else{
			return "exist";
		}
	}
	function get_side_order_detail_for_old($sider_order_id){
        $mysqli=$this->mysqli;
		if($sider_order_id!=""){
		$q = $mysqli->query("SELECT * from items where itemID IN ($sider_order_id)");
		$side_order_names = array();
		while ($res = $q->fetch_array()) {
		$side_order_names[] = $res['itemName'];
		}
		return implode(",", $side_order_names);
		}
	}
	function get_order_item_by_id($item_id){
	    $mysqli=$this->mysqli;
	    $query_result=$mysqli->query("SELECT * FROM apx_order_history WHERE item_id='$item_id' AND order_id='$_SESSION[order_id]'");
	    $rows= $query_result->fetch_array(MYSQLI_ASSOC);
	    var_dump($rows);
	    return $rows;
	}

	function get_order_item_list($o_id = ""){
		if($o_id==""){
		$order_id = $_SESSION['order_id'];
		}else{
			$order_id = $o_id;
		}
        $mysqli=$this->mysqli;
		$query="SELECT * FROM  items i LEFT JOIN apx_order_history oh ON i.itemID = oh.item_id WHERE oh.order_id='$order_id'";
        $query_result=$mysqli->query($query);
        return $query_result;
	}

function get_order_item_list_checkout($o_id = ""){
    $mysqli=$this->mysqli;
		if($o_id==""){
		$order_id = $_SESSION['order_id'];
		}else{
			$order_id = $o_id;
		}

		$query = $mysqli->query("SELECT * FROM  items i LEFT JOIN apx_order_history oh ON i.itemID = oh.item_id WHERE oh.order_id='$order_id'");
		$res_array = array();
		while ($res = $query->fetch_array()) {
			//array_push($res_array, $res);
			$res_array[]=$res;
		}
		return $res_array;
		//return $query = mysql_query("SELECT * FROM `items` WHERE itemID IN(SELECT item_id FROM apx_order_history WHERE order_id='$_SESSION[order_id]')");
	}

	function get_order_total_amount(){
        $mysqli=$this->mysqli;
		$total_array = array();
		$item_qty = $mysqli->query("SELECT * FROM apx_order_history WHERE order_id='$_SESSION[order_id]'")or die(mysqli_error());
		while($res = $item_qty->fetch_array()){
		    $query=$mysqli->query(("SELECT itemPrice FROM `items` WHERE itemID = $res[item_id]"));
			$item_price = $query->fetch_array(MYSQLI_ASSOC);
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
        $mysqli=$this->mysqli;
		$total_array = array();
		$item_qty = $mysqli->query("SELECT * FROM apx_order_history WHERE order_id='$_SESSION[order_id]'")or die($mysqli->error);
		while($res = $item_qty->fetch_array()){
		    $query=$mysqli->query("SELECT itemPrice FROM `items` WHERE itemID = $res[item_id]");
			$item_price = $query->fetch_array(MYSQLI_ASSOC);
			$total_item_price = (($item_price['itemPrice']*$res['quantity'])-$res['item_discount_amount']);
			array_push($total_array, $total_item_price);
		}
		return $total = array_sum($total_array);
	}


	function get_order_total_amount_by_id($order_id){
        $mysqli=$this->mysqli;
		$total_array = array();
		$item_qty = $mysqli->query("SELECT * FROM apx_order_history WHERE order_id='$order_id'")or die(mysql_error());
		while($res = $item_qty->fetch_array()){
		    $query=$mysqli->query("SELECT itemPrice FROM `items` WHERE itemID = $res[item_id]");
			$item_price = $query->fetch_array(MYSQLI_ASSOC);
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
        $mysqli=$this->mysqli;
		$total_array = array();
		$item_qty = $mysqli->query("SELECT * FROM apx_order_history WHERE order_id='$order_id'")or die(mysql_error());
		while($res = $item_qty->fetch_array()){
		    $query=$mysqli->query("SELECT itemPrice FROM `items` WHERE itemID = $res[item_id]");
			$item_price = $query->fetch_array(MYSQLI_ASSOC);
			$total_item_price = (($item_price['itemPrice']*$res['quantity'])-$res['item_discount_amount']);
			array_push($total_array, $total_item_price);
		}
		return array_sum($total_array);

	}

	function update_item_qty($item_id,$qty){
        $mysqli=$this->mysqli;
		$query =$mysqli->query("UPDATE apx_order_history SET quantity='$qty' WHERE item_id='$item_id' and order_id='$_SESSION[order_id]'");
		$query =$mysqli->query("UPDATE orders SET quantity='$qty' WHERE itemID='$item_id' and neworderID='$_SESSION[order_id]'");
		$query = $mysqli->query("UPDATE ordersPaid SET quantity='$qty' WHERE itemID='$item_id' and neworderID='$_SESSION[order_id]'");
	}
	function get_all_item_category(){
        $mysqli=$this->mysqli;
		return $query = $mysqli->query("SELECT * FROM categories");
	}
	function get_category_by_id($id){
        $mysqli=$this->mysqli;
        $query=$mysqli->query("SELECT * FROM categories WHERE CategoryID='$id' ");
		return $query = $query->fetch_array(MYSQLI_ASSOC);
	}
	function get_items_by_category($cat_id){
        $mysqli=$this->mysqli;
		return $query =$mysqli->query("SELECT * FROM items WHERE categoryID='$cat_id'");
	}

	function remove_item_from_order($id){
        $mysqli=$this->mysqli;
		$query = $mysqli->query("DELETE FROM apx_order_history WHERE item_id='$id' and order_id='$_SESSION[order_id]'");
		$query = $mysqli->query("DELETE FROM ordersPaid WHERE itemID='$id' and neworderID='$_SESSION[order_id]'");
		$query = $mysqli->query("DELETE FROM orders WHERE itemID='$id' and neworderID='$_SESSION[order_id]'");

	}
	function get_total_order_item(){
        $mysqli=$this->mysqli;
        $query=$mysqli->query("SELECT id FROM apx_order_history WHERE order_id='$_SESSION[order_id]'");
        $num_rows=$query->num_rows;
		return $num_rows;
	}
	function get_today_orders(){
        $mysqli=$this->mysqli;
//        $today=(new \DateTime())
		$query =$mysqli->query("SELECT * FROM apx_order WHERE `added_date` >= DATE(NOW()) and user_id='$_SESSION[employee_id]'");
		return $query;
//        return $query =$mysqli->query("SELECT * FROM apx_order WHERE `added_date` >= '2018-10-01' and user_id='$_SESSION[employee_id]'");
	}
	function edit_order_from_front($order_id){
        $mysqli=$this->mysqli;
        $query1=$mysqli->query("SELECT * FROM apx_order WHERE ticket_id='$order_id'");
		$query = $query1->fetch_array(MYSQLI_ASSOC);
		if($query['order_status']=="Pending"){
			return 1;
		}else{
			return 0;
		}
	}
	function save_order_payment($form_data){
        $mysqli=$this->mysqli;

		$this->save_tax_in_order();
		$query=$mysqli->query("SELECT * FROM apx_payment WHERE order_id='$_SESSION[order_id]'");
		$check_payment =$query->num_rows;
		if($check_payment<=0){
			$query = $mysqli->query("insert into apx_payment(order_id,user_id,order_total,discount_percent,discount_amt,tip_percent,tip_amt,balance_amt,tendered_amt,cash_change) values('$_SESSION[order_id]','$_SESSION[employee_id]','$form_data[order_total]','$form_data[discount_in_percent]','$form_data[discount_percent_amt]','$form_data[tip_in_percent]','$form_data[calculate_percent_amt]','$form_data[balance_amt]','$form_data[tendered_amt]','$form_data[cash_change]')");

			if($query){
				$update_order =$mysqli->query("UPDATE apx_order SET order_status='complete' WHERE id='$_SESSION[order_id]'");
				echo "1";
			}else{
				echo "0";
			}
		}else{
			$query =$mysqli->query("
				update apx_payment set user_id='$_SESSION[employee_id]',order_total='$form_data[order_total]',discount_percent='$form_data[discount_in_percent]',discount_amt='$form_data[discount_percent_amt]',tip_percent='$form_data[tip_in_percent]',tip_amt='$form_data[calculate_percent_amt]',balance_amt='$form_data[balance_amt]',tendered_amt='$form_data[tendered_amt]',cash_change='$form_data[cash_change]' where order_id='$_SESSION[order_id]'");
			if($query){
				$update_order =$mysqli->query("UPDATE apx_order SET order_status='complete' WHERE id='$_SESSION[order_id]'");
				echo "1";
			}else{
				echo "0";
			}

		}
		/**/
	}

	function save_order_payment_with_due($form_data){
        $mysqli=$this->mysqli;
        $query=$mysqli->query("SELECT * FROM apx_payment WHERE order_id='$_SESSION[order_id]'");
		$check_payment = $query->num_rows;
		$this->save_tax_in_order();
		if($check_payment<=0){
		$query = $mysqli->query("insert into apx_payment(order_id,user_id,order_total,discount_percent,discount_amt,tip_percent,tip_amt,balance_amt,tendered_amt,cash_change) values('$_SESSION[order_id]','$_SESSION[employee_id]','$form_data[order_total]','$form_data[discount_in_percent]','$form_data[discount_percent_amt]','$form_data[tip_in_percent]','$form_data[calculate_percent_amt]','$form_data[balance_amt]','$form_data[tendered_amt]','$form_data[cash_change]')");
		}else{
			$query = $mysqli->query("UPDATE apx_payment SET order_total='$form_data[order_total]', discount_percent='$form_data[discount_in_percent]', discount_amt='$form_data[discount_percent_amt]', tip_percent='$form_data[tip_in_percent]', tip_amt='$form_data[calculate_percent_amt]', balance_amt='$form_data[balance_amt]', tendered_amt='$form_data[tendered_amt]', cash_change='$form_data[cash_change]' WHERE order_id='$_SESSION[order_id]'");
		}
		
	}
	function get_payment_detail($order_id){
        $mysqli=$this->mysqli;
        $query1=$mysqli->query("SELECT * FROM `apx_payment` WHERE order_id = '$order_id'");
		return $query = $query1->fetch_array(MYSQLI_ASSOC);
	}
	function get_addons($item_id){
        $mysqli=$this->mysqli;
//		$query =$mysqli->query("SELECT * FROM items WHERE categoryID IN (SELECT sideOrderCat FROM items WHERE itemID='$item_id')") or die(mysql_error());
        $query =$mysqli->query("SELECT * FROM items WHERE categoryID IN (SELECT sideOrderCat FROM items WHERE itemID='$item_id')");
		$res_array = array();
		while ($res = $query->fetch_array()) {
			$res_array[]=$res;
		}
		return $res_array;
	}
	function get_side_order_detail($ids){
        $mysqli=$this->mysqli;
		$query = $mysqli->query("SELECT * FROM items WHERE itemID IN($ids)");
		$res_array = array();
		while ($res = $query->fetch_array()) {
			//array_push($res_array, $res);
			$res_array[]=$res;
		}
		return $res_array;
	}
	function save_discount($data, $h_id){
        $mysqli=$this->mysqli;
		$query = $mysqli->query("UPDATE apx_order_history SET item_discount_percent='$data[modal_item_disc]', item_discount_amount='$data[item_disc_custom]' WHERE id='$h_id'");
		if($query){
			return $data[modal_item_disc];
		}else{
			return "NOT OK";
		}
	}
	function get_payment_info($o_id=""){
        $mysqli=$this->mysqli;
		if($o_id==""){
		$order_id = $_SESSION['order_id'];	
		}else{
			$order_id = $o_id;
		}
		$query1=$mysqli->query("SELECT * FROM apx_payment WHERE order_id='$order_id'");
		return $query = $query1->fetch_array(MYSQLI_ASSOC);
	}
	function update_cart_payment($order_id, $card_amount){
        $mysqli=$this->mysqli;
		$remin_amt = $this->get_payment_info($order_id);
		$p = substr($remin_amt[cash_change], 1);
		$card_amount_n = $remin_amt['cart_pay_amount']+$card_amount;
		$cash_change = $card_amount-$p;
		$mysqli->query("UPDATE apx_payment SET cart_pay_amount='$card_amount_n', cash_change='$cash_change' WHERE order_id='$order_id'");
		if($remin_amt['cash_change']>=0){
			$update_order = $mysqli->query("UPDATE apx_order SET order_status='complete' WHERE id='$order_id'");
		}
		
	}
	function new_customer($data,$order_id){
        $mysqli=$this->mysqli;
		
		$query = $mysqli->query("insert into customers (cName,cPhone,cEmail,cCountry,cCity,cZip,order_id) Values('$data[name]','$data[phoneNumber]','$data[email]','$data[country]','$data[city]','$data[zip]','$order_id')");
		//echo "insert into customers (cName,cPhone,cEmail,cCountry,cCity,cZip,order_id) Values('$data[name]','$data[phoneNumber]','$data[email]','$data[country]','$data[city]','$data[zip]','$order_id')";
	}
	function get_tax(){
        $mysqli=$this->mysqli;
		return $query = $mysqli->query("SELECT * from apx_tax where status='on'");
	}
	function get_tax_name(){
        $mysqli=$this->mysqli;
		$tax_ar = array();
		$taxs = $this->get_tax();
		while ($tax =$taxs->fetch_array(MYSQLI_ASSOC)) {
			$tax_ar[] = $tax['tax_type'];
		}
		return $tax_ar;
	}
	function get_tax_percent(){
        $mysqli=$this->mysqli;
		$tax_ar = array();
		$taxs = $this->get_tax();
		while ($tax =$taxs->fetch_array(MYSQLI_ASSOC)) {
			$tax_ar[] = $tax['tax_percent'];
		}
		return $tax_ar;
	}
	function get_tax_amount(){
        $mysqli=$this->mysqli;
		$tax_ar = array();
		$taxs = $this->get_tax();
		$amount = $this->get_order_total_amount_without_tax();
		while ($tax =$taxs->fetch_array(MYSQLI_ASSOC)) {
			$tax_ar[] = $tax['tax_percent'];
		}
		$tax_amount = (array_sum($tax_ar) / 100) * $amount;
		return number_format((float)$tax_amount, 2, '.', '');
	}
	function save_tax_in_order(){
        $mysqli=$this->mysqli;
        $query=$mysqli->query("SELECT * FROM apx_order_tax WHERE order_id='$_SESSION[order_id]'");
		$check = $query->num_rows;
		if($check<=0){
			$taxs = $this->get_tax();
			while ($tax =$taxs->fetch_array(MYSQLI_ASSOC)) {
				$insert = $mysqli->query("insert into apx_order_tax(order_id,tax_type,tax_percent,edate) values('$_SESSION[order_id]','$tax[tax_type]','$tax[tax_percent]',NOW())");
			}
		}
	}
	function get_paid_tax_detail($order_id){
        $mysqli=$this->mysqli;
		return $check =$mysqli->query("SELECT * FROM apx_order_tax WHERE order_id='$order_id'");
	}
}
?>