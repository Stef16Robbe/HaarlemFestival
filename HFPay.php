<?php

use Mollie\Api\Resources\Order;

use function _PhpScoper5c0568000558c\GuzzleHttp\Psr7\str;

require_once( "Autoloader.php");
/*
 * Make sure to disable the display of errors in production code!
 */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once ("mollie/vendor/autoload.php");
require_once ("mollie/examples/functions.php");
/*
 * Initialize the Mollie API library with your API key.
 *
 * See: https://www.mollie.com/dashboard/developers/api-keys
 */

$Config = Config::getInstance();

$MakeOrder = new MakeOrder;
$session = new session;
$mollie = new \Mollie\Api\MollieApiClient();

$mollie->setApiKey($Config->GetMollieKey());
$PayAmount = $MakeOrder->GetPrice();
$OrderId = $_GET["OrderId"];
$payment = $mollie->payments->create([
    "amount" => [
        "currency" => "EUR",
        "value" => $PayAmount
    ],
    "description" => "Kaartjes Haarlem Fest",
    "redirectUrl" => $Config->GetWebURL()."/ThankYou.php",
    "webhookUrl"  => $Config->GetWebURL()."/HFWebHook.php",
    "metadata" => $OrderId
]);
header("Location: " . $payment->getCheckoutUrl(), true, 303);
?>