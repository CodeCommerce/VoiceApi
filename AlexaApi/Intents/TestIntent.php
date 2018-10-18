<?php

namespace CodeCommerce\AlexaApi\Intents;

use CodeCommerce\AlexaApi\Controller\ResponseHandler;
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

        return $outSpeech;
    }

    /**
     *
     */
    protected function getTestDirective()
    {
        $template = new Template();
        $template->setType($template::BODY_TEMPLATE_1_SIMPLE_TEXT_IMAGES)
            ->setBackButton($template::BACK_BUTTON_VISIBLE)
            ->setBackgroundImage('https://www.designguide.at/fileadmin/_migrated/pics/Logo_-_Porsche2.jpg')
            ->setTitle('Testtitel');


        $directive = new Directives();
        $directive->setTemplate($template);
        return $directive;
    }
}
