<?php

namespace CodeCommerce\AlexaApi\Controller;

use CodeCommerce\AlexaApi\Core\Request;
use CodeCommerce\AlexaApi\Core\RequestRouter;

class RequestHandler
{
    protected $_jsonObject;

    protected $_request;

    public function __construct($jsonObject)
    {
        $this->_jsonObject = $jsonObject;
        try {
            if ($this->checkRequest()) {
                $this->setRequest($this->_jsonObject->request);
            }
            $this->doRequest();
        } catch (\Exception $exception) {
            die($exception->getMessage());
        }
    }

    public function setRequest($oRequest)
    {
        $this->_request = new Request($oRequest);
    }

    protected function checkRequest()
    {
        if (!property_exists($this->_jsonObject, 'request')) {
            throw new \Exception('Request not set.');
        }

        return true;
    }

    protected function getRequest()
    {
        return $this->_jsonObject->request;
    }

    protected function doRequest()
    {
        $router = new RequestRouter();
        $intentClass = $router->getRoute($this->_request->getRequest()->getIntent()->getName());

        if (class_exists($intentClass)) {
            $object = new $intentClass();
        }
    }
}