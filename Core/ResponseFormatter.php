<?php

namespace CodeCommerce\AlexaApi\Core;

use CodeCommerce\AlexaApi\Model\ResponseBody;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Class ResponseFormatter
 * @package CodeCommerce\AlexaApi\Core
 */
class ResponseFormatter
{
    /**
     * @var bool|float|int|string
     */
    protected $formattedResponse;

    /**
     * ResponseFormatter constructor.
     * @param ResponseBody $responseBody
     */
    public function __construct(ResponseBody $responseBody)
    {
        $this->formattedResponse = $this->formatResponse($responseBody);
    }

    /**
     * @return bool|float|int|string
     */
    public function getFormattedResponse()
    {
        return $this->formattedResponse;
    }

    /**
     * @param ResponseBody $responseBody
     * @return bool|float|int|string
     */
    protected function formatResponse(ResponseBody $responseBody)
    {
        $json = $this->serializeResponse($responseBody);
        $json = str_replace("\/", "/", $json);

        return $json;
    }

    /**
     * @param $responseBody
     * @return bool|float|int|string
     */
    protected function serializeResponse($responseBody)
    {
        $encoder = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoder);
        $jsonContent = $serializer->serialize($responseBody, 'json');

        return $jsonContent;
    }
}
