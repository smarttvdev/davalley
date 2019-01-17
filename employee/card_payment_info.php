<?php
include("include/head2.php");

require_once("authorize.net/AuthorizeNet.php");
$CONFIG['loginID'] = '5bJRn256f6'; // login
$CONFIG['transactionKey'] = '38926Zz4srr28ZTh';
$CONFIG['AUTHORIZE_MD5_HASH'] = '16931504cd2a6403e8a7f9d951e04e98';
$CONFIG['AUTHORIZENET_SANDBOX'] = TRUE;
// END AUTHORIZE.NET CONFIG //
$CONFIG['site'] = base_url();
$CONFIG['image_location'] = "/images/products";
$CONFIG['company'] = "Da ValleyGrill";
$CONFIG['company_slogan'] = "Hawaiian style Asian Fusion ... Mon-Fri 9am-7:30pm  Sat 9-3pm";
$CONFIG['pageRows'] = 10;
$CONFIG['x_relay_url'] = $CONFIG['site'] . 'card_payment_info.php';
$CONFIG['AUTHORIZE_MD5_HASH'] = '16931504cd2a6403e8a7f9d951e04e98';
$CONFIG['state_tax'] = "8.6%";
$CONFIG['menu_url'] = $CONFIG['site'] . "/images/menu.png";
$response = new AuthorizeNetSIM($CONFIG['loginID'], $CONFIG['AUTHORIZE_MD5_HASH']);

if ($response->approved) {

print_r($_POST);
    //$orderID = orderPaid($response->cust_id);
    //clearOrder($response->cust_id);
    $_SESSION['orderID'] = $orderID;
    $pp = array();
    echo $pp['phoneNumber'] = $response->cust_id;
    $pp['invoiceNum'] = $response->invoice_num;
    $pp['card_amount'] = $response->amount;
    

   // placePayment($pp);
    $update_payment = $obj->update_cart_payment($pp['invoiceNum'],$pp['card_amount']);



    $cc = array();
    $cc['phoneNumber'] = $response->cust_id;
    $cc['country'] = $response->country;
    $cc['city'] = $response->city;
    $cc['zip'] = $response->zip_code;
    $cc['name'] = $response->first_name . '  ' . $response->last_name;
    $cc['email'] = $response->email_address;
   // updateCustomer($cc);

    echo $add_customer = $obj->new_customer($cc,$pp['invoiceNum']); 

    //            $return_url = $CONFIG['site'] . '/#success?transaction_id=' .$response->transaction_id;
    //            $return_url = $CONFIG['site'] . '/#success?' . $orderID;
    //$return_url = base_url() . 'search.php?success=&orderID=' . $orderID;

} else {
    // There was a problem. Do your logic here.
    // Redirect the user back to your site.
    //            $return_url = $CONFIG['site'] . '/#error?response_reason_code='.$response->response_reason_code.'&response_code='.$response->response_code.'&response_reason_text=' .$response->response_reason_text;
    //            $return_url = $CONFIG['site'] . '/#error?response_reason_code='.$response->response_reason_code.'&response_code='.$response->response_code.'&response_reason_text=' .$response->response_reason_text;
    //$return_url = base_url() . '/#error';
}
$return_url = $CONFIG['site'] . '?check';
echo AuthorizeNetDPM::getRelayResponseSnippet($return_url);
//    } else {
//        echo "MD5 Hash failed. Check to make sure your MD5 Setting matches the one in config.php";
//    }
