<?php

namespace CodeCommerce\AlexaApi\Intents;

use CodeCommerce\AlexaApi\Controller\ResponseHandler;
use CodeCommerce\AlexaApi\Model\Outspeech;
use CodeCommerce\AlexaApi\Model\Request;
use CodeCommerce\AlexaApi\Model\Response;
use CodeCommerce\AlexaApi\Model\ResponseBody;

/**
 * Class TestIntentAttribute
 * @package CodeCommerce\AlexaApi\Intents
 */
class TestIntentAttribute implements IntentsInterface
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var mixed
     */
    protected $intent;

    /**
     * TestIntent constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->intent = $request->getIntent();
    }

    /**
     * @return mixed
     */
    public function runIntent()
    {
        $response = new Response();
        $slot = $this->intent->getSlot('DINFORMAT');
        $response->setOutputSpeech($this->getDinFormatOutspeech($this->getDinFormat($slot->getValue())));

        $responseBody = new ResponseBody();
        $responseBody->setResponse($response);

        $responseHandler = new ResponseHandler();
        $responseHandler->sendResponse($responseBody);
    }

    /**
     * @param $sAnswer
     * @return string
     */
    protected function getDinFormatOutspeech($sAnswer)
    {
        $outSpeech = new Outspeech();
        if (!$sAnswer) {
            return $outSpeech->setText("Es tut mir sehr leid, wir finden das angegebene Format nicht.");
        }

        return $outSpeech->setText("Das Format hat eine Größe von " . $sAnswer);
    }

    /**
     * @param $sFormat
     * @return bool|string
     */
    protected function getDinFormat($sFormat)
    {
        switch ($sFormat) {
            case 'dina4':
                return "40cm mal 40cm";
            case 'dina3':
                return "30cm mal 30cm";
        }

        return false;
    }
}
