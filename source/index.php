<?php
require __DIR__ . '/../vendor/autoload.php';
$bIsDev = false;

if ($bIsDev) {
    $json = json_decode(file_get_contents(__DIR__ . '/../AlexaRequests/StandardRequest.json'));
} else {
    $json = json_decode(file_get_contents('php://input'));
}

$request = new CodeCommerce\AlexaApi\Controller\RequestHandler($json);
