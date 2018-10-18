<?php
require __DIR__ . '/../vendor/autoload.php';
// LIVE
$json = json_decode(file_get_contents('php://input'));

// TEST
//$json = json_decode(file_get_contents(__DIR__ . '/../AlexaRequests/StandardRequestSlots.json'));
$request = new CodeCommerce\AlexaApi\Controller\RequestHandler($json);
