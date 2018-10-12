<?php

namespace CodeCommerce\AlexaApi\Core;


use Symfony\Component\Yaml\Yaml;

class RequestRouter
{
    protected $_aRoutes;
    const ROUTING_FILE_PATH = '/../Config/routes.yml';

    public function __construct()
    {
        $this->setRoutes();
    }

    protected function setRoutes()
    {
        $this->_aRoutes = Yaml::parseFile(__DIR__ . self::ROUTING_FILE_PATH);
    }

    protected function getRoutes()
    {
        if (null === $this->_aRoutes) {
            $this->setRoutes();
        }

        return $this->_aRoutes;
    }

    public function getRoute($sIntentName)
    {
        if (array_key_exists($sIntentName, $this->getRoutes())) {
            $aRoutes = $this->getRoutes();

            return $aRoutes[$sIntentName];
        }

        return false;
    }
}
