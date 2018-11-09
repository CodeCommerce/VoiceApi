<?php

namespace CodeCommerce\AlexaApi\Model;

class Viewport
{

    protected $experiences = [];
    protected $shape;
    protected $pixelDimensions = [];
    protected $dpi;
    protected $currentPixelDimensions = [];
    protected $touch = [];
    protected $keyboard;

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
        $this->setCurrentPixelDimensions(['width'  => $viewport->currentPixelWidth,
                                          'height' => $viewport->currentPixelHeight,
        ]);
        $this->setTouch($viewport->touch);
        $this->setKeyboard($viewport->keyboard);
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
}
