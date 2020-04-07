<?php
 
require_once('WebToPay.php');

/*
In case of success, callback script must return the response beginning with or equal to “OK”. Parameters returned by callback can be found in the detailed specification:
https://developers.paysera.com/en/payments/1.6#integration-via-specification
*/
 
try {
    $response = WebToPay::checkResponse($_GET, array(
        'projectid'     => 0,
        'sign_password' => 'd41d8cd98f00b204e9800998ecf8427e',
    ));
 
    if ($response['test'] !== '0') {
        throw new Exception('Testing, real payment was not made');
    }
    if ($response['type'] !== 'macro') {
        throw new Exception('Only macro payment callbacks are accepted');
    }
 
    $orderId = $response['orderid'];
    $amount = $response['amount'];
    $currency = $response['currency'];
    //@todo: patikrinti, ar užsakymas su $orderId dar nepatvirtintas (callback gali būti pakartotas kelis kartus)
    //@todo: patikrinti, ar užsakymo suma ir valiuta atitinka $amount ir $currency
    //@todo: patvirtinti užsakymą
 
    echo 'OK';
} catch (Exception $e) {
    echo get_class($e) . ': ' . $e->getMessage();
}