<?php

namespace CodeCommerce\AlexaApi\Controller;

use CodeCommerce\AlexaApi\Core\RequestParser;
use CodeCommerce\AlexaApi\Core\RequestRouter;
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
            }
            $this->doRequest();
        } catch (\Exception $exception) {
            die($exception->getMessage());
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
     * @return mixed
     */
    public function getRequestParser()
    {
        return $this->_requestParser;
    }

    /**
     * @param $oRequest
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

    protected function doRequest()
    {
        $router = new RequestRouter();
        $intentClass = $router->getRoute($this->getIntent()->getName());

        if (class_exists($intentClass)) {
            $intent = new $intentClass($this->getRequestParser()->getRequest());
            $intent->runIntent();
        }
    }
}