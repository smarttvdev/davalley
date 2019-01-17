<?php
session_start();
include("classes.php");
$obj=new Classes();

if(isset($_REQUEST['order_id'])){
    $order_history = $obj->get_order_item_list($_REQUEST['order_id']);
    $order_detail = $obj->get_payment_detail($_REQUEST['order_id']);
}


$invoiceNum=$_REQUEST['order_id'];
$i=0;
$items_txt='';
while ($item = $order_history->fetch_array()) {
    $i++;
    $items_txt .= $i." ".stredit($item['itemName'],35)." ".
                 $item['quantity']."  ".$item['quantity']*$item['itemPrice']."\r\n ";
}

$discount_amt= $order_detail['discount_amt'];
$tip_amt=$order_detail['tip_amt'];
$balance_amt=$order_detail['balance_amt'];
$tendered_amt=$order_detail['tendered_amt'];
$cash_change=$order_detail['cash_change'];
$charge=$obj->get_order_total_amount_by_id($_REQUEST['order_id']);


$txt_receipt = "------------------Receipt# ".$invoiceNum."\r\nDa Valley Grill
Hawaiian Style Asian Food
2040 W.Deer Vallery Rd.
Phoenix, AZ 85032\r\n

#--Items----------------------------Qty-Amount\r\n ".$items_txt.
    "\r\n                                    ".   "Discount:".'$'.$discount_amt."\r\n
    		            	    Tips:".'$'.$tip_amt."\r\n
    		            	    Total: $".$balance_amt."\r\n
            		            Tender:".'$'.$tendered_amt."\r\n
    		            	    Cash Change:".'$'.$cash_change."\r\n
    		            	    Charge: $".$charge;

function stredit($str,$len=30){
    if (strlen($str)<$len){
        $str_return = $str;
        for ($i=0 ; $i< $len- strlen($str) ; $i++)
            $str_return.=" ";
        return $str_return;
    }else{
        return substr($str , 0 , $len);
    }
}


$tempfile_txt = '1_tmp'.date('mdHis');
$result=array();
$result['text_file']=$tempfile_txt;

$txt_url = '../../tmp/'.$tempfile_txt.'.txt';
$f_txt = fopen($txt_url,'wb');
fwrite($f_txt, $txt_receipt);
fclose($f_txt);
echo json_encode($result);
?>





