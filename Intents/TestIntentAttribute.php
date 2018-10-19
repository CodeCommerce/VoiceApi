<?php

namespace CodeCommerce\AlexaApi\Intents;

use CodeCommerce\AlexaApi\Controller\ResponseHandler;
use CodeCommerce\AlexaApi\Model\Outspeech;
use CodeCommerce\AlexaApi\Model\Request;
use CodeCommerce\AlexaApi\Model\Response;
use CodeCommerce\AlexaApi\Model\ResponseBody;
use CodeCommerce\AlexaApi\Model\SSML;
use CodeCommerce\AlexaApi\Model\System;

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
     * @param System  $system
     */
    public function __construct(Request $request, System $system)
    {
        $this->request = $request;
        $this->intent = $request->getIntent();
        $this->system = $system;
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
        $outSpeech->setType(Outspeech::TYPE_SSML);
        $SSML = new SSML();
        if (!$sAnswer) {
            $SSML->addText("Es tut mir sehr leid, wir finden das angegebene Format nicht.");
            $outSpeech->setSsml($SSML);

            return $outSpeech;
        }
        $SSML->addText("Das Format hat eine Größe von ");
        $SSML->addWhisper($sAnswer);
        $outSpeech->setSsml($SSML->getText());

        return $outSpeech;
    }

    /**
     * @param $sFormat
     * @return bool|string
     */
    protected function getDinFormat($sFormat)
    {
        $iSize = (int)str_replace('dina', '', $sFormat);
        if ($iSize > 0) {
            $width = 1.189;
            $height = 0.841;

            for ($i = 1; $i - 1 < $iSize; $i++) {
                $width = round($width / (sqrt(2)), 5, PHP_ROUND_HALF_UP);
                $height = round($height / (sqrt(2)), 5, PHP_ROUND_HALF_UP);
            }

            return round(($height * 1000), 0) . "mm mal " . round(($width * 1000), 0) . "mm";
        }

        return false;
    }
}
