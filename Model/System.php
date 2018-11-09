<?php

namespace CodeCommerce\AlexaApi\Model;

use CodeCommerce\AlexaApi\Model\Application;
use CodeCommerce\AlexaApi\Model\Device;
use CodeCommerce\AlexaApi\Model\User;

/**
 * Class System
 * @package CodeCommerce\AlexaApi\Model
 */
class System
{
    /**
     *
     */
    const SUPPORT_TYPE_DISPLAY = 'display';

    /**
     * @var Application
     */
    protected $application;
    /**
     * @var User
     */
    protected $user;

    /**
     * @var Device
     */
    protected $device;
    /**
     * @var string
     */
    protected $apiEndpoint;

    /**
     * @var string
     */
    protected $apiAccessToken;

    /**
     * @var Viewport
     */
    protected $viewport;

    /**
     * System constructor.
     * @param $system
     */
    public function __construct($system)
    {
        if (property_exists($system, 'application')) {
            $this->setApplication($system->application);
        }
        if (property_exists($system, 'usser')) {
            $this->setUser($system->user);
        }
        if (property_exists($system, 'device')) {
            $this->setDevice($system->device);
        }
        if (property_exists($system, 'apiEndpoint')) {
            $this->setApiEndpoint($system->apiEndpoint);
        }
    }

    /**
     * @return string
     */
    public function getApiAccessToken()
    {
        return $this->apiAccessToken;
    }

    /**
     * @param mixed $apiAccessToken
     * @return System
     */
    public function setApiAccessToken($apiAccessToken)
    {
        $this->apiAccessToken = $apiAccessToken;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getApplication()
    {
        return $this->application;
    }

    /**
     * @param mixed $application
     * @return System
     */
    public function setApplication($application)
    {
        $this->application = new Application();
        $this->application->setApplicationId($application->applicationId);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     * @return System
     */
    public function setUser($user)
    {
        $this->user = new User();
        $this->user->setUserId($user->userId);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDevice()
    {
        return $this->device;
    }

    /**
     * @param mixed $device
     * @return System
     */
    public function setDevice($device)
    {
        $this->device = new Device();
        $this->device->setDeviceId($device->deviceId)
            ->setSupportedInterfaces($device->supportedInterfaces);

        return $this;
    }

    /**
     * @return bool|Viewport
     */
    public function getViewport()
    {
        if ($this->hasViewport()) {
            return $this->viewport;
        }

        return false;
    }

    /**
     * @param Viewport $viewport
     */
    public function setViewport(Viewport $viewport)
    {
        $this->viewport = $viewport;
    }

    /**
     * @return mixed
     */
    public function getApiEndpoint()
    {
        return $this->apiEndpoint;
    }

    /**
     * @param mixed $apiEndpoint
     * @return System
     */
    public function setApiEndpoint($apiEndpoint)
    {
        $this->apiEndpoint = $apiEndpoint;

        return $this;
    }

    /**
     * @param $type
     * @return bool
     */
    public function supports($type = self::SUPPORT_TYPE_DISPLAY)
    {
        switch ($type) {
            case self::SUPPORT_TYPE_DISPLAY:
                return (bool)$this->getDisplay();
        }

        return false;
    }

    /**
     * @return mixed
     */
    public function getDisplay()
    {
        if (null !== $this->device) {
            return $this->getDevice()->getDisplay();
        }

        return false;
    }

    /**
     * @return bool
     */
    public function hasViewport()
    {
        if (is_a($this->viewport, Viewport::class)) {
            return true;
        }

        return false;
    }
}
