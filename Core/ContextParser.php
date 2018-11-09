<?php

namespace CodeCommerce\AlexaApi\Core;

use CodeCommerce\AlexaApi\Model\System;
use CodeCommerce\AlexaApi\Model\Viewport;

/**
 * Class ContextParser
 * @package CodeCommerce\AlexaApi\Core
 */
class ContextParser
{
    protected $_jsonObject;
    protected $system;
    protected $viewport;

    /**
     * ContextParser constructor.
     * @param $context
     */
    public function __construct($context)
    {
        $this->_jsonObject = $context;
        $this->setSystem($context->System);
        if (property_exists($context, 'Viewport')) {
            $this->setViewport($context->Viewport);
            $this->system->setViewPort($this->getViewport());
        }
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

    protected function setViewport($viewport)
    {
        $this->viewport = new Viewport($viewport);
    }

    public function getViewport()
    {
        return $this->viewport;
    }
}
