<?php

namespace CodeCommerce\AlexaApi\Model;

/**
 * Class Intent
 * @package CodeCommerce\AlexaApi\Model
 */
class Intent
{
    /**
     * @var
     */
    protected $name;
    /**
     * @var
     */
    protected $confirmationStatus;

    /**
     * @var array
     */
    protected $slots = [];

    /**
     * @param $slot
     * @return $this
     */
    public function setSlot($slot)
    {
        if (!$this->hasSlot($slot->getName())) {
            $this->slots[$slot->getName()] = $slot;
        }

        return $this;
    }

    /**
     * @param $slotName
     * @return bool|mixed
     */
    public function getSlot($slotName)
    {
        if ($this->hasSlot($slotName)) {
            return $this->slots[$slotName];
        }

        return false;
    }

    /**
     * @param $slot
     * @return bool
     */
    protected function hasSlot($slot)
    {
        return array_key_exists($slot, $this->slots);
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
     * @return Intent
     */
    public function setName($name)
    {
        $this->name = $name;

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
     * @return Intent
     */
    public function setConfirmationStatus($confirmationStatus)
    {
        $this->confirmationStatus = $confirmationStatus;

        return $this;
    }
}
