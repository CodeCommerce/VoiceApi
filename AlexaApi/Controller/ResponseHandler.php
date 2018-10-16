<?php

namespace CodeCommerce\AlexaApi\Controller;

use CodeCommerce\AlexaApi\Core\ResponseFormatter;
use CodeCommerce\AlexaApi\Model\ResponseBody;

class ResponseHandler
{
    public function sendResponse(ResponseBody $responseBody)
    {
        $this->addHeader();
        $responseFormatter = new ResponseFormatter($responseBody);
        echo $responseFormatter->getFormattedResponse();
    }

    protected function addHeader()
    {
        header('Content-Type: application/json');
    }
}
