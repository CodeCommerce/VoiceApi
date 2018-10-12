<?php

namespace CodeCommerce\AlexaApi\Model;

class Request
{
    protected $type;
    protected $requestid;
    protected $timestamp;
    protected $locale;
    protected $intent;

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     * @return Request
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRequestid()
    {
        return $this->requestid;
    }

    /**
     * @param mixed $requestid
     * @return Request
     */
    public function setRequestid($requestid)
    {
        $this->requestid = $requestid;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * @param mixed $timestamp
     * @return Request
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @param mixed $locale
     * @return Request
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIntent()
    {
        return $this->intent;
    }

    /**
     * @param mixed $intent
     * @return Request
     */
    public function setIntent($intent)
    {
        $this->intent = $intent;

        return $this;
    }
}
