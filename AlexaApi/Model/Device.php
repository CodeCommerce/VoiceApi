<?php

namespace CodeCommerce\AlexaApi\Model;

/**
 * Class Device
 * @package CodeCommerce\AlexaApi\Model
 */
class Device
{
    /**
     * @var string
     */
    protected $deviceId;
    /**
     * @var
     */
    protected $supportedInterfaces;
    /**
     * @var Display
     */
    protected $display;

    /**
     * @return mixed
     */
    public function getDeviceId()
    {
        return $this->deviceId;
    }

    /**
     * @param mixed $deviceId
     * @return Device
     */
    public function setDeviceId($deviceId)
    {
        $this->deviceId = $deviceId;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSupportedInterfaces()
    {
        return $this->supportedInterfaces;
    }

    /**
     * @param mixed $supportedInterfaces
     * @return Device
     */
    public function setSupportedInterfaces($supportedInterfaces)
    {
        $this->supportedInterfaces = $supportedInterfaces;
        if (property_exists($supportedInterfaces, 'Display')) {
            $this->addDisplay($supportedInterfaces->Display);
        }

        return $this;
    }

    /**
     * @return Display
     */
    public function getDisplay()
    {
        return $this->display;
    }

    /**
     * @param $display
     */
    protected function addDisplay($display)
    {
        $this->display = new Display();
        $this->display->setTemplateVersion($display->templateVersion)
            ->setMarkupVersion($display->markupVersion);
    }
}
