<?php

namespace CodeCommerce\AlexaApi\Controller;

use CodeCommerce\AlexaApi\Core\ContextParser;
use CodeCommerce\AlexaApi\Core\RequestParser;
use CodeCommerce\AlexaApi\Core\RequestRouter;
use CodeCommerce\AlexaApi\Core\SecurityChecker;
use CodeCommerce\AlexaApi\Model\Outspeech;
use CodeCommerce\AlexaApi\Model\Response;
use CodeCommerce\AlexaApi\Model\ResponseBody;
use CodeCommerce\AlexaApi\Model\System;
use CodeCommerce\AlexaApi\Model\Intent;

/**
 * Class RequestHandler
 * @package CodeCommerce\AlexaApi\Controller
 */
class RequestHandler
{
    /**
     * @var object
     */
    protected $_jsonObject;

    /**
     * @var RequestParser
     */
    protected $_requestParser;

    /**
     * @var Intent
     */
    protected $_intent;
    /**
     * @var ContextParser
     */
    protected $_contextParser;
    /**
     * @var System
     */
    protected $system;

    /**
     * RequestHandler constructor.
     * @param $jsonObject
     */
    public function __construct($jsonObject)
    {
        $this->_jsonObject = $jsonObject;

        try {
            if ($this->checkRequest()) {
                $this->setRequestParser($this->_jsonObject->request);
                $this->setIntent($this->getRequestParser()->getIntent());
                $this->setContextParser($this->_jsonObject->context);
                $this->setSystem($this->_contextParser->getSystem());
                $this->securityCheck($this->getSystem());
            }
            $this->doRequest();
        } catch (\Exception $exception) {
            $responseHandler = new ResponseHandler();
            $responseBody = new ResponseBody();
            $response = new Response();
            $response->setOutputSpeech(new Outspeech($exception->getMessage()));
            $responseBody->setResponse($response);
            die($responseHandler->sendResponse($responseBody));
        }
    }

    /**
     * @return mixed
     */
    public function getIntent()
    {
        return $this->_intent;
    }

    /**
     * @param $oIntent
     */
    public function setIntent($oIntent)
    {
        $this->_intent = $oIntent;
    }

    /**
     * @return System
     */
    public function getSystem()
    {
        return $this->system;
    }

    /**
     * @param System $system
     */
    public function setSystem(System $system)
    {
        $this->system = $system;
    }

    /**
     * @return mixed
     */
    public function getRequestParser()
    {
        return $this->_requestParser;
    }

    /**
     * @param $context
     */
    public function setContextParser($context)
    {
        $this->_contextParser = new ContextParser($context);
    }

    /**
     * @param $oRequest
     * @throws \Exception
     */
    public function setRequestParser($oRequest)
    {
        $this->_requestParser = new RequestParser($oRequest);
    }

    /**
     * @return bool
     * @throws \Exception
     */
    protected function checkRequest()
    {
        if (!property_exists($this->_jsonObject, 'request')) {
            throw new \Exception('Request not set.');
        }

        return true;
    }

    /**
     * @param System $system
     * @throws \Exception
     */
    protected function securityCheck(System $system)
    {
        $security = new SecurityChecker();
        $security->checkAppId($system->getApplication());
    }

    /**
     *
     */
    protected function doRequest()
    {
        $router = new RequestRouter();
        $intentClass = $router->getRoute($this->getIntent()->getName());

        if (class_exists($intentClass)) {
            $intent = new $intentClass($this->getRequestParser()->getRequest(), $this->getSystem());
            $intent->runIntent();
        }
    }
}
