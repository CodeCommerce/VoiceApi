<?php

namespace CodeCommerce\AlexaApi\Model;

/**
 * Class Slot
 * @package CodeCommerce\AlexaApi\Model
 */
class Slot
{
    /**
     * @var string
     */
    protected $name;
    /**
     * @var string
     */
    protected $value;
    /**
     * @var string
     */
    protected $confirmationStatus;
    /**
     * @var string
     */
    protected $source;

    /**
     * Slot constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return Slot
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     * @return Slot
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getConfirmationStatus()
    {
        return $this->confirmationStatus;
    }

    /**
     * @param mixed $confirmationStatus
     * @return Slot
     */
    public function setConfirmationStatus($confirmationStatus)
    {
        $this->confirmationStatus = $confirmationStatus;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param mixed $source
     * @return Slot
     */
    public function setSource($source)
    {
        $this->source = $source;

        return $this;
    }

}