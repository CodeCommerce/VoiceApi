<?php

namespace CodeCommerce\AlexaApi\Core;

use CodeCommerce\AlexaApi\Model\Application;
use CodeCommerce\AlexaApi\Model\System;
use Symfony\Component\Yaml\Yaml;

class SecurityChecker
{
    protected $config;

    public function __construct()
    {
        $file = __DIR__ . '/../Config/system.yml';
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