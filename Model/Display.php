<?php

namespace CodeCommerce\AlexaApi\Model;

/**
 * Class Display
 * @package CodeCommerce\AlexaApi\Model
 */
class Display
{
    /**
     * @var string
     */
    protected $templateVersion;
    /**
     * @var string
     */
    protected $markupVersion;

    /**
     * @return mixed
     */
    public function getTemplateVersion()
    {
        return $this->templateVersion;
    }

    /**
     * @param mixed $templateVersion
     * @return Display
     */
    public function setTemplateVersion($templateVersion)
    {
        $this->templateVersion = $templateVersion;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMarkupVersion()
    {
        return $this->markupVersion;
    }

    /**
     * @param mixed $markupVersion
     * @return Display
     */
    public function setMarkupVersion($markupVersion)
    {
        $this->markupVersion = $markupVersion;

        return $this;
    }
}