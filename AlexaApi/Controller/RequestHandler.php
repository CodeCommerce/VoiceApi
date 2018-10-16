<?php

namespace CodeCommerce\AlexaApi\Controller;

use CodeCommerce\AlexaApi\Core\RequestEvaluator;
use CodeCommerce\AlexaApi\Core\RequestRouter;

class RequestHandler
{
    protected $_jsonObject;

    protected $_requestEvaluator;

    protected $_intent;

    public function __construct($jsonObject)
    {
        $this->_jsonObject = $jsonObject;

        try {
            if ($this->checkRequest()) {
                $this->setRequestEvaluator($this->_jsonObject->request);
                $this->setIntent($this->getRequestEvaluator()->getIntent());
            }
            $this->doRequest();
        } catch (\Exception $exception) {
            die($exception->getMessage());
        }
    }

    public function getIntent()
    {
        return $this->_intent;
    }

    public function setIntent($oIntent)
    {
        $this->_intent = $oIntent;
    }

    public function getRequestEvaluator()
    {
        return $this->_requestEvaluator;
    }

    public function setRequestEvaluator($oRequest)
    {
        $this->_requestEvaluator = new RequestEvaluator($oRequest);
    }

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
            $intent = new $intentClass($this->getRequestEvaluator()->getRequest());
            $intent->runIntent();
        }
    }
}