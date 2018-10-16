<?php

namespace CodeCommerce\AlexaApi\Intents;


use CodeCommerce\AlexaApi\Controller\ResponseHandler;
use CodeCommerce\AlexaApi\Model\Intent;
use CodeCommerce\AlexaApi\Model\Outspeech;
use CodeCommerce\AlexaApi\Model\Request;
use CodeCommerce\AlexaApi\Model\Response;

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
        $response->setVersion('1.0')
            ->setOutputSpeech($this->getTestOutspeech());

        $responsehandler = new ResponseHandler();
        $responsehandler->sendResponse($response);
    }

    protected function getTestOutspeech()
    {
        $outspeech = new Outspeech();
        $outspeech->setText('Wir testen eine Ausgabe');
        return $outspeech;
    }
}
