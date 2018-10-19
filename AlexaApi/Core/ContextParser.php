<?php

namespace CodeCommerce\AlexaApi\Core;

use CodeCommerce\AlexaApi\Model\System;

/**
 * Class ContextParser
 * @package CodeCommerce\AlexaApi\Core
 */
class ContextParser
{
    /**
     * @var
     */
    protected $_jsonObject;
    /**
     * @var
     */
    protected $system;

    /**
     * ContextParser constructor.
     * @param $context
     */
    public function __construct($context)
    {
        $this->_jsonObject = $context;
        $this->setSystem($context->System);
    }

    /**
     * @return mixed
     */
    public function getSystem()
    {
        return $this->system;
    }

    /**
     * @param $system
     */
    protected function setSystem($system)
    {
        $this->system = new System($system);
    }
}
