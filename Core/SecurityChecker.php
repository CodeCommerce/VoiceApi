<?php

namespace CodeCommerce\AlexaApi\Core;

use CodeCommerce\AlexaApi\Model\Application;
use Symfony\Component\Yaml\Yaml;

class SecurityChecker
{
    protected $config;

    public function __construct()
    {
        if (file_exists(__DIR__ . '/../../Alexa/Config/system.yml')) {
            $file = __DIR__ . '/../../Alexa/Config/system.yml';
        } else {
            $file = __DIR__ . '/../Config/system.yml';
        }
        $this->config = Yaml::parseFile($file);
    }

    /**
     * @param Application $application
     * @return bool
     * @throws \Exception
     */
    public function checkAppId(Application $application)
    {
        if ($this->config['app_id'] == $application->getApplicationId()) {
            return true;
        }

        throw new \Exception('Dein Skill ist nicht Authentifiziert');
    }
}