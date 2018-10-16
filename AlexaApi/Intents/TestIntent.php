<?php

namespace CodeCommerce\AlexaApi\Intents;


use CodeCommerce\AlexaApi\Controller\ResponseHandler;
use CodeCommerce\AlexaApi\Model\Intent;
use CodeCommerce\AlexaApi\Model\Outspeech;
use CodeCommerce\AlexaApi\Model\Request;
use CodeCommerce\AlexaApi\Model\Response;
use CodeCommerce\AlexaApi\Model\ResponseBody;

class TestIntent implements IntentsInterface
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function runIntent()
    {
        $response = new Response();
        $response->setOutputSpeech($this->getTestOutSpeech());

        $responseBody = new ResponseBody();
        $responseBody->setResponse($response);

        $responseHandler = new ResponseHandler();
        $responseHandler->sendResponse($responseBody);
    }

    protected function getTestOutSpeech()
    {
        $outSpeech = new Outspeech();
        $outSpeech->setText('Wir testen eine Ausgabe');

        return $outSpeech;
    }
}
