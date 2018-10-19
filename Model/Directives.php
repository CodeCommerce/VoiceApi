<?php

namespace CodeCommerce\AlexaApi\Model;

/**
 * Class Directives
 * @package CodeCommerce\AlexaApi\Model
 */
class Directives
{
    const TYPE_DISPLAY_TEMPLATE = 'Display.RenderTemplate';

    /**
     * @var
     */
    protected $type;
    /**
     * @var
     */
    protected $template;

    public function __construct()
    {
        $this->setType(self::TYPE_DISPLAY_TEMPLATE);
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     * @return Directives
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @param mixed $template
     * @return Directives
     */
    public function setTemplate($template)
    {
        $this->template = $template;

        return $this;
    }
}