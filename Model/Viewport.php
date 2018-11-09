<?php

namespace CodeCommerce\AlexaApi\Model;

/**
 * Class Viewport
 * @package CodeCommerce\AlexaApi\Model
 */
class Viewport
{
    /**
     *
     */
    const DEVICE_TYPE_SPOT = 'spot';
    /**
     *
     */
    const DEVICE_TYPE_SHOW1 = 'show1';
    /**
     *
     */
    const DEVICE_TYPE_SHOW2 = 'show2';
    /**
     *
     */
    const DEVICE_TYPE_TV = 'firetv';
    /**
     *
     */
    const SHAPE_ROUND = 'ROUND';
    /**
     *
     */
    const SHAPE_RECTANGLE = 'RECTANGLE';

    /**
     * @var array
     */
    protected $experiences = [];
    /**
     * @var
     */
    protected $shape;
    /**
     * @var array
     */
    protected $pixelDimensions = [];
    /**
     * @var
     */
    protected $dpi;
    /**
     * @var array
     */
    protected $currentPixelDimensions = [];
    /**
     * @var array
     */
    protected $touch = [];
    /**
     * @var
     */
    protected $keyboard;
    /**
     * @var
     */
    protected $currentDevice;


    /**
     * Viewport constructor.
     * @param $viewport
     */
    public function __construct($viewport)
    {
        $this->setExperiences($viewport->experiences);
        $this->setShape($viewport->shape);
        $this->setPixelDimensions(["width" => $viewport->pixelWidth, "height" => $viewport->pixelHeight]);
        $this->setDpi($viewport->dpi);
        $this->setCurrentPixelDimensions([
            'width'  => $viewport->currentPixelWidth,
            'height' => $viewport->currentPixelHeight,
        ]);
        $this->setTouch($viewport->touch);
        $this->setKeyboard($viewport->keyboard);
        $this->getDeviceName();
    }

    /**
     * @return mixed
     */
    public function getExperiences()
    {
        return $this->experiences;
    }

    /**
     * @param mixed $experiences
     * @return Viewport
     */
    public function setExperiences($experiences)
    {
        $this->experiences = $experiences;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getShape()
    {
        return $this->shape;
    }

    /**
     * @param mixed $shape
     * @return Viewport
     */
    public function setShape($shape)
    {
        $this->shape = $shape;

        return $this;
    }

    /**
     * @return array
     */
    public function getPixelDimensions(): array
    {
        return $this->pixelDimensions;
    }

    /**
     * @param array $pixelDimensions
     * @return Viewport
     */
    public function setPixelDimensions(array $pixelDimensions)
    {
        $this->pixelDimensions = $pixelDimensions;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDpi()
    {
        return $this->dpi;
    }

    /**
     * @param mixed $dpi
     * @return Viewport
     */
    public function setDpi($dpi)
    {
        $this->dpi = $dpi;

        return $this;
    }

    /**
     * @return array
     */
    public function getCurrentPixelDimensions()
    {
        return $this->currentPixelDimensions;
    }

    /**
     * @param array $currentPixelDimensions
     * @return Viewport
     */
    public function setCurrentPixelDimensions(array $currentPixelDimensions)
    {
        $this->currentPixelDimensions = $currentPixelDimensions;

        return $this;
    }

    /**
     * @return array
     */
    public function getTouch(): array
    {
        return $this->touch;
    }

    /**
     * @param array $touch
     * @return Viewport
     */
    public function setTouch(array $touch)
    {
        $this->touch = $touch;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getKeyboard()
    {
        return $this->keyboard;
    }

    /**
     * @param mixed $keyboard
     * @return Viewport
     */
    public function setKeyboard($keyboard)
    {
        $this->keyboard = $keyboard;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDeviceName()
    {
        if ($this->isEchoSpot()) {
            $this->setCurrentDevice(self::DEVICE_TYPE_SPOT);
        }
        if ($this->isEchoShowGen1()) {
            $this->setCurrentDevice(self::DEVICE_TYPE_SHOW1);
        }
        if ($this->isEchoShowGen2()) {
            $this->setCurrentDevice(self::DEVICE_TYPE_SHOW1);
        }
        if ($this->isFireTv()) {
            $this->setCurrentDevice(self::DEVICE_TYPE_TV);
        }

        return $this->currentDevice;
    }

    /**
     * @return bool
     */
    public function isFireTv()
    {
        return $this->checkDeviceDimensions('1920', '1080', self::SHAPE_ROUND);
    }

    /**
     * @return bool
     */
    public function isEchoSpot()
    {
        return $this->checkDeviceDimensions('480', '480', self::SHAPE_ROUND);
    }

    /**
     * @return bool
     */
    public function isEchoShowGen1()
    {
        return $this->checkDeviceDimensions('1024', '600', self::SHAPE_RECTANGLE);
    }

    /**
     * @return bool
     */
    public function isEchoShowGen2()
    {
        return $this->checkDeviceDimensions('1280', '800', self::SHAPE_RECTANGLE);
    }

    /**
     * @return mixed
     */
    public function getCurrentDevice()
    {
        return $this->currentDevice;
    }

    /**
     * @param mixed $currentDevice
     * @return Viewport
     */
    public function setCurrentDevice($currentDevice)
    {
        $this->currentDevice = $currentDevice;

        return $this;
    }

    /**
     * @return bool
     */
    protected function checkDeviceDimensions($pixelWidth, $pixelHeight, $shape): bool
    {
        $pixelDimensions = $this->getPixelDimensions();
        if ($pixelDimensions['width'] != $pixelWidth) {
            return false;
        }
        if ($pixelDimensions['height'] != $pixelHeight) {
            return false;
        }

        if ($this->getShape() != $shape) {
            return false;
        }

        return true;
    }

    /**
     * @param $device
     * @return bool
     */
    public function isDevice($device)
    {
        return $this->getCurrentDevice() == $device;
    }
}
