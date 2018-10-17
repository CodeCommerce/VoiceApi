<?php
require __DIR__ . '/../vendor/autoload.php';

$json = json_decode(file_get_contents('php://input'));
$request = new CodeCommerce\AlexaApi\Controller\RequestHandler($json);
