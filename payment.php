<?php
session_start();

if (count($_POST)) {
    require_once("SMS_Module/classes/mysqli.php");
    require_once("SMS_Module/classes/sql.class.php");

    include_once("SMS_Module/classes/config.php");
    include_once("authorize.net/AuthorizeNet.php");
    
    if(isset($_POST["pm"]) && $_POST["pm"] == "cash")
    {

        $uid = orderPaidCash($_POST);
        echo "Cash Paid! Invoice ID = ".$uid;
        //var_dump($_SESSION);
        
        $_SESSION["products"] = array();
        $url = $CONFIG['site'].'/#menu';
        echo "<meta http-equiv=\"refresh\" content=\"1; url=".$url."\" />";
        
    }
    else
    {
        $response = new AuthorizeNetSIM($CONFIG['loginID'], $CONFIG['AUTHORIZE_MD5_HASH']);
        //exit(var_dump($response->isAuthorizeNet()));
        //    if ($response->isAuthorizeNet()) {
        if ($response->approved) {

            //$orderID = orderPaid($response->cust_id);
            //clearOrder($response->cust_id);
            $_SESSION['orderID'] = $orderID;
            $pp = array();
            $pp['phoneNumber'] = $response->cust_id;
            $pp['invoiceNum'] = $response->invoice_num;
            placePayment($pp);
            $cc = array();
            $cc['phoneNumber'] = $response->cust_id;
            $cc['country'] = $response->country;
            $cc['city'] = $response->city;
            $cc['zip'] = $response->zip_code;
            $cc['name'] = $response->first_name . '  ' . $response->last_name;
            $cc['email'] = $response->email_address;
            updateCustomer($cc);
            //            $return_url = $CONFIG['site'] . '/#success?transaction_id=' .$response->transaction_id;
            //            $return_url = $CONFIG['site'] . '/#success?' . $orderID;
            $return_url = $CONFIG['site'] . '/success.php?success=&orderID=' . $orderID;

        } else {
            // There was a problem. Do your logic here.
            // Redirect the user back to your site.
            //            $return_url = $CONFIG['site'] . '/#error?response_reason_code='.$response->response_reason_code.'&response_code='.$response->response_code.'&response_reason_text=' .$response->response_reason_text;
            //            $return_url = $CONFIG['site'] . '/#error?response_reason_code='.$response->response_reason_code.'&response_code='.$response->response_code.'&response_reason_text=' .$response->response_reason_text;
            $return_url = $CONFIG['site'] . '/#error';
        }
        echo AuthorizeNetDPM::getRelayResponseSnippet($return_url);
        //    } else {
        //        echo "MD5 Hash failed. Check to make sure your MD5 Setting matches the one in config.php";
        //    }
    }
}