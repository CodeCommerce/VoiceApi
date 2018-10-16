<?php
/**
 * Created by PhpStorm.
 * User: Chris
 * Date: 16.10.18
 * Time: 16:22
 */

namespace CodeCommerce\AlexaApi\Controller;


use CodeCommerce\AlexaApi\Core\ResponseFormatter;
use CodeCommerce\AlexaApi\Model\Response;

class ResponseHandler
{
    public function sendResponse(Response $response)
    {
        $this->addHeader();
        $responseFormatter = new ResponseFormatter($response);
        echo $responseFormatter->getFormattedResponse();
    }

    protected function addHeader()
    {
//        header('Content-Type: application/json');
    }
}
