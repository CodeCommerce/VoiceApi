<?php

namespace CodeCommerce\AlexaApi\Intents;

use CodeCommerce\AlexaApi\Controller\ResponseHandler;
use CodeCommerce\AlexaApi\Model\System;
use CodeCommerce\AlexaApi\Model\BackgroundImage;
use CodeCommerce\AlexaApi\Model\Directives;
use CodeCommerce\AlexaApi\Model\Outspeech;
use CodeCommerce\AlexaApi\Model\Request;
use CodeCommerce\AlexaApi\Model\Response;
use CodeCommerce\AlexaApi\Model\ResponseBody;
use CodeCommerce\AlexaApi\Model\Template;

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
     * @var System
     */
    protected $system;

    /**
     * TestIntent constructor.
     * @param Request $request
     * @param System  $system
     */
    public function __construct(Request $request, System $system)
    {
        $this->request = $request;
        $this->system = $system;
    }

    /**
     * @return mixed|void
     */
    public function runIntent()
    {
        $response = new Response();
        $response->setOutputSpeech($this->getTestOutSpeech());
        $response->setDirectives($this->getTestDirective());

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

        if ($this->system->getDisplay()) {
            $t = 1;
        }

        return $outSpeech;
    }

    /**
     *
     */
    protected function getTestDirective()
    {
        $backgroundImage = new BackgroundImage();
        $backgroundImage->setSources('https://www.codecommerce.de/wp-content/uploads/2018/04/18403105_1372829509477095_2872277146168686090_n-316x316.jpg')
            ->setContentDescription('TestDesc');

        $template = new Template();
        $template->setType($template::BODY_TEMPLATE_1_SIMPLE_TEXT_IMAGES)
            ->setBackButton($template::BACK_BUTTON_VISIBLE)
            ->setBackgroundImage($backgroundImage)
            ->setTitle('Testtitel')
            ->setPrimary('Testing Primary')
            ->setSecondary('Secondary TEsting')
            ->setTertiary('woar we got it!');


        $directive = new Directives();
        $directive->setTemplate($template);

        return $directive;
    }
}
