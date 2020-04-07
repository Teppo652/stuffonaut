<?php
 
require_once('WebToPay.php');
 
function get_self_url() {
    $s = substr(strtolower($_SERVER['SERVER_PROTOCOL']), 0,
                strpos($_SERVER['SERVER_PROTOCOL'], '/'));
 
    if (!empty($_SERVER["HTTPS"])) {
        $s .= ($_SERVER["HTTPS"] == "on") ? "s" : "";
    }
 
    $s .= '://'.$_SERVER['HTTP_HOST'];
 
    if (!empty($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] != '80') {
        $s .= ':'.$_SERVER['SERVER_PORT'];
    }
 
    $s .= dirname($_SERVER['SCRIPT_NAME']);
 
    return $s;
}
 
/* NOTE: change 'test'=>1 to 'test'=>0 when in production! */

// https://developers.paysera.com/en/payments/current#integration-via-library

// projectid - paysera (approved) project number
// orderid - userId from system
// accepturl - Full URL where customer is redirected after a successful payment
// cancelurl - sama kuin ed mutta epäonnistunut
// ...
// payment - Payment method
// paytext - Payment purpose. If not specified, default text is used: Payment for goods and services (order nr. [order_nr]) ([site_name]). 
try {
    $self_url = get_self_url();
 
    $request = WebToPay::redirectToPayment(array(
        'projectid'     => 0,
        'sign_password' => 'd41d8cd98f00b204e9800998ecf8427e',
        'orderid'       => 0,
        'amount'        => 3,
        'currency'      => 'EUR',
        'country'       => 'LT',
        'accepturl'     => $self_url.'/accept.php',
        'cancelurl'     => $self_url.'/cancel.php',
        'callbackurl'   => $self_url.'/callback.php',
        'paytext'       => 'Membership for one month',
        'test'          => 1,
    ));
} catch (WebToPayException $e) {
    // handle exception
    // https://developers.paysera.com/en/payments/1.6#error-codes
} 