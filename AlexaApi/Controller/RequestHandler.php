<?php

namespace CodeCommerce\AlexaApi\Controller;


class RequestHandler
{
    protected $_request;

    public function __construct()
    {
        $this->_request = new \stdClass();
    }

}