<?php

namespace CodeCommerce\AlexaApi\Core;

use Symfony\Component\Yaml\Yaml;

/**
 * Class RequestRouter
 * @package CodeCommerce\AlexaApi\Core
 */
class RequestRouter
{
    const ROUTING_FILE_PATH_ROOT   = __DIR__ . '/../../../../Alexa/Config/routes.yml';
    const ROUTING_FILE_PATH_VENDOR = '/../Config/routes.yml';
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


    /**
     *
     */
    protected function setRoutes()
    {
        if (file_exists(self::ROUTING_FILE_PATH_ROOT)) {
            $file = self::ROUTING_FILE_PATH_ROOT;
        } else {
            $file = __DIR__ . self::ROUTING_FILE_PATH_VENDOR;
        }
        $this->_aRoutes = Yaml::parseFile($file);

    }

    /**
     * @param $sIntentName
     * @param $sClassName
     */
    public function addRoute($sIntentName, $sClassName) {
        if (!is_array($this->_aRoutes)) {
            $this->_aRoutes = [];
        }
        $this->_aRoutes[$sIntentName] = $sClassName;
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
