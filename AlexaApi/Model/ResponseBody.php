<?php

namespace CodeCommerce\AlexaApi\Model;

/**
 * Class ResponseBody
 * @package CodeCommerce\AlexaApi\Model
 */
class ResponseBody
{
    /**
     * @var string
     */
    protected $version;
    /**
     * @var object
     */
    protected $response;

    /**
     * ResponseBody constructor.
     */
    public function __construct()
    {
        $this->setVersion('1.0');
    }

    /**
     * @return mixed
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param mixed $version
     * @return ResponseBody
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param mixed $response
     * @return ResponseBody
     */
    public function setResponse($response)
    {
        $this->response = $response;

        return $this;
    }
}
