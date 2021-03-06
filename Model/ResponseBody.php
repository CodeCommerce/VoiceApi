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
     * @var array
     */
    protected $session = [];

    /**
     * @return mixed
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * @param $key
     * @param $value
     */
    public function addSessionParameter($key, $value)
    {
        $this->session[$key] = $value;
    }

    /**
     * ResponseBody constructor.
     * @param Response|null $response
     */
    public function __construct(Response $response = null)
    {
        if (null !== $response) {
            $this->response = $response;
        }
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
     * @return Response
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
