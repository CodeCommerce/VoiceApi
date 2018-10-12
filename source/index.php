<?php
require __DIR__ . '/../vendor/autoload.php';

$test_request = file_get_contents(__DIR__ . '/../AlexaRequests/StandardRequest.json');

$json = json_decode($test_request);
$request = new CodeCommerce\AlexaApi\Controller\RequestHandler($json);
