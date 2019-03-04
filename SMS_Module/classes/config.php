<?php
// Created by CarcaBot
// 25.09.2013
// CarcaBot@CarcaBot.ro
$CONFIG['multipleSeparator'] = "/";
$CONFIG['sound_interval'] = '5000'; // Time between Sounds in milliseconds
$CONFIG['refresh_interval'] = '10000'; // Interval for refresh new orders in admin page in milliseconds

// START TWILIO CONFIG
$CONFIG['sid'] = 'ACb0d0d0438ea7f0eaf8387fdfa94367af';
$CONFIG['token'] = 'b253adc6b8405c552c07dee5046004e8';
$CONFIG['phoneNumber'] = '+16029046356';
// END TWILIO CONFIG
// START AUTHORIZE.NET CONFIG //
#$CONFIG['loginID'] = '98fdADs34'; // sandbox login
#$CONFIG['transactionKey'] = '59Nw9zxJ3827UvRG'; // sandbox transactionKey
$CONFIG['loginID'] = '846NJhs2'; // login
$CONFIG['transactionKey'] = '2n378YvbV4W5jZ33'; // transactionKey
$CONFIG['signature_key']="281D7A8C07B5E46ABE76C5AB2EDDBCEBB51D7BF300B1F4EFD31B7F655CBA176663F8FF076C9B433039CA4831C940AD05DE6948458E5DB436A486DC975834CFE6";


// END AUTHORIZE.NET CONFIG //
$CONFIG['adminpass'] = "test";
$CONFIG['site'] = "https://davalleygrill.com";
$CONFIG['image_location'] = "/images/products";
$CONFIG['company'] = "Da ValleyGrill";
$CONFIG['company_slogan'] = "Hawaiian style Asian Fusion ... Mon-Fri 9am-7:30pm  Sat 9-3pm";
$CONFIG['pageRows'] = 10;


// CONTACT FORM
$CONFIG['contact_phone'] = '+1-602-904-6356';
$CONFIG['contact_address'] = '2040 W. Deer Valley Rd.  Phoenix  AZ 85027';
$CONFIG['contact_email'] = 'lisa@davalleygrill.com';

$CONFIG['AUTHORIZENET_SANDBOX'] = FALSE;
$CONFIG['x_relay_url'] = $CONFIG['site'] . '/payment.php';
$CONFIG['AUTHORIZE_MD5_HASH'] = '16931504cd2a6403e8a7f9d951e04e98';
$CONFIG['state_tax'] = "8.6%";
$CONFIG['menu_url'] = $CONFIG['site'] . "/images/menu.png";
?>