<?php

namespace CodeCommerce\AlexaApi\Core;

use CodeCommerce\AlexaApi\Model\Application;
use Symfony\Component\Yaml\Yaml;

/**
 * Class SecurityChecker
 * @package CodeCommerce\AlexaApi\Core
 */
class SecurityChecker
{
    const USER_SYSTEM_CONFIG_PATH = __DIR__ . '/../../../../Alexa/Config/system.yml';
    const VENDOR_SYSTEM_CONFIG_PATH = __DIR__ . '/../Config/system.yml';

    /**
     * @var integer
     */
    const MAX_TIME_TOLERANCE = 150;

    /**
     * @var mixed
     */
    protected $config;
    /**
     * @var object
     */
    protected $jsonRequest;

    /**
     * SecurityChecker constructor.
     */
    public function __construct($jsonRequest)
    {
        if (file_exists(self::USER_SYSTEM_CONFIG_PATH)) {
            $file = self::USER_SYSTEM_CONFIG_PATH;
        } else {
            $file = self::VENDOR_SYSTEM_CONFIG_PATH;
        }
        $this->config = Yaml::parseFile($file);
        $this->jsonRequest = $jsonRequest;
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
        $signatureUrl = $_SERVER['HTTP_SIGNATURECERTCHAINURL'];
        $certificateContent = file_get_contents($signatureUrl);

        $this->checkSignatureExists($signatureUrl);
        $this->isSslUrl($certificateContent, $_SERVER['HTTP_SIGNATURE']);
        $this->compareSignatureUrl($certificateContent);
        $this->checkTimestamp($this->jsonRequest->request->timestamp);
        $this->checkCertificateValidToTime($certificateContent);

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
     * @param $certificateContent
     * @param $signature
     * @return void
     * @throws \Exception
     */
    protected function isSslUrl($certificateContent, $signature)
    {
        $publicKey = openssl_pkey_get_public($certificateContent);
        $publicKeyDetails = openssl_pkey_get_details($publicKey);
        $signatureDecoded = base64_decode($signature);

        $sslVerify = openssl_verify(
            json_encode($this->jsonRequest, JSON_UNESCAPED_SLASHES),
            $signatureDecoded,
            $publicKeyDetails['key'],
            'sha1'
        );

        if ($sslVerify != '1') {
            throw new \Exception("SSL failure");
        }
    }

    /**
     * @param $certificateContent
     * @return void
     * @throws \Exception
     */
    protected function compareSignatureUrl($certificateContent)
    {
        $cert = openssl_x509_read($certificateContent);
        $parsedCertificate = openssl_x509_parse($cert, true);
        if (!$this->checkCertificationCN($parsedCertificate['subject']['CN']) ||
            !$this->checkSubjectAltName($parsedCertificate['extensions']['subjectAltName'])
        ) {
            throw new \Exception('No SSL Zertificate');
        }
    }

    /**
     * @param $cn
     * @return bool
     */
    protected function checkCertificationCN($cn)
    {
        return $cn == 'echo-api.amazon.com';
    }

    /**
     * @param $subjectAltName
     * @return bool
     */
    protected function checkSubjectAltName($subjectAltName)
    {
        return str_replace("DNS:", "", $subjectAltName) == 'echo-api.amazon.com';
    }

    /**
     * @param $timestamp
     * @throws \Exception
     */
    protected function checkTimestamp($timestamp)
    {
        if (time() - strtotime($timestamp) > self::MAX_TIME_TOLERANCE) {
            throw new \Exception('No SSL Zertificate');
        }
    }

    protected function checkCertificateValidToTime($certificateContent)
    {
        $cert = openssl_x509_read($certificateContent);
        $parsedCertificate = openssl_x509_parse($cert, true);
        if ($parsedCertificate['validTo_time_t'] < date("U") &&
            $parsedCertificate['validFrom_time_t'] < date("U")) {
            throw new \Exception($parsedCertificate['validTo_time_t']);
        }
    }
}
