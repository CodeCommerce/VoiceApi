<?php

namespace CodeCommerce\AlexaApi\Model;

/**
 * Class Application
 * @package CodeCommerce\AlexaApi\Model
 */
class Application
{
    /**
     * @var string
     */
    protected $applicationId;

    /**
     * @return mixed
     */
    public function getApplicationId()
    {
        return $this->applicationId;
    }

    /**
     * @param mixed $applicationId
     * @return Application
     */
    public function setApplicationId($applicationId)
    {
        $this->applicationId = $applicationId;

        return $this;
    }
}
