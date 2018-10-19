<?php

namespace CodeCommerce\AlexaApi\Controller;

use CodeCommerce\AlexaApi\Core\ResponseFormatter;
use CodeCommerce\AlexaApi\Model\ResponseBody;

/**
 * Class ResponseHandler
 * @package CodeCommerce\AlexaApi\Controller
 */
class ResponseHandler
{
    public function __construct(ResponseBody $responseBody = null)
    {
        if (null !== $responseBody) {
            $this->sendResponse($responseBody);
        }
    }

    /**
     * @param ResponseBody $responseBody
     */
    public function sendResponse(ResponseBody $responseBody)
    {
        $this->addHeader();
        $responseFormatter = new ResponseFormatter($responseBody);
        die($responseFormatter->getFormattedResponse());
    }

    protected function addHeader()
    {
        header('Content-Type: application/json');
    }
}
