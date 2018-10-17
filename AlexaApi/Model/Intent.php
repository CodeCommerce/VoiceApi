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
