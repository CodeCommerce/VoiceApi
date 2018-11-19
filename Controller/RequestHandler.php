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
use Monolog\Logger;

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

    protected $_routes;

    /**
     * @var Logger
     */
    protected $logger;
    protected $viewport;

    /**
     * RequestHandler constructor.
     * @param      $jsonObject
     * @param null $logger
     * @param null $routes
     */
    public function __construct($jsonObject = null, $logger = null, $routes = null)
    {
        if (!defined('TEST_MODE')) {
            define('TEST_MODE', false);
        }

        if(null === $jsonObject){
            $jsonObject = json_decode(file_get_contents('php://input'));
        }

        $this->_jsonObject = $jsonObject;

        if (null !== $logger) {
            $this->logger = $logger;
        }

        if (null !== $routes) {
            $this->_routes = $routes;
        }

        try {
            if ($this->checkRequest()) {
                $this->setRequestParser($this->_jsonObject->request);
                $this->setIntent($this->getRequestParser()->getIntent());
                $this->setContextParser($this->_jsonObject->context);
                $this->setSystem($this->_contextParser->getSystem());
                $this->setViewPort($this->_contextParser->getViewport());
                if (!TEST_MODE) {
                    $this->securityCheck($this->getSystem());
                }
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
        try {
            $security = new SecurityChecker($this->_jsonObject);
            $security->checkAppId($system->getApplication())
                     ->checkCertification();
        } catch (\Exception $exception) {
            header("HTTP/1.1 400 Bad Request");
            die();
        }
    }

    /**
     *
     */
    protected function doRequest()
    {
        $router = new RequestRouter();
        if (null !== $this->_routes) {
            foreach($this->_routes as $sIntentName => $sClassName) {
                $router->addRoute($sIntentName, $sClassName);
            }
        }

        $intentClass = $router->getRoute($this->getIntent()->getName());

        if (class_exists($intentClass)) {
            $intent = new $intentClass($this->getRequestParser()->getRequest(), $this->getSystem());
            $intent->runIntent();
        } else {
            throw new \Exception($intentClass.' not found');
        }
    }

    protected function setViewPort($viewPort)
    {
        $this->viewport = $viewPort;
    }
}
