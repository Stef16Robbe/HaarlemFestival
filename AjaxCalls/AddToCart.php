<?php
require_once("Autoloader.php");
if(isset($_POST['eventId']) && isset($_POST['typeEvent']) && isset($_POST['amount'])) {
    $eventId = $_POST['eventId'];
    $TypeEvent = $_POST['typeEvent'];
    $amount = $_POST['amount'];
    $session = new Session;
    $session->AddToCart($eventId,$TypeEvent,$amount);
}
?>