<?php

namespace CodeCommerce\AlexaApi\Core;

use Symfony\Component\Yaml\Yaml;

/**
 * Class RequestRouter
 * @package CodeCommerce\AlexaApi\Core
 */
class RequestRouter
{
    const ROUTING_FILE_PATH = '/../Config/routes.yml';
    /**
     * @var array
     */
    protected $_aRoutes;

    /**
     * RequestRouter constructor.
     */
    public function __construct()
    {
        $this->setRoutes();
    }

    /**
     * @param $sIntentName
     * @return bool
     */
    public function getRoute($sIntentName)
    {
        if (array_key_exists($sIntentName, $this->getRoutes())) {
            $aRoutes = $this->getRoutes();

            return $aRoutes[$sIntentName];
        }

        return false;
    }

    protected function setRoutes()
    {
        $this->_aRoutes = Yaml::parseFile(__DIR__ . self::ROUTING_FILE_PATH);
    }

    /**
     * @return mixed
     */
    protected function getRoutes()
    {
        if (null === $this->_aRoutes) {
            $this->setRoutes();
        }

        return $this->_aRoutes;
    }
}
