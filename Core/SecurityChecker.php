<?php

namespace CodeCommerce\AlexaApi\Core;

use CodeCommerce\AlexaApi\Model\Application;
use Symfony\Component\Yaml\Yaml;

class SecurityChecker
{
    /**
     * @var mixed
     */
    protected $config;

    /**
     * SecurityChecker constructor.
     */
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
        if ($this->config['app_id'] != $application->getApplicationId()) {
            throw new \Exception('Dein Skill ist nicht Authentifiziert');
        }

        return $this;
    }

    /**
     * @return $this
     * @throws \Exception
     */
    public function checkCertification()
    {
        if (!TEST_MODE) {
            $signatureurl = $_SERVER['HTTP_SIGNATURECERTCHAINURL'];
            $this->checkSignatureExists($signatureurl);
            $this->validateSignatureUrl($signatureurl);
        }

        return $this;
    }

    /**
     * @param $signatureurl
     * @throws \Exception
     */
    protected function checkSignatureExists($signatureurl)
    {
        if (empty($signatureurl) ||
            $signatureurl == null ||
            is_null($signatureurl) ||
            $signatureurl == '') {
            throw new \Exception('HTTP_SIGNATURECERTCHAINURL data not present');
        }
    }

    /**
     * @param $signatureurl
     * @throws \Exception
     */
    protected function validateSignatureUrl($signatureurl)
    {
        if (!$this->isSslUrl($signatureurl) ||
            !$this->compareSignatureUrl($signatureurl)
        ) {
            header("HTTP/1.0 404 Not Found");
            exit();
        }
    }

    /**
     * @param $signatureurl
     * @return bool
     */
    protected function isSslUrl($signatureurl)
    {
        return substr($signatureurl, 0, 8) == 'https://';
    }

    /**
     * @param $signatureurl
     * @return bool
     */
    protected function compareSignatureUrl($signatureurl)
    {
        $validAdresses = [
            'https://s3.amazonaws.com/echo.api/echo-api-cert-6-ats.pem',
            'https://s3.amazonaws.com/echo.api/echo-api-cert.pem',
            'https://s3.amazonaws.com:443/echo.api/echo-api-cert.pem',
            'https://s3.amazonaws.com/echo.api/../echo.api/echo-api-cert.pem',
        ];

        return in_array($signatureurl, $validAdresses);
    }
}