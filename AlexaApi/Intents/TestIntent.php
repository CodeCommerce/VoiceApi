<?php

namespace CodeCommerce\AlexaApi\Intents;

use CodeCommerce\AlexaApi\Controller\ResponseHandler;
use CodeCommerce\AlexaApi\Model\Outspeech;
use CodeCommerce\AlexaApi\Model\Request;
use CodeCommerce\AlexaApi\Model\Response;
use CodeCommerce\AlexaApi\Model\ResponseBody;

/**
 * Class TestIntent
 * @package CodeCommerce\AlexaApi\Intents
 */
class TestIntent implements IntentsInterface
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * TestIntent constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return mixed|void
     */
    public function runIntent()
    {
        $response = new Response();
        $response->setOutputSpeech($this->getTestOutSpeech());

        $responseBody = new ResponseBody();
        $responseBody->setResponse($response);

        $responseHandler = new ResponseHandler();
        $responseHandler->sendResponse($responseBody);
    }

    /**
     * @return Outspeech
     */
    protected function getTestOutSpeech()
    {
        $outSpeech = new Outspeech();
        $outSpeech->setText('Hallo Herr Mustermann - wie geht es ihnen');

        return $outSpeech;
    }
}
